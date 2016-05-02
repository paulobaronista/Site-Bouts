<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoCategoria
 *
 * @ORM\Table(name="produto_categoria")
 * @ORM\Entity
 */
class ProdutoCategoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=true)
     */
    private $slug;


}
