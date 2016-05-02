<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoModelo
 *
 * @ORM\Table(name="produto_modelo")
 * @ORM\Entity
 */
class ProdutoModelo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmodelo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmodelo;

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
