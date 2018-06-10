<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Rol;
use AppBundle\Entity\Configuracion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Form\UsuarioType;
use AppBundle\Form\UsuarioUpdateType;
use AppBundle\Form\RolDeUsuarioType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;

class UserController extends Controller
{

    /**
    * @Route("/signUp", name="signUp")
    */
    public function SignUpAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $repository = $this->getDoctrine()->getRepository(Configuracion::class);
        $config = $repository->findAll()[0];
        $contacto = $config->getContacto();
        // 1) build the form
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $nombre = $user->getUsername();
            if($repository->findOneByUsername($nombre))
            {
               return $this->render('front/error.html.twig');
            }
            else {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setActivo('0');
            $user->setModificadoEn(new \DateTime());
            $user->setCreadoEn(new \DateTime());
            $user->setBorrado('0');
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->render('front/index.html.twig', array('contacto' => $contacto));
          }
        }
        return $this->render('front/signUp.html.twig', array('form' => $form->createView(),'contacto' => $contacto));
    }

    /**
    * @Route("/login", name="login")
    */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $repository = $this->getDoctrine()->getRepository(Configuracion::class);
        $config = $repository->findAll()[0];
        $contacto = $config->getContacto();
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $session = new Session();
            //$session->start();
            $this-> get('session') -> set('RolActivo', ($this->getUser()->getRoles()[0]));
            $this-> get('session') -> set('username',$this->getUser()->getUsername());
            $this-> get('session') -> set('contacto', $contacto);
            $permisosRoles = $this->getDoctrine()->getRepository(Rol::class)->findByNombre($this->getUser()->getRoles()[0]);
            if ( sizeof($permisosRoles) > 0 )
            { 
                $permisosRoles = $permisosRoles[0]->getPermisos();
            }
            $this-> get('session') -> set('Roles', $permisosRoles);
            $todosRoles = $this->getDoctrine()->getRepository(Rol::class)->findAll();
            $tr = array();
            foreach ($todosRoles as $key => $value) {
                $tr[$value->getNombre()] = $value->getDescripcion();
            }
            $this-> get('session') -> set('TodosLosRoles', $tr);
            return $this->render('front/index.html.twig', array('contacto' => $contacto));
        }
        else
        {
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('front/login.html.twig', array(
                'last_username' => $lastUsername,
                'error'         => $error,
                'contacto' => $contacto
            ));
        }
    }

    /**
    * @Route("/logout", name="logout")
    */
    public function logoutAction()
    {
        $session -> invalidate();
        return null;
    }

    /**
    * @Route("/myAcount", name="myAcount")
    */
    public function myAcountAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //captura el repositorio de la tabla contra la base de datos
            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $user = $repository->findOneByUsername($this->getUser()->getUsername());
            $form = $this->createForm(UsuarioUpdateType::class, $user);

            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) 
            {
                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
                $user->setModificadoEn(new \DateTime());

                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $status = "El usuario ha sido modificado correctamente";
                $this->get('session')->getFlashBag()->add('status', $status);
                $this-> get('session') -> set('RolActivo', ($user->getRoles()[0]));
                return $this->render('front/index.html.twig');
            }
            return $this->render('user/myAcount.html.twig', array('form' => $form->createView()));
        }

    }

    /**
    * @Route("/cambioRol/{nuevoRol}", name="cambioRol")
    */
    public function cambioRol( Request $request, $nuevoRol )
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            throw $this->createAccessDeniedException();
        }
        else
        {
            $this-> get('session') -> set('RolActivo', $nuevoRol);
            $permisosRoles = $this->getDoctrine()->getRepository(Rol::class)->findByNombre($nuevoRol);
            if ( sizeof($permisosRoles) > 0 )
            { 
                $permisosRoles = $permisosRoles[0]->getPermisos();
            }
            $this-> get('session') -> set('Roles', $permisosRoles);
            return $this->redirect($request->headers->get('referer'));
        }

        return $this->render('front/index.html.twig');
    }
}
?>