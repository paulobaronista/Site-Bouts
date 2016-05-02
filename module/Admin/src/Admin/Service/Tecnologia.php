<?php
namespace Admin\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Admin\Service\AbstractService;


class Tecnologia extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Base\Entity\BaseSubmenu";
    }
    public function insert(array $data)
    {
    	$this->entity = "Base\Entity\BaseSubmenu";
	    	$this->setTargetEntity(array(
	    			array("setTargetEntity" => "Base\Entity\BaseMenu",
	    					"setCampo" => "setBasemenu",
	    					"setActionReference" => 3),
	    	));
    	$BaseSubmenu = parent::insert(array("nome" => $data['titulo']));
    	
    	$this->entity = "Base\Entity\BaseConteudo";
    		$this->setTargetEntity(array(
    				array("setTargetEntity" => "Base\Entity\BaseSubmenu",
    						"setCampo" => "setSubmenu",
    						"setActionReference" => $BaseSubmenu->getIdbaseSubmenu()),
    				array("setTargetEntity" => "Base\Entity\BaseMenu",
    						"setCampo" => "setMenu",
    						"setActionReference" => 3),
    		));
    	$BaseConteudo = parent::insert(array("descricao" => $data['descricao'],"src" => $data['arquivos']['imagem_destaque'],"logo" => $data['arquivos']['logo']));
    	
    	$this->entity = "Base\Entity\BaseImagens";
	    	$this->setTargetEntity(array(
	    			array("setTargetEntity" => "Base\Entity\BaseConteudo",
	    					"setCampo" => "setConteudo",
	    					"setActionReference" => $BaseConteudo->getIdconteudo()),
	    	));
	    parent::insert(array("src" => $data['arquivos']['imagem_perspectiva_primeira'],"tituloImagem" => $data['titulo']));
	    parent::insert(array("src" => $data['arquivos']['imagem_perspectiva_segunda'],"tituloImagem" => $data['titulo']));
	    parent::insert(array("src" => $data['arquivos']['imagem_perspectiva_terceira'],"tituloImagem" => $data['titulo']));
	    parent::insert(array("src" => $data['arquivos']['imagem_perspectiva_quarta'],"tituloImagem" => $data['titulo']));
    }
    public function update(array $data)
    {
    	$repoConteudo = $this->em->getRepository("Base\Entity\BaseConteudo")->findOneBy(array("submenu" => $data['idTecnologia']));
    	if(isset($data['textos']['titulo'])) parent::update(array("id" => $data['idTecnologia'],"nome" => $data['textos']['titulo']));
    	$this->entity = "Base\Entity\BaseConteudo";
    	if(isset($data['textos']['descricao'])) parent::update(array("id" => $repoConteudo->getIdconteudo(), "descricao" => $data['textos']['descricao']));
    	if(isset($data['arquivos']['imagem_destaque'])) parent::update(array("id" => $repoConteudo->getIdconteudo(), "src" => $data['arquivos']['imagem_destaque']));
    	if(isset($data['arquivos']['logo'])) parent::update(array("id" => $repoConteudo->getIdconteudo(), "logo" => $data['arquivos']['logo']));
    	$this->entity = "Base\Entity\BaseImagens";
    	if(isset($data['arquivos']['imagem_perspectiva_primeira'])) parent::update(array("id" => $data['assets']['imagem_perspectiva_primeiraID'], "src" => $data['arquivos']['imagem_perspectiva_primeira']));
    	if(isset($data['arquivos']['imagem_perspectiva_segunda'])) parent::update(array("id" => $data['assets']['imagem_perspectiva_segundaID'], "src" => $data['arquivos']['imagem_perspectiva_segunda']));
    	if(isset($data['arquivos']['imagem_perspectiva_terceira'])) parent::update(array("id" => $data['assets']['imagem_perspectiva_terceiraID'], "src" => $data['arquivos']['imagem_perspectiva_terceira']));
    	if(isset($data['arquivos']['imagem_perspectiva_quarta'])) parent::update(array("id" => $data['assets']['imagem_perspectiva_quartaID'], "src" => $data['arquivos']['imagem_perspectiva_quarta']));
    }
    public function atualizaProdutoSets(array $data)
    {
    	$this->entity = "Base\Entity\BaseTecnologia";
    	$repositoryTecnologiasSets =  $this->em->getRepository("Base\Entity\BaseTecnologia")->findByparenttenis($data['idProduto']);
		foreach($repositoryTecnologiasSets AS $tecnologia)
		{
			parent::delete($tecnologia->getIdTecnologia());
		}
		foreach($data['listaSets'] AS $set)
		{
			$this->setTargetEntity(array(
					array("setTargetEntity" => "Produto\Entity\ProdutoTenis",
							"setCampo" => "setParenttenis",
							"setActionReference" => $data['idProduto']),
					array("setTargetEntity" => "Base\Entity\BaseSubmenu",
							"setCampo" => "setParenttecnologia",
							"setActionReference" => $set),
					));
			parent::insert(array());
		}
    }
}

?>