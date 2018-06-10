<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Paciente;
use AppBundle\Entity\Datos_Demograficos;
use AppBundle\Form\DatosDemograficosType;
use AppBundle\Form\DatosDemograficosUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;

class DemographicsDataController extends APIController
{
    /**
    * @Route("/adminDemographicsData/{id}", name="administrarDatosDemograficos")
    */
    public function adminDemographicsData(Request $request, $id)
    {
       // 1) verify if have demographicsData 
        $repository = $this->getDoctrine()->getRepository(Paciente::class);
        $patient = $repository->find($id);
        $idDatos = $patient->getIdDatosDemograficos();
        var_dump($idDatos);
        if($idDatos == 0)
        {
            return $this->signUpDemographicsDataAction($request, $id);
        }
        else
        {

            return $this->modificarDatosDemograficos($request, $idDatos);
        }
        return $this->render('front/index.html.twig');
    }

    private function signUpDemographicsDataAction(Request $request, $id)
    {   
            // 1) build the form
            $datosDemograficos = new Datos_Demograficos();
            $vivienda = $this->getTiposVivienda();
            $agua = $this->getTiposAgua();
            $calefaccion = $this->getTiposCalefaccion();
            $form = $this->createForm(DatosDemograficosType::class, $datosDemograficos, array('vivienda' => $vivienda, 'agua' => $agua, 'calefaccion' => $calefaccion));

           // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // 3) Encode the password (you could also do this via Doctrine listener)
                $datosDemograficos->setBorrado(0);
             // 4) save the DemographicsData!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($datosDemograficos);
                $entityManager->flush();
                $repository = $this->getDoctrine()->getRepository(Paciente::class);
                $paciente = $repository->find($id);
                $paciente->setIdDatosDemograficos($datosDemograficos->getId());
                $entityManager->persist($paciente);
                $entityManager->flush();
                return $this->render('front/index.html.twig');
          }
        return $this->render('patient/signUpDemographicsData.html.twig', array('form' => $form->createView()));
    }


   private function modificarDatosDemograficos(Request $request, $id_datosDemograficos)
    {
     if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
        // 1) build the form
        $repository = $this->getDoctrine()->getRepository(Datos_Demograficos::class);
        $datosDemograficos = $repository->find($id_datosDemograficos);
        $vivienda = $this->getTiposVivienda();
        $agua = $this->getTiposAgua();
        $calefaccion = $this->getTiposCalefaccion();
        $form = $this->createForm(DatosDemograficosUpdateType::class, $datosDemograficos, array('vivienda' => $vivienda, 'agua' => $agua, 'calefaccion' => $calefaccion));

            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
             // 4) save the Patient!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($datosDemograficos);
                $entityManager->flush();
                return $this->render('front/index.html.twig');
          }
        return $this->render('patient/modifyDemographicsData.html.twig', array('form' => $form->createView()));
     }
   }

     /**
     * @Route("/deleteDemographicsData/{id}", name="eliminarDatosDemograficos")
     */
   public function eliminarDatosDemograficos(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $datosDemograficos = $em->getRepository("AppBundle:Datos_Demograficos");
 
        $datosDemograficos = $datosDemograficos->find($id);
        $datosDemograficos->setBorrado(1);
        $em->persist($datosDemograficos);
        $em->flush();
 
        if ($datosDemograficos->getBorrado() == 1) {
            echo "La historia se ha borrado correctamente";
        } else {
            echo "La historia no se ha borrado";
        }
    }
}
