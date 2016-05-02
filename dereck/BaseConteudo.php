<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseConteudo
 *
 * @ORM\Table(name="base_conteudo", indexes={@ORM\Index(name="fk_base_conteudo_base_submenu1_idx", columns={"submenu"}), @ORM\Index(name="fk_base_conteudo_base_menu1_idx", columns={"menu"})})
 * @ORM\Entity
 */
class BaseConteudo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idconteudo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconteudo;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=true)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255, nullable=true)
     */
    private $src;

    /**
     * @var \BaseMenu
     *
     * @ORM\ManyToOne(targetEntity="BaseMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu", referencedColumnName="idmenu")
     * })
     */
    private $menu;

    /**
     * @var \BaseSubmenu
     *
     * @ORM\ManyToOne(targetEntity="BaseSubmenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="submenu", referencedColumnName="idbase_submenu")
     * })
     */
    private $submenu;


}
