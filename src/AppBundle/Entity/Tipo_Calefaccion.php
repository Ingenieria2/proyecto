<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo_Calefaccion
 *
 * @ORM\Table(name="tipo__calefaccion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tipo_CalefaccionRepository")
 */
class Tipo_Calefaccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_calefaccion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_calefaccion;

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
     * @return Tipo_Calefaccion
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
     * Get idCalefaccion
     *
     * @return integer
     */
    public function getIdCalefaccion()
    {
        return $this->id_calefaccion;
    }
}
