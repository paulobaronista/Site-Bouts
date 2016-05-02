<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseImagens
 *
 * @ORM\Table(name="base_imagens", indexes={@ORM\Index(name="fk_base_imagens_base_conteudo1", columns={"conteudo"})})
 * @ORM\Entity
 */
class BaseImagens
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbase_imagens", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbaseImagens;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_imagem", type="string", length=45, nullable=true)
     */
    private $tituloImagem;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255, nullable=true)
     */
    private $src;

    /**
     * @var \BaseConteudo
     *
     * @ORM\ManyToOne(targetEntity="BaseConteudo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="conteudo", referencedColumnName="idconteudo")
     * })
     */
    private $conteudo;


}
