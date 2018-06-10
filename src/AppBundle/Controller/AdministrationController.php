<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Rol;
use AppBundle\Entity\Configuracion;
use AppBundle\Entity\Permiso;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Form\UsuarioType;
use AppBundle\Form\RolAdminType;
use AppBundle\Form\UsuarioAdminType;
use AppBundle\Form\PermisoAdminType;
use AppBundle\Form\PageAdminType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;

class AdministrationController extends Controller
{
    /**
     * @Route("/pageAdmin", name="pageAdmin")
     */
    public function pageAdminAction(Request $request)
    {
       if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //captura el repositorio de la tabla contra la base de datos
            $repository = $this->getDoctrine()->getRepository(Configuracion::class);
            $config = $repository->findAll()[0];
            $form = $this->createForm(PageAdminType::class, $config);

            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {


                // 4) save the Configuration!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($config);
                $entityManager->flush();
                return $this->render('front/index.html.twig');
            }
            return $this->render('admin/administrarPagina.html.twig', array('form' => $form->createView()));
        }
    }

    /**
     * @Route("/rolAdmin", name="rolAdmin")
     */
    public function rolAdminAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //Obtener paginado configurado
            $repository = $this->getDoctrine()->getRepository(Configuracion::class);
            $resultadosporpagina = $repository->findAll()[0]->getListado();

            //captura el repositorio de la tabla contra la base de datos
            $repository = $this->getDoctrine()->getRepository(Rol::class);
            $roles = $repository->findAll();

            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $usuarios = $repository->findAllActive();
            
            return $this->render('admin/administrarRoles.html.twig', array(
                'roles' => $roles, 
                'usuarios' => $usuarios, 
                'resultadosporpagina' => $resultadosporpagina));
        }
    }

    /**
    * @Route("/permissionAdmin", name="permissionAdmin")
    */
    public function permissionAdminAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //captura el repositorio de la tabla contra la base de datos
            $repository = $this->getDoctrine()->getRepository(Rol::class);
            $rol = $repository->findAll();
            
            return $this->render('admin/listRol.html.twig', array('roles' => $rol));
        }
    }

    /**
     * @Route("/userAdmin", name="userAdmin")
     */
    public function userAdminAction()
    {   
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        elseif ($this->get('security.authorization_checker')->isGranted("Usuario_Index", $this->get('session')->get('Roles')))
        {
            //Obtener paginado configurado
            $repository = $this->getDoctrine()->getRepository(Configuracion::class);
            $resultadosporpagina = $repository->findAll()[0]->getListado();

            //Obtener listado completo
            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $usuarios = $repository->findAllActive();

            $user = $this->getUser();
            return $this->render('admin/listUsers.html.twig', array(
                'user' => $user , 
                'usuarios' => $usuarios, 
                'resultadosporpagina' => $resultadosporpagina
            ));
        }
        return $this->render('front/index.html.twig');        
    }

    /**
     * @Route("/activateUser/{id}", name="activarUsuario")
     */
    public function activateUser(Request $request, $id)
    {   
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        elseif ($this->get('security.authorization_checker')->isGranted("Usuario_Update", $this->get('session')->get('Roles')))
        {
            //Obtener listado completo
            $em = $this->getDoctrine()->getEntityManager();
            $user = $em->getRepository("AppBundle:Usuario");
            $user = $user->find($id);

            if ( $user->getActivo() )
            {
                $user->setActivo(0);
            }
            else
            {
                $user->setActivo(1);
            }
            $em->persist($user);
            $em->flush();
        }
        //return $this->userAdminAction();
        return $this->redirect($request->headers->get('referer'));
    }

    /**
    * @Route("/deleteUser/{idUsuario}", name="eliminarUsuario")
    */
    public function eliminarUsuario(Request $request, $idUsuario)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository("AppBundle:Usuario");
 
        $user = $user->find($idUsuario);
        
        if (!$user->getBorrado()) 
        {
            echo "La historia se ha borrado correctamente";
            $user->setBorrado(1);
            $em->persist($user);
            $em->flush();
        }
        //return $this->userAdminAction();
        return $this->redirect($request->headers->get('referer'));
    }
    
    /**
    * @Route("/userAcount/{idUsuario}", name="cuentaUsuario")
    */
    public function userAcountAction(Request $request, $idUsuario, UserPasswordEncoderInterface $passwordEncoder)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //captura el repositorio de la tabla contra la base de datos
            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $user = $repository->find($idUsuario);
            $form = $this->createForm(UsuarioAdminType::class, $user,array('roles'=> $this->getDoctrine()->getRepository(Rol::class)->findAll()));

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
                //return $this->redirect($request->headers->get('referer'));
                return $this->redirectToRoute('userAdmin');
            }
            return $this->render('user/userAcount.html.twig', array('form' => $form->createView()));
        }
    }

    /**
    * @Route("/signUpUser", name="signUpUser")
    */
    public function SignUpUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
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

            return $this->redirectToRoute('userAdmin');
          }
        }
        return $this->render('front/signUp.html.twig', array('form' => $form->createView()));
    }

    /**
    * @Route("/assignRole", name="rolesUsuario")
    */
    public function assignRoleAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //captura el repositorio de la tabla contra la base de datos
            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $user = $repository->find($idUsuario);
            $form = $this->createForm(UsuarioAdminType::class, $user);

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
                //return $this->redirect($request->headers->get('referer'));
                return $this->redirectToRoute('userAdmin');
            }
            return $this->render('user/userAcount.html.twig', array('form' => $form->createView()));
        }
    }

    /**
     * @Route("/setPermission/{idRol}", name="setPermiso")
     */
    public function setPermissionUser(Request $request, $idRol)
    {   
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //captura el repositorio de la tabla contra la base de datos
            $repository = $this->getDoctrine()->getRepository(Rol::class);
            $rol = $repository->find($idRol);
            $form = $this->createForm(PermisoAdminType::class, $rol,array('permiso'=> $this->getDoctrine()->getRepository(Permiso::class)->findAll()));

            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) 
            {
                // 4) save
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($rol);
                $entityManager->flush();

                //return $this->redirect($request->headers->get('referer'));
                return $this->redirectToRoute('userAdmin');
            }
            return $this->render('admin/administrarPermisos.html.twig', array(
                'form' => $form->createView(),
                'rol' => $rol));
        }
        //return $this->userAdminAction();
        return $this->redirect($request->headers->get('referer'));
    }

    /**
    * @Route("/setRol/{rolName}/{idUsuario}", name="setRol")
    */
    public function setRol(Request $request, $rolName, $idUsuario)
    {   
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            throw $this->createAccessDeniedException();
        }
        else
        {
            //captura el repositorio de la tabla contra la base de datos
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository("AppBundle:Usuario");
            $user = $repository->find($idUsuario);
            if(array_search($rolName,$user->getRoles()))
            {
                $user->setRoles(array_diff($user->getRoles(), array($rolName)));
            }
            else
            {
                $nuevo = $user->getRoles();
                array_push($nuevo, $rolName);
                $user->setRoles($nuevo);
            }

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('rolAdmin');
        }
        //return $this->userAdminAction();
        return $this->redirect($request->headers->get('referer'));
    }
}
?>