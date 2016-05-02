<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class Wallpaper extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Base\Entity\BaseImagens";
    }
    public function insert(array $data)
    {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Base\Entity\BaseConteudo",
    					"setCampo" => "setConteudo",
    					"setActionReference" => 4)
    	));
    	parent::insert($data);
    }
}

?>