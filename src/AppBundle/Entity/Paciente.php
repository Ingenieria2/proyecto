<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PacienteRepository")
 */
class Paciente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_paciente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_paciente;


    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_Nac", type="date")
     */
    private $fechaNac;

    /**
     * @var int
     *
     * @ORM\Column(name="controlSalud", type="smallint")
     */
    private $controlSalud;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=1)
     */
    private $genero;

    /**
     * @var int
     *
     * @ORM\Column(name="documento", type="integer", length=12)
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="string", length=255)
     */
    private $domicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @var int
     *
     * @ORM\Column(name="borrado", type="smallint", length=1)
     */
    private $borrado;

    /**
     * @var int
     *
     * @ORM\Column(name="id_obra_social", type="integer")
     */
    private $idObraSocial;

    /**
     * @var int
     *
     * @ORM\Column(name="id_datos_demograficos", type="integer")
     */
    private $idDatosDemograficos;

    /**
     * @var int
     *
     * @ORM\Column(name="id_tipo_documento", type="integer")
     */
    private $idTipoDocumento;

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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Paciente
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
     * @param integer $controlSalud
     *
     * @return Paciente
     */
    public function setControlSalud($controlSalud)
    {
        $this->controlSalud = $controlSalud;

        return $this;
    }

    /**
     * Get controlSalud
     *
     * @return int
     */
    public function getControlSalud()
    {
        return $this->controlSalud;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Paciente
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
     * Set fechaNac
     *
     * @param \DateTime $fechaNac
     *
     * @return Paciente
     */
    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    /**
     * Get fechaNac
     *
     * @return \Date
     */
    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    /**
     * Set genero
     *
     * @param string $genero
     *
     * @return Paciente
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set documento
     *
     * @param integer $documento
     *
     * @return Paciente
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return int
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     *
     * @return Paciente
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Paciente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set borrado
     *
     * @param integer $borrado
     *
     * @return Paciente
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

    /**
     * Get idPaciente
     *
     * @return integer
     */
    public function getId_paciente()
    {
        return $this->id_paciente;
    }

    /**
     * Get fecha_Nac
     *
     * @return Date
     */
    public function getFecha_Nac()
    {
        return $this->id_paciente;
    }

    /**
     * Set id_datos_demograficos
     *
     * @param integer $idDatosDemograficos
     *
     * @return Paciente
     */
    public function setIdDatosDemograficos($idDatosDemograficos)
    {
        $this->idDatosDemograficos = $idDatosDemograficos;

        return $this;
    }

    /**
     * Get id_datos_demograficos
     *
     * @return int
     */
    public function getIdDatosDemograficos()
    {
        return $this->idDatosDemograficos;
    }

    /**
     * Set id_tipo_documento
     *
     * @param integer $idDatosDemograficos
     *
     * @return Paciente
     */
    public function setIdTipoDocumento($idTipoDocumento)
    {
        $this->idTipoDocumento = $idTipoDocumento;

        return $this;
    }

    /**
     * Get id_tipo_documento
     *
     * @return int
     */
    public function getIdTipoDocumento()
    {
        return $this->idTipoDocumento;
    }

    /**
     * Set id_obra_social
     *
     * @param integer $idObraSocial
     *
     * @return Paciente
     */
    public function setIdObraSocial($idObraSocial)
    {
        $this->idObraSocial = $idObraSocial;

        return $this;
    }

    /**
     * Get id_obra_social
     *
     * @return int
     */
    public function getIdObraSocial()
    {
        return $this->idObraSocial;
    }
}
