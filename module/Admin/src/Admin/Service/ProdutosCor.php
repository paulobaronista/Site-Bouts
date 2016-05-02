<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class ProdutosCor extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Produto\Entity\ProdutoSugestaoCores";
    }
    public function insert(array $data)
    {
    		$this->setTargetEntity(array(
    				array("setTargetEntity" => "Produto\Entity\ProdutoTenis",
    						"setCampo" => "setTenisProduto",
    						"setActionReference" => $data['tenis']),
    		));
    	return parent::insert($data);
    }
}

?>