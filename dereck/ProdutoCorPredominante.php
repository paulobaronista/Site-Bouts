<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoCorPredominante
 *
 * @ORM\Table(name="produto_cor_predominante", indexes={@ORM\Index(name="fk_produto_cor_predominante_produto_tenis1", columns={"tenis"})})
 * @ORM\Entity
 */
class ProdutoCorPredominante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcor_predominante", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcorPredominante;

    /**
     * @var string
     *
     * @ORM\Column(name="hexadecimal", type="string", length=100, nullable=false)
     */
    private $hexadecimal;

    /**
     * @var \ProdutoTenis
     *
     * @ORM\ManyToOne(targetEntity="ProdutoTenis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tenis", referencedColumnName="idtenis")
     * })
     */
    private $tenis;


}
