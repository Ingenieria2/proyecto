<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Control_Salud
 *
 * @ORM\Table(name="control__salud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Control_SaludRepository")
 */
class Control_Salud
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_control_salud", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_control_salud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

     /**
     * @var int
     *
     */
    private $edad;

    /**
     * @var int
     *
     * @ORM\Column(name="peso", type="integer")
     */
    private $peso;

    /**
     * @var int
     *
     * @ORM\Column(name="vacunas_completas", type="smallint")
     */
    private $vacunasCompletas;

    /**
     * @var string
     *
     * @ORM\Column(name="vacunas_observaciones", type="string", length=255)
     */
    private $vacunasObservaciones;

    /**
     * @var int
     *
     * @ORM\Column(name="maduracion_acorde", type="smallint")
     */
    private $maduracionAcorde;

    /**
     * @var string
     *
     * @ORM\Column(name="maduracion_observaciones", type="string", length=255)
     */
    private $maduracionObservaciones;

    /**
     * @var int
     *
     * @ORM\Column(name="examen_fisico_normal", type="smallint")
     */
    private $examenFisicoNormal;

    /**
     * @var string
     *
     * @ORM\Column(name="examen_fisico_observaciones", type="string", length=255)
     */
    private $examenFisicoObservaciones;

    /**
     * @var int
     *
     * @ORM\Column(name="pc", type="integer")
     */
    private $pc;

    /**
     * @var int
     *
     * @ORM\Column(name="ppc", type="integer")
     */
    private $ppc;

    /**
     * @var int
     *
     * @ORM\Column(name="talla", type="integer")
     */
    private $talla;

    /**
     * @var string
     *
     * @ORM\Column(name="alimentacion", type="string", length=255)
     */
    private $alimentacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_generales", type="string", length=255)
     */
    private $observacionesGenerales;

    /**
     * @var int
     *
     * @ORM\Column(name="borrado", type="smallint")
     */
    private $borrado;

     /**
     * @var int
     *
     * @ORM\Column(name="id_paciente", type="integer")
     */
    private $id_paciente;

    /**
     * @var int
     *
     * @ORM\Column(name="id_usuario", type="integer")
     */
    private $id_usuario;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id_control_salud;
    }

    /**
     * Set id_paciente
     *
     * @param integer $id_paciente
     *
     * @return Control_Salud
     */
    public function setIdPaciente($id)
    {
        $this->id_paciente = $id;

        return $this;
    }

    /**
     * Get id_paciente
     *
     * @return int
     */
    public function getIdPaciente()
    {
        return $this->id_paciente;
    }

    /**
     * Set id_usuario
     *
     * @param integer $id_usuario
     *
     * @return Control_Salud
     */
    public function setIdUsuario($id)
    {
        $this->id_usuario = $id;

        return $this;
    }

    /**
     * Get id_usuario
     *
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Control_Salud
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set peso
     *
     * @param integer $peso
     *
     * @return Control_Salud
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return int
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set vacunasCompletas
     *
     * @param integer $vacunasCompletas
     *
     * @return Control_Salud
     */
    public function setVacunasCompletas($vacunasCompletas)
    {
        $this->vacunasCompletas = $vacunasCompletas;

        return $this;
    }

    /**
     * Get vacunasCompletas
     *
     * @return int
     */
    public function getVacunasCompletas()
    {
        return $this->vacunasCompletas;
    }

    /**
     * Set vacunasObservaciones
     *
     * @param string $vacunasObservaciones
     *
     * @return Control_Salud
     */
    public function setVacunasObservaciones($vacunasObservaciones)
    {
        $this->vacunasObservaciones = $vacunasObservaciones;

        return $this;
    }

    /**
     * Get vacunasObservaciones
     *
     * @return string
     */
    public function getVacunasObservaciones()
    {
        return $this->vacunasObservaciones;
    }

    /**
     * Set maduracionAcorde
     *
     * @param integer $maduracionAcorde
     *
     * @return Control_Salud
     */
    public function setMaduracionAcorde($maduracionAcorde)
    {
        $this->maduracionAcorde = $maduracionAcorde;

        return $this;
    }

    /**
     * Get maduracionAcorde
     *
     * @return int
     */
    public function getMaduracionAcorde()
    {
        return $this->maduracionAcorde;
    }

    /**
     * Set maduracionObservaciones
     *
     * @param string $maduracionObservaciones
     *
     * @return Control_Salud
     */
    public function setMaduracionObservaciones($maduracionObservaciones)
    {
        $this->maduracionObservaciones = $maduracionObservaciones;

        return $this;
    }

    /**
     * Get maduracionObservaciones
     *
     * @return string
     */
    public function getMaduracionObservaciones()
    {
        return $this->maduracionObservaciones;
    }

    /**
     * Set examenFisicoNormal
     *
     * @param integer $examenFisicoNormal
     *
     * @return Control_Salud
     */
    public function setExamenFisicoNormal($examenFisicoNormal)
    {
        $this->examenFisicoNormal = $examenFisicoNormal;

        return $this;
    }

    /**
     * Get examenFisicoNormal
     *
     * @return int
     */
    public function getExamenFisicoNormal()
    {
        return $this->examenFisicoNormal;
    }

    /**
     * Set examenFisicoObservaciones
     *
     * @param string $examenFisicoObservaciones
     *
     * @return Control_Salud
     */
    public function setExamenFisicoObservaciones($examenFisicoObservaciones)
    {
        $this->examenFisicoObservaciones = $examenFisicoObservaciones;

        return $this;
    }

    /**
     * Get examenFisicoObservaciones
     *
     * @return string
     */
    public function getExamenFisicoObservaciones()
    {
        return $this->examenFisicoObservaciones;
    }

    /**
     * Set pc
     *
     * @param integer $pc
     *
     * @return Control_Salud
     */
    public function setPc($pc)
    {
        $this->pc = $pc;

        return $this;
    }

    /**
     * Get pc
     *
     * @return int
     */
    public function getPc()
    {
        return $this->pc;
    }

    /**
     * Set ppc
     *
     * @param integer $ppc
     *
     * @return Control_Salud
     */
    public function setPpc($ppc)
    {
        $this->ppc = $ppc;

        return $this;
    }

    /**
     * Get ppc
     *
     * @return int
     */
    public function getPpc()
    {
        return $this->ppc;
    }

    /**
     * Set talla
     *
     * @param integer $talla
     *
     * @return Control_Salud
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;

        return $this;
    }

    /**
     * Get talla
     *
     * @return int
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set alimentacion
     *
     * @param string $alimentacion
     *
     * @return Control_Salud
     */
    public function setAlimentacion($alimentacion)
    {
        $this->alimentacion = $alimentacion;

        return $this;
    }

    /**
     * Get alimentacion
     *
     * @return string
     */
    public function getAlimentacion()
    {
        return $this->alimentacion;
    }

    /**
     * Set observacionesGenerales
     *
     * @param string $observacionesGenerales
     *
     * @return Control_Salud
     */
    public function setObservacionesGenerales($observacionesGenerales)
    {
        $this->observacionesGenerales = $observacionesGenerales;

        return $this;
    }

    /**
     * Get observacionesGenerales
     *
     * @return string
     */
    public function getObservacionesGenerales()
    {
        return $this->observacionesGenerales;
    }

    /**
     * Set borrado
     *
     * @param integer $borrado
     *
     * @return Control_Salud
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
     * Get idControlSalud
     *
     * @return integer
     */
    public function getIdControlSalud()
    {
        return $this->id_control_salud;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return Control_Salud
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }
}
