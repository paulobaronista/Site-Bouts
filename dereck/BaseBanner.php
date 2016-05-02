<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseBanner
 *
 * @ORM\Table(name="base_banner")
 * @ORM\Entity
 */
class BaseBanner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_banner", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBanner;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255, nullable=true)
     */
    private $src;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=true)
     */
    private $tipo = '1';


}
