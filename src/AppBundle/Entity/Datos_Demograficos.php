<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Datos_Demograficos
 *
 * @ORM\Table(name="datos__demograficos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Datos_DemograficosRepository")
 */
class Datos_Demograficos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_datos_demograficos", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_datos_demograficos;

    /**
     * @var int
     *
     * @ORM\Column(name="heladera", type="smallint")
     */
    private $heladera;

    /**
     * @var int
     *
     * @ORM\Column(name="electricidad", type="smallint")
     */
    private $electricidad;

    /**
     * @var int
     *
     * @ORM\Column(name="mascotas", type="smallint")
     */
    private $mascotas;

    /**
     * @var int
     *
     * @ORM\Column(name="borrado", type="smallint")
     */
    private $borrado;

    /**
     * @var int
     *
     * @ORM\Column(name="id_vivienda", type="integer")
     */
    private $idVivienda;

    /**
     * @var int
     *
     * @ORM\Column(name="id_agua", type="integer")
     */
    private $idAgua;

    /**
     * @var int
     *
     * @ORM\Column(name="id_calefaccion", type="integer")
     */
    private $idCalefaccion;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id_datos_demograficos;
    }

    /**
     * Set heladera
     *
     * @param integer $heladera
     *
     * @return Datos_Demograficos
     */
    public function setHeladera($heladera)
    {
        $this->heladera = $heladera;

        return $this;
    }

    /**
     * Set id_vivienda
     *
     * @param integer $idVivienda
     *
     * @return Datos_Demograficos
     */
    public function setIdVivienda($idVivienda)
    {
        $this->idVivienda = $idVivienda;

        return $this;
    }

    /**
     * Get id_vivienda
     *
     * @return int
     */
    public function getIdVivienda()
    {
        return $this->idVivienda;
    }

    /**
     * Set id_agua
     *
     * @param integer $idAgua
     *
     * @return Datos_Demograficos
     */
    public function setIdAgua($idAgua)
    {
        $this->idAgua = $idAgua;

        return $this;
    }

    /**
     * Get id_agua
     *
     * @return int
     */
    public function getIdAgua()
    {
        return $this->idAgua;
    }

     /**
     * Set id_calefaccion
     *
     * @param integer $idCalefaccion
     *
     * @return Datos_Demograficos
     */
    public function setIdCalefaccion($idCalefaccion)
    {
        $this->idCalefaccion = $idCalefaccion;

        return $this;
    }

    /**
     * Get id_calefaccion
     *
     * @return int
     */
    public function getIdCalefaccion()
    {
        return $this->idCalefaccion;
    }

    /**
     * Get heladera
     *
     * @return int
     */
    public function getHeladera()
    {
        return $this->heladera;
    }

    /**
     * Set electricidad
     *
     * @param integer $electricidad
     *
     * @return Datos_Demograficos
     */
    public function setElectricidad($electricidad)
    {
        $this->electricidad = $electricidad;

        return $this;
    }

    /**
     * Get electricidad
     *
     * @return int
     */
    public function getElectricidad()
    {
        return $this->electricidad;
    }

    /**
     * Set mascotas
     *
     * @param integer $mascotas
     *
     * @return Datos_Demograficos
     */
    public function setMascotas($mascotas)
    {
        $this->mascotas = $mascotas;

        return $this;
    }

    /**
     * Get mascotas
     *
     * @return int
     */
    public function getMascotas()
    {
        return $this->mascotas;
    }

    /**
     * Set borrado
     *
     * @param integer $borrado
     *
     * @return Datos_Demograficos
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
     * Get idDatosDemograficos
     *
     * @return integer
     */
    public function getIdDatosDemograficos()
    {
        return $this->id_datos_demograficos;
    }
}
