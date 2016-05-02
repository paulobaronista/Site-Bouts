<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoSugestaoCores
 *
 * @ORM\Table(name="produto_sugestao_cores", indexes={@ORM\Index(name="fk_produto_sugestao_cores_produto_tenis1_idx", columns={"tenis"})})
 * @ORM\Entity
 */
class ProdutoSugestaoCores
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sugestao_cores", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSugestaoCores;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255, nullable=true)
     */
    private $src;

    /**
     * @var string
     *
     * @ORM\Column(name="nosso_numero", type="string", length=255, nullable=true)
     */
    private $nossoNumero;

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
