<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class Midia extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Base\Entity\BaseVideos";
    }
    public function insert(array $data)
    {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Base\Entity\BaseConteudo",
    					"setCampo" => "setConteudoOriginal",
    					"setActionReference" => 3)
    	));
    	parent::insert($data);
    }
}

?>