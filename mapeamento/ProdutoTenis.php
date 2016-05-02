<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoTenis
 *
 * @ORM\Table(name="produto_tenis", indexes={@ORM\Index(name="fk_produto_tenis_produto_modelo1", columns={"modelo"}), @ORM\Index(name="fk_produto_tenis_produto_subcategoria1", columns={"subcategoria"})})
 * @ORM\Entity
 */
class ProdutoTenis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtenis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtenis;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=45, nullable=true)
     */
    private $src;

    /**
     * @var string
     *
     * @ORM\Column(name="nosso_numero", type="string", length=45, nullable=true)
     */
    private $nossoNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="numeracao_inicial", type="string", length=45, nullable=true)
     */
    private $numeracaoInicial;

    /**
     * @var string
     *
     * @ORM\Column(name="numeracao_final", type="string", length=45, nullable=true)
     */
    private $numeracaoFinal;

    /**
     * @var \ProdutoModelo
     *
     * @ORM\ManyToOne(targetEntity="ProdutoModelo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modelo", referencedColumnName="idmodelo")
     * })
     */
    private $modelo;

    /**
     * @var \ProdutoSubcategoria
     *
     * @ORM\ManyToOne(targetEntity="ProdutoSubcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subcategoria", referencedColumnName="idsubcategoria")
     * })
     */
    private $subcategoria;


}
