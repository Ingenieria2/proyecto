<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RolRepository")
 */
class Rol 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rol", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_rol;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     *
     *@var array
     * @ORM\Column(type="json_array" , nullable = true)
     */
    private $permisos = [];

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id_rol;
    }

    /**
    * Set descripcion
    *
    * @param string $descripcion
    *
    * @return Rol
    */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setPermisos($permisos)
    {
        $nuevoPermiso = [];
        if ( sizeof($permisos) > 0 )
        {
            foreach ($permisos as $key => $value) {
                array_push($nuevoPermiso,$value);
            }
        }
        $this->permisos = $nuevoPermiso;
    }

    /**
    * @return array(Role|string)[]
    */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
    * Set nombre
    *
    * @param string $nombre
    *
    * @return Rol
    */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
