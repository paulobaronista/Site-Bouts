<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class Vitrine extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Produto\Entity\ProdutoVitrine";
    }
    public function insert(array $data)
    {
    		$this->setTargetEntity(array(
    				array("setTargetEntity" => "Produto\Entity\ProdutoTenis",
    						"setCampo" => "setTenis",
    						"setActionReference" => $data['idProduto'])
    		));
    	return parent::insert($data);
    }
}

?>