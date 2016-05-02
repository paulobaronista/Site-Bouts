<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class OndeComprar extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Base\Entity\BaseSubmenu";
    }
    public function insert(array $data)
    {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Base\Entity\BaseMenu",
    					"setCampo" => "setBasemenu",
    					"setActionReference" => 1)
    	));
    	parent::insert($data);
    }
}

?>