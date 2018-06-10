<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol_Tiene_Permiso
 *
 * @ORM\Table(name="rol__tiene__permiso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Rol_Tiene_PermisoRepository")
 */
class Rol_Tiene_Permiso
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_rol", type="integer")
     */
    private $idRol;

    /**
     * @var int
     *
     * @ORM\Column(name="id_permiso", type="integer")
     */
    private $idPermiso;


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
     * Set idRol
     *
     * @param integer $idRol
     *
     * @return Rol_Tiene_Permiso
     */
    public function setIdRol($idRol)
    {
        $this->idRol = $idRol;

        return $this;
    }

    /**
     * Get idRol
     *
     * @return int
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Set idPermiso
     *
     * @param integer $idPermiso
     *
     * @return Rol_Tiene_Permiso
     */
    public function setIdPermiso($idPermiso)
    {
        $this->idPermiso = $idPermiso;

        return $this;
    }

    /**
     * Get idPermiso
     *
     * @return int
     */
    public function getIdPermiso()
    {
        return $this->idPermiso;
    }
}

