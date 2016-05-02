<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class Perspectivas extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Produto\Entity\ProdutoPerspectivas";
    }
    public function insert(array $data)
    {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Produto\Entity\ProdutoTenis",
    					"setCampo" => "setProdutoTenis",
    					"setActionReference" => $data['idProduto'])
    	));
    	parent::insert($data);
    }
}

?>