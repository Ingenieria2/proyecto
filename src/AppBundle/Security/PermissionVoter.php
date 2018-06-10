<?php

namespace AppBundle\Security;

use AppBundle\Entity\Rol;
use AppBundle\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PermissionVoter extends Voter
{

    protected function supports($attribute, $subject)
    {
        //$todosLosPermisos = "";//$this->findAllPermiso();
        // if the attribute isn't one we support, return false
        //if (!in_array($attribute, $todosLosPermisos)) {
        //    return false;
        //}

        // only vote on Post objects inside this voter
        //if (!$subject instanceof Permiso) {
        //    return false;
        //}

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Usuario) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if(sizeof($subject) > 0)
        {
            foreach( $subject as $permiso)
            {   
                if ($permiso == $attribute ) 
                {
                    return true;
                }
            }    
        }
        
        return false;
        throw new \LogicException('This code should not be reached!');
    }

}
?>