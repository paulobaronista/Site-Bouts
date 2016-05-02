<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseSubmenu
 *
 * @ORM\Table(name="base_submenu", indexes={@ORM\Index(name="fk_base_submenu_base_menu1", columns={"menu"})})
 * @ORM\Entity
 */
class BaseSubmenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbase_submenu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idbaseSubmenu;

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

    /**
     * @var \BaseMenu
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="BaseMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu", referencedColumnName="idmenu")
     * })
     */
    private $menu;


}
