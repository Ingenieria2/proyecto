<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo_Agua
 *
 * @ORM\Table(name="tipo__agua")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tipo_AguaRepository")
 */
class Tipo_Agua
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_agua", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_agua;

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
     * @return Tipo_Agua
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
     * Get idAgua
     *
     * @return integer
     */
    public function getIdAgua()
    {
        return $this->id_agua;
    }
}
