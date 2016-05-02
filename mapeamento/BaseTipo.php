<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseTipo
 *
 * @ORM\Table(name="base_tipo")
 * @ORM\Entity
 */
class BaseTipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;


}
