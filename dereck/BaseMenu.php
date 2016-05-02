<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseMenu
 *
 * @ORM\Table(name="base_menu", indexes={@ORM\Index(name="fk_base_menu_base_tipo1", columns={"tipo"})})
 * @ORM\Entity
 */
class BaseMenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmenu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmenu;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=true)
     */
    private $slug;

    /**
     * @var \BaseTipo
     *
     * @ORM\ManyToOne(targetEntity="BaseTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo", referencedColumnName="idtipo")
     * })
     */
    private $tipo;


}
