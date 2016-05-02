<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class ProdutosSubCategoria extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Produto\Entity\ProdutoSubcategoria";
    }
    public function insert(array $data)
    {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Produto\Entity\ProdutoCategoria",
    					"setCampo" => "setCategoria",
    					"setActionReference" => $data['idCategoria'])
    	));
    	return parent::insert($data);
    }
}

?>