<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario_Tiene_Rol
 *
 * @ORM\Table(name="usuario_tiene_rol")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Usuario_Tiene_RolRepository")
 */
class Usuario_Tiene_Rol
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
     * @ORM\Column(name="id_usuario", type="integer")
     */
    private $idUsuario;


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
     * @return Usuario_Tiene_Rol
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
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return Usuario_Tiene_Rol
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}