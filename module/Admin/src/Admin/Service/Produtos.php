<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class Produtos extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Produto\Entity\ProdutoTenis";
    }
    public function insert(array $data)
    {
    		$this->setTargetEntity(array(
    				array("setTargetEntity" => "Produto\Entity\ProdutoSubcategoria",
    						"setCampo" => "setSubcategoriaTenis",
    						"setActionReference" => $data['subcategoria']),
    		));
    	$tenis = parent::insert($data);
    	$listaTecnologia = explode(",",$data['tecnologia']);
    	
    	$this->entity = "Base\Entity\BaseTecnologia";
    	foreach($listaTecnologia AS $tecnologia)
    	{
	    	$this->setTargetEntity(array(
	    			array("setTargetEntity" => "Produto\Entity\ProdutoTenis",
	    					"setCampo" => "setParenttenis",
	    					"setActionReference" => $tenis->getIdtenis()),
	    			array("setTargetEntity" => "Base\Entity\BaseSubmenu",
	    					"setCampo" => "setParenttecnologia",
	    					"setActionReference" => $tecnologia),
	    	));
	    	$retorno = parent::insert($data);
    	}	
    	return $retorno->getParenttenis();
    }
}

?>