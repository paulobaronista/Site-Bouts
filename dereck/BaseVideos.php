<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseVideos
 *
 * @ORM\Table(name="base_videos", indexes={@ORM\Index(name="fk_base_videos_base_conteudo1_idx", columns={"base_conteudo"})})
 * @ORM\Entity
 */
class BaseVideos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_videos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVideos;

    /**
     * @var string
     *
     * @ORM\Column(name="url_youtube", type="string", length=255, nullable=true)
     */
    private $urlYoutube;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var \BaseConteudo
     *
     * @ORM\ManyToOne(targetEntity="BaseConteudo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="base_conteudo", referencedColumnName="idconteudo")
     * })
     */
    private $baseConteudo;


}
