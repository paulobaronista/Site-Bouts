<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseTecnologia
 *
 * @ORM\Table(name="base_tecnologia", indexes={@ORM\Index(name="fk_base_tecnologia_produto_tenis1_idx", columns={"tenis"}), @ORM\Index(name="fk_base_tecnologia_base_submenu1_idx", columns={"tecnologia"})})
 * @ORM\Entity
 */
class BaseTecnologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_tecnologia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTecnologia;

    /**
     * @var \BaseSubmenu
     *
     * @ORM\ManyToOne(targetEntity="BaseSubmenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tecnologia", referencedColumnName="idbase_submenu")
     * })
     */
    private $tecnologia;

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
