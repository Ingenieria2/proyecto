<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Configuracion;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ResourceController extends Controller
{
    /**
	* @Route("/", name="homepage")
	*/
    public function homeAction(UserInterface $user = null, SessionInterface $session)
    {
	    $repository = $this->getDoctrine()->getRepository(Configuracion::class);
        $config = $repository->findAll()[0];
        $mensaje = $config->getMensaje();
        $contacto = $config->getContacto();
    	if ($config->getHabilitado()== 0) 
		{
			return $this->render('front/sitioDeshabilitado.html.twig', array('mensaje' => $mensaje, 'contacto' => $contacto)); 
		}
		else
		{
			return $this->render('front/index.html.twig',array('contacto' => $contacto));
		}
  
    	
    }

}
?>
