<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permiso
 *
 * @ORM\Table(name="permiso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PermisoRepository")
 */
class Permiso
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_permiso", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_permiso;


    /**
     * @var string
     *
     * @ORM\Column(name="permiso", type="string", length=255)
     */
    private $permiso;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set permiso
     *
     * @param string $permiso
     *
     * @return Permiso
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;

        return $this;
    }

    /**
     * Get permiso
     *
     * @return string
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Permiso
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

    /**
     * Get idPermiso
     *
     * @return integer
     */
    public function getIdPermiso()
    {
        return $this->id_permiso;
    }

    /**
     * Set rol
     *
     * @param \AppBundle\Entity\Rol $rol
     *
     * @return Permiso
     */
    public function setRol(\AppBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \AppBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }
}