<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Paciente;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Control_Salud;
use AppBundle\Form\HistoriaClinicaType;
use AppBundle\Form\HistoriaClinicaUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;

class ClinicHistoryController extends APIController
{
  public function CalculaEdad($fecha_nac)
  {
    //$fecha_nac = strtotime($fecha_nac);
    //$edad = date('Y', $fecha_nac);
    $fecha_act = new \DateTime();
    $edad = $fecha_nac->format('Y');
    if (($mes = (($fecha_act->format('m')) - ($fecha_nac->format('m')))) < 0) 
    {
      $edad++;
    }
    elseif ($mes == 0 && ($fecha_act->format('d')) - ($fecha_nac->format('d')) < 0) 
    {
      $edad++;
    }
    return ($fecha_act->format('Y')) - $edad;
  }

  /**
  * @Route("/signUpClinicHistory/{id}", name="altaHistoriaClinica")
  */
  public function signUpClinicHistoryAction(Request $request, $id)
  {   
    // 1) build the form
    $historiaClinica = new Control_Salud();
    $form = $this->createForm(HistoriaClinicaType::class, $historiaClinica);

    // 2) handle the submit (will only happen on POST)
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      $repository = $this->getDoctrine()->getRepository(Usuario::class);
      $user = $repository->findOneByUsername($this->getUser()->getUsername());
      $idUsuario = $user->getId();
      $historiaClinica->setIdPaciente($id);
      $historiaClinica->setIdUsuario($idUsuario);
      $paciente = new Paciente();
      $repository = $this->getDoctrine()->getRepository(Paciente::class);
      $paciente = $repository->find($id);
      $paciente->setControlSalud(1);
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($paciente);
      $entityManager->flush();

      $historiaClinica->setBorrado(0);
      // 4) save the DemographicsData!
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($historiaClinica);
      $entityManager->flush();
      return $this->redirectToRoute('administrarHistoriaClinica', array('id' => $id));
      //return $this->administrarHistoriaClinica($request, $id);
    }
    return $this->render('patient/signUpClinicHistory.html.twig', array('form' => $form->createView()));
  }

  /**
  * @Route("/modifyClinicHistory/{id}", name="modificarHistoriaClinica")
  */
  public function modificarHistoriaClinica(Request $request, $id)
  {
    if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
    {
      throw $this->createAccessDeniedException();
    }
    else
    {
      // 1) build the form
      $repository = $this->getDoctrine()->getRepository(Control_Salud::class);
      $historiaClinica = $repository->find($id);
      $edad = $this->CalculaEdad($historiaClinica->getFecha());
      $historiaClinica->setEdad($edad);

      $form = $this->createForm(HistoriaClinicaUpdateType::class, $historiaClinica);

      // 2) handle the submit (will only happen on POST)
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) 
      {
        // 4) save the Patient!
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($historiaClinica);
        $entityManager->flush();
        return $this->redirectToRoute('administrarHistoriaClinica',array( 'id' => $historiaClinica->getIdPaciente()));
      }
      return $this->render('patient/modifyClinicHistory.html.twig', array('form' => $form->createView()));
    }
  }

  /**
  * @Route("/clinicHistoryAdmin/{id}", name="administrarHistoriaClinica")
  */
  public function administrarHistoriaClinica(Request $request, $id)
  {
    if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
    {
        throw $this->createAccessDeniedException();
    }
    elseif ($this->get('security.authorization_checker')->isGranted("Paciente_Index", $this->get('session')->get('Roles')))
    {
        //Obtener listado completo
        $repository = $this->getDoctrine()->getRepository(Paciente::class);
        $paciente = $repository->find($id);
        $repository = $this->getDoctrine()->getRepository(Control_Salud::class);
        $listaControlSalud = $repository->findByIdPaciente($id);

        return $this->render('patient/patientClinicHistory.html.twig', array(
            'paciente' => $paciente, 
            'listaControlSalud' => $listaControlSalud,
            'tiposDocumento' => $this->getTiposDocumento(),
            'obrasSociales' => $this->getTiposObraSocial()
        ));
    }
    return $this->render('front/index.html.twig'); 
  }

  /**
  * @Route("/deleteHistoryAdmin/{id}", name="eliminarHistoriaClinica")
  */
  public function eliminarHistoriaClinica(Request $request, $id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $historiaClinica = $em->getRepository("AppBundle:Control_Salud");
    $historiaClinica = $historiaClinica->find($id);
    $idPaciente = $historiaClinica->getIdPaciente();
    $repository = $this->getDoctrine()->getRepository(Control_Salud::class);
    $borradoTotal = $repository->findByIdPaciente($idPaciente);

    if ($historiaClinica->getBorrado() == 1) {
      echo "La historia no se ha borrado";
    } else {
      echo "La historia se ha borrado correctamente";
      $historiaClinica->setBorrado(1);
      $em->persist($historiaClinica);
      $em->flush();

      if(sizeof($borradoTotal) == 1)
      {
        $paciente = new Paciente();
        $repository = $this->getDoctrine()->getRepository(Paciente::class);
        $paciente = $repository->find($idPaciente);
        $paciente->setControlSalud(0);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($paciente);
        $entityManager->flush();
      }
    }
    return $this->administrarHistoriaClinica($request, $idPaciente);
  }

  /**
  * @Route("/clinicHistoryAdmin/{idPaciente}/statistics/datosCurva/{curva}", name="datosCurva")
  */
  public function datosCurva($idPaciente, $curva)
  {
    $repository = $this->getDoctrine()->getRepository(Paciente::class);
    $paciente = $repository->find($idPaciente);
    $repository = $this->getDoctrine()->getRepository(Control_Salud::class);
    $datos= $repository->graphicsData($idPaciente);

    $result = array("week" => array(),"m" => array(),"p10" => array(),"p50" => array(),"p90" => array(), "data_points" => array());
    $fechaReferenca = $datos[0]["fecha"];
    $Anterior = -1;
    if ($curva == "talla") {
      foreach ($datos as $dato) {
        $Actual = $this->mes($fechaReferenca, $dato["fecha"]);
        if (( $Anterior <> $Actual )&($Actual <= 24)&!empty($dato[$curva])) {
          $point = array("valorx" => $Actual, "valory" => $dato[$curva]);
          array_push($result["data_points"], $point);
          $Anterior = $Actual;
        }
      }
    } else {
      foreach ($datos as $dato) {
        $Actual = $this->semana($fechaReferenca, $dato["fecha"]);
        if ( ($Anterior <> $Actual)&($Actual <= 13)&!empty($dato[$curva])) {
          $point = array("valorx" => $Actual, "valory" => $dato[$curva]);
          array_push($result["data_points"], $point);
          $Anterior = $Actual;
        }
      }
    }
    if ($curva == "peso") {
      if ($paciente->getGenero() == "F") {
        $url = "./js/canvasjs/Tablas/wfa_girls_p_0_13.txt";
      } else {
        $url = "./js/canvasjs/Tablas/wfa_boys_p_0_13.txt";
      }
    } elseif ($curva == "talla") {
      if ($paciente->getGenero() == "F") {
        $url = "./js/canvasjs/Tablas/lhfa_girls_p_0_2.txt";
      } else {
        $url = "./js/canvasjs/Tablas/lhfa_boys_p_0_2.txt";
      }
    } elseif ($curva == "ppc") {
      if ($paciente->getGenero() == "F") {
        $url = "./js/canvasjs/Tablas/hcfa_girls_p_0_13.txt";
      } else {
        $url = "./js/canvasjs/Tablas/hcfa_boys_p_0_13.txt";
      }
    }
    $datosArchivo = $this->cargarDatosDesdeArchivo($url);
    foreach ($datosArchivo[0] as $key => $columna) {
      if ( $key <> 0){
        //Media
        $point = array("valorx" => $datosArchivo[0][$key], "valory" => $datosArchivo[2][$key]);
        array_push($result["m"], $point);
        //P10
        $point = array("valorx" => $datosArchivo[0][$key], "valory" => $datosArchivo[9][$key]);
        array_push($result["p10"], $point);
        //P50
        $point = array("valorx" => $datosArchivo[0][$key], "valory" => $datosArchivo[12][$key]);
        array_push($result["p50"], $point);
        //P90
        $point = array("valorx" => $datosArchivo[0][$key], "valory" => $datosArchivo[15][$key]);
        array_push($result["p90"], $point);
      }
    }
    echo json_encode($result);
    die();
  }

  private function mes($fechaReferenca, $fechaComparacion)
  {
    $date1 = new \DateTime($fechaReferenca);
    $date2 = new \DateTime($fechaComparacion);
    $diff = $date1->diff($date2);
    $mes = $diff->format('%a');
    $mes = ($mes - $mes % 30 ) / 30;
    return $mes;
  }

  private function semana($fechaReferenca, $fechaComparacion)
  {
    $date1 = new \DateTime($fechaReferenca);
    $date2 = new \DateTime($fechaComparacion);
    $diff = $date1->diff($date2);
    $semana = $diff->format('%a');
    $semana = ($semana - $semana % 7 ) / 7;
    return $semana;
  }

  private function cargarDatosDesdeArchivo($url)
  {
    $file = file_get_contents("$url");
    $filas = explode(PHP_EOL,$file);
    $index1=0;
    foreach ($filas as $fila) {
      $datosPasar = explode("\t",$fila);
      $index2=0;
      foreach ($datosPasar as $aPasar) {
        $datos[$index2][$index1] = $aPasar;
        $index2++;
      }
      $index1++;
    }
    return $datos;
  }
}