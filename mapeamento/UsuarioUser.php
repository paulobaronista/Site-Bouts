<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioUser
 *
 * @ORM\Table(name="usuario_user")
 * @ORM\Entity
 */
class UsuarioUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=45, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=45, nullable=true)
     */
    private $senha;


}
