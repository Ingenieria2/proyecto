<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Paciente;
use AppBundle\Entity\Configuracion;
use AppBundle\Entity\Tipo_Documento;
use AppBundle\Entity\Datos_Demograficos;
use AppBundle\Form\PacienteType;
use AppBundle\Form\PacienteUpdateType;
use AppBundle\Controller\APIController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;

class patientController extends APIController
{

    /**
     * @Route("/listPatient", name="listaPacientes")
     */
    public function listaPacientesAction()
    {   
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        elseif ($this->get('security.authorization_checker')->isGranted("Paciente_Index", $this->get('session')->get('Roles')))
        {   
            //Obtener paginado configurado
            $repository = $this->getDoctrine()->getRepository(Configuracion::class);
            $resultadosporpagina = $repository->findAll()[0]->getListado();

            //Obtener listado completo
            $repository = $this->getDoctrine()->getRepository(Paciente::class);
            $pacientes = $repository->findAllActive();

            $user = $this->getUser();
            return $this->render('patient/listPatient.html.twig', array(
                'user' => $user , 
                'pacientes' => $pacientes,
                'resultadosporpagina' => $resultadosporpagina,
                'tiposDocumento' => $this->getTiposDocumento(),
                'obrasSociales' => $this->getTiposObraSocial()
            ));
        }
        return $this->render('front/index.html.twig');        
    }

    /**
     * @Route("/signUpPatient", name="altaPaciente")
     */
    public function altaPaciente(Request $request)
    {
        // 1) build the form
        $patient = new Paciente();
        $documento = $this->getTiposDocumento();
        $obra = $this->getTiposObraSocial();
        $form = $this->createForm(PacienteType::class, $patient, array('doc' => $documento, 
            'os' =>$obra));

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $patient->setBorrado(0);
            $patient->setIdDatosDemograficos(0);
            $patient->setControlSalud(0);

            // 4) save the Patient!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();
            return $this->render('front/index.html.twig');
        }
        return $this->render('patient/signUpPatient.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/modifyPatient/{id}", name="modificarPaciente")
     */
    public function modificarPaciente(Request $request, $id)
    {
     if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
        // 1) build the form
        $repository = $this->getDoctrine()->getRepository(Paciente::class);
        $patient = $repository->find($id);
        $documento = $this->getTiposDocumento();
        $obra = $this->getTiposObraSocial();
        $form = $this->createForm(PacienteUpdateType::class, $patient, array('doc' => $documento, 
            'os' =>$obra));

            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
             // 4) save the Patient!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($patient);
                $entityManager->flush();
                return $this->render('front/index.html.twig');
          }
        return $this->render('patient/modifyPatient.html.twig', array('form' => $form->createView()));
        }
    }

    /**
    * @Route("/listPatient/statistics/datosVivienda", name="datosVivienda")
    */
    public function datosVivienda()
    {
        $repository = $this->getDoctrine()->getRepository(Datos_Demograficos::class);
        $datos= $repository->graficoTipoVivienda();
        $data_points = array();
        foreach ($datos as $dato) {
            $arrayAux = $this->getTipoVivienda($dato["id_vivienda"]);
            $point = array("valorx" => $dato["id_vivienda"], "valory" => $dato["cantidad"], "indexLabel" => $arrayAux['nombre']);
            array_push($data_points, $point);
        }
        echo json_encode($data_points);
        die();//return $this->render('blankPage.html.twig');
    }

    /**
    * @Route("/listPatient/statistics/datosCalefaccion", name="datosCalefaccion")
    */
    public function datosCalefaccion()
    {
        $repository = $this->getDoctrine()->getRepository(Datos_Demograficos::class);
        $datos= $repository->graficoTipoCalefaccion();
        $data_points = array();
        foreach ($datos as $dato) {
            $arrayAux = $this->getTipoCalefaccion($dato["id_calefaccion"]);
            $point = array("valorx" => $dato["id_calefaccion"], "valory" => $dato["cantidad"], "indexLabel" => $arrayAux['nombre']);
            array_push($data_points, $point);
        }
        echo json_encode($data_points);
        die();//return $this->render('blankPage.html.twig');
    }

    /**
    * @Route("/listPatient/statistics/datosAgua", name="datosAgua")
    */
    public function datosAgua()
    {
        $repository = $this->getDoctrine()->getRepository(Datos_Demograficos::class);
        $datos= $repository->graficoTipoAgua();
        $data_points = array();
        foreach ($datos as $dato) {
            $arrayAux = $this->getTipoAgua($dato["id_agua"]);
            $point = array("valorx" => $dato["id_agua"], "valory" => $dato["cantidad"], "indexLabel" => $arrayAux['nombre']);
            array_push($data_points, $point);
        }
        echo json_encode($data_points);
        die();//return $this->render('blankPage.html.twig');
    }

    /**
    * @Route("/listPatient/statistics/datosBarra", name="datosBarra")
    */
    public function datosBarra()
    {
        $repository = $this->getDoctrine()->getRepository(Datos_Demograficos::class);
        $result = array(
            "CantidadPacientes" => array(),
            "heladera"          => array(),
            "electricidad"      => array(),
            "mascotas"          => array());
        $datos= $repository->graficoTotalPaciente();
        $point = array("valorx" => 0, "valory" => $datos[0]["cant_Pacientes"]);
        array_push($result["CantidadPacientes"], $point);
        $datos= $repository->graficoTotalHeladera();
        $point = array("valorx" => 10, "valory" => $datos[0]["heladera"]);
        array_push($result["heladera"], $point);
        $datos= $repository->graficoTotalElectricidad();
        $point = array("valorx" => 20, "valory" => $datos[0]["electricidad"]);
        array_push($result["electricidad"], $point);
        $datos= $repository->graficoTotalMascota();
        $point = array("valorx" => 30, "valory" => $datos[0]["mascotas"]);
        array_push($result["mascotas"], $point);
        echo json_encode($result);
        die();//return $this->render('blankPage.html.twig');
    }

    /**
    * @Route("/deletePatient/{id}", name="eliminarPaciente")
    */
    public function eliminarPaciente(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $paciente = $em->getRepository("AppBundle:Paciente");
 
        $paciente = $paciente->find($id);
        
        if ($paciente->getBorrado() == 1) {
            echo "La historia no se ha borrado";
        } else {
            echo "La historia se ha borrado correctamente";
            $paciente->setBorrado(1);
            $em->persist($paciente);
            $em->flush();
        }
        return $this->listaPacientesAction();
    }

}
?>