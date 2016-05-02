<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * BaseNewslatter
 *
 * @ORM\Table(name="base_newslatter")
 * @ORM\Entity
 */
class BaseNewslatter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idnewslatter", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnewslatter;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="base_newslattercol", type="string", length=45, nullable=true)
     */
    private $baseNewslattercol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=true)
     */
    private $data = 'CURRENT_TIMESTAMP';


}
