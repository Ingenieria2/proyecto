<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo_Documento
 *
 * @ORM\Table(name="tipo__documento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tipo_DocumentoRepository")
 */
class Tipo_Documento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tipo_documento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_tipo_documento;

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
     * @return Tipo_Documento
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
     * Get idTipoDocumento
     *
     * @return integer
     */
    public function getIdTipoDocumento()
    {
        return $this->id_tipo_documento;
    }
}
