<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo_Vivienda
 *
 * @ORM\Table(name="tipo__vivienda")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tipo_ViviendaRepository")
 */
class Tipo_Vivienda
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_vivienda", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_vivienda;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tipo_Vivienda
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
     * Get idVivienda
     *
     * @return integer
     */
    public function getIdVivienda()
    {
        return $this->id_vivienda;
    }
}
