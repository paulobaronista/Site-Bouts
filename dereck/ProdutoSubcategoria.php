<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoSubcategoria
 *
 * @ORM\Table(name="produto_subcategoria", indexes={@ORM\Index(name="fk_produto_subcategoria_produto_categoria1", columns={"categoria"})})
 * @ORM\Entity
 */
class ProdutoSubcategoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idsubcategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsubcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var \ProdutoCategoria
     *
     * @ORM\ManyToOne(targetEntity="ProdutoCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria", referencedColumnName="idcategoria")
     * })
     */
    private $categoria;


}
