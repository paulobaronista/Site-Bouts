<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseConteudo
 *
 * @ORM\Table(name="base_conteudo", indexes={@ORM\Index(name="fk_base_conteudo_base_submenu1", columns={"submenu", "menu"})})
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
     * @var \BaseSubmenu
     *
     * @ORM\ManyToOne(targetEntity="BaseSubmenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="submenu", referencedColumnName="idbase_submenu"),
     *   @ORM\JoinColumn(name="menu", referencedColumnName="menu")
     * })
     */
    private $submenu;


}
