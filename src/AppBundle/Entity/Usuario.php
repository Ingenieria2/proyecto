<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_usuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_usuario;

    /**
     *
     *@var array
     * @ORM\Column(type="json_array" , nullable = true)
     */
    private $roles = [];

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
    */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $username;

    /**
   * @Assert\NotBlank()
   * @Assert\Length(max=4096)
   */
   private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="activo", type="smallint")
     */
    private $activo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modificado_en", type="datetime")
     */
    private $modificadoEn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creado_en", type="datetime")
     */
    private $creadoEn;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var int
     *
     * @ORM\Column(name="borrado", type="smallint")
     */
    private $borrado;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id_usuario;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Usuario
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return Usuario
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return int
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set modificadoEn
     *
     * @param \DateTime $modificadoEn
     *
     * @return Usuario
     */
    public function setModificadoEn($modificadoEn)
    {
        $this->modificadoEn = $modificadoEn;

        return $this;
    }

    /**
     * Get modificadoEn
     *
     * @return \DateTime
     */
    public function getModificadoEn()
    {
        return $this->modificadoEn;
    }

    /**
    * Set creadoEn
    *
    * @param \DateTime $creadoEn
    *
    * @return Usuario
    */
    public function setCreadoEn($creadoEn)
    {
        $this->creadoEn = $creadoEn;

        return $this;
    }

    /**
    * Get creadoEn
    *
    * @return \DateTime
    */
    public function getCreadoEn()
    {
        return $this->creadoEn;
    }

    /**
    * Set nombre
    *
    * @param string $nombre
    *
    * @return Usuario
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

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Usuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set borrado
     *
     * @param integer $borrado
     *
     * @return Usuario
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return int
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    public function setRoles($roles)
    {
        $nuevoRoles = [];
        if ( sizeof($roles) > 0 )
        {
            foreach ($roles as $key => $value) {
                array_push($nuevoRoles,$value);
            }
        }
        $this->roles = $nuevoRoles;
    }

    /**
    * @return array(Role|string)[]
    */
    public function getRoles()
    {
        return $this->roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Get idUsuario
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }
}