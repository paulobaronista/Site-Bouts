<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\File\Transfer\Adapter\Http AS httpUploadFile;
use Zend\Filter\File\Rename;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\ImageSize;

class ProdutosController extends AbstractActionController
{

	public function produtosAction()
    {
    	$doctrine = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    		$repositoryCategoria = $doctrine->getRepository("Produto\Entity\ProdutoCategoria")->findAll();
    		$repositoryTecnologias = $doctrine->getRepository("Base\Entity\BaseMenu")->findOneByidmenu(3);
    	$layout = new ViewModel(array(
    		"categorias" => $repositoryCategoria,
    		"tecnologia" => $repositoryTecnologias 
    	));
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function produtosCrudAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./www/img/produtos');
    		$produtoLast = null;
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			if($file == "imagem")
    			{
    				$erros = false;
	    			$fname = $info['name'];
	    			$ext = pathinfo($fname, PATHINFO_EXTENSION);
	    			
	    			$filtro = $requestPost->addFilters(array(new Rename(array(
	    					"target" => "load.".$ext,
	    					"randomize" => true
	    			))), null, $file);
	    			$tamanho = new ImageSize(array(
	    					'minWidth' => 650, 'minHeight' => 400,
	    			));
	    			$mime = new MimeType(array(
	    					'image/gif', 'image/jpg','image/png','image/jpeg',
	    					'enableHeaderCheck' => true
	    			));
	    			if(!$tamanho->isValid($info)) $erros = "- É necessário uma imagem com tamanho minimo de 650x400\n";
	    			//if(!$mime->isValid($info)) $erros = "- O tipo de arquivo suportado é gif, jpg, png\n";
	    			
	    			if($requestPost->receive() && $erros == false)
	    			{
	    				$im = new \Imagick();
	    				$im->readImage($filtro->getFileName("imagem"));
	    				$im->flattenImages();
	    				$im->setImageFormat('png');
	    				$im->thumbnailImage(650,400);
	    				$im->writeImage($filtro->getFileName("imagem")."big.png");
	    				$im->thumbnailImage(400,250);
	    				$im->writeImage($filtro->getFileName("imagem")."medio.png");
	    				$service = $this->getServiceLocator()->get('Admin\Service\Produtos');
	    				$produtoLast = $service->insert(array(
	    						"titulo" => $this->getRequest()->getPost("titulo"),
	    						"src" => $filtro->getFileInfo("imagem")['imagem']['name'],
	    						"subcategoria" => $this->getRequest()->getPost("subcategoria"),
	    						"numeracaoInicial" => $this->getRequest()->getPost("tamanhoMin"),
	    						"numeracaoFinal" => $this->getRequest()->getPost("tamanhoMax"),
	    						"tecnologia" => $this->getRequest()->getPost("tecnologia"),
	    						"nossoNumero" => $this->getRequest()->getPost("modelo"),
	    						"descricao" => $this->getRequest()->getPost("descricao")
	    				));
	    			}
	    			else
	    			{
	    				print $erros;
	    			}
    			}	
    			else if($file == "imagemVitrine")
    			{
    				$service = $this->getServiceLocator()->get('Admin\Service\Vitrine');
    				$service->insert(array("idProduto" => $produtoLast->getIdtenis(),
    									   "src" => $filtro->getFileInfo("imagemVitrine")['imagemVitrine']['name']));
    			}
    		}
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function populateCategoriaAjaxAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$doctrine = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    		$repositoryCategoria = $doctrine->getRepository("Produto\Entity\ProdutoCategoria")->findAll();
    
    		$layout = new ViewModel(array(
    				"listacategorias" => $repositoryCategoria,
    				"checked" => $this->getRequest()->getPost("checked")
    		));
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function populateSubcategoriaAjaxAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$doctrine = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    		$repositoryCategoria = $doctrine->getRepository("Produto\Entity\ProdutoCategoria")->findOneByidcategoria($this->getRequest()->getPost("idCategoria"));
    
    		$layout = new ViewModel(array(
    				"listaSubcategorias" => $repositoryCategoria->getSubcategorias(),
    				"checked" => $this->getRequest()->getPost("checked")
    		));
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function gerenciarPerspectivasAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
    		$pers = $doctrine->getRepository("Produto\Entity\ProdutoPerspectivas")->findByprodutoTenis($this->getRequest()->getPost("idProduto"));

    		$layout = new ViewModel(array("lista" => $pers));
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function removerPerspectivaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get("Admin\Service\Perspectivas");
    		$service->delete($this->getRequest()->getPost('idPerspectiva'));
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function adicionaPerspectivaAction()
    {
    	if($this->getRequest()->isPost())
    	{    		
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./www/img/produtos');
    		$produtoLast = null;
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			$erros = false;
    			$fname = $info['name'];
    			$ext = pathinfo($fname, PATHINFO_EXTENSION);
    			
    			$filtro = $requestPost->addFilters(array(new Rename(array(
    					"target" => "load.".$ext,
    					"randomize" => true
    			))), null, $file);
    			$tamanho = new ImageSize(array(
    					'minWidth' => 650, 'minHeight' => 400,
    			));
    			$mime = new MimeType(array(
    					'image/gif', 'image/jpg','image/png','image/jpeg',
    					'enableHeaderCheck' => true
    			));
    			if(!$tamanho->isValid($info)) $erros = "- É necessário uma imagem com tamanho minimo de 650x400\n";
    			//if(!$mime->isValid($info)) $erros = "- O tipo de arquivo suportado é gif, jpg, png\n";
    			
    			if($requestPost->receive() && $erros == false)
    			{
    				$im = new \Imagick();
    				$im->readImage($filtro->getFileName("imagem"));
    				$im->flattenImages();
    				$im->setImageFormat('png');
    				$im->thumbnailImage(650,400);
    				$im->writeImage($filtro->getFileName("imagem")."big.png");
    				$im->thumbnailImage(400,250);
    				$im->writeImage($filtro->getFileName("imagem")."medio.png");
    				$service = $this->getServiceLocator()->get('Admin\Service\Produtos');
    				
    				$service = $this->getServiceLocator()->get("Admin\Service\Perspectivas");
    				$service->insert(array("idProduto" => $this->getRequest()->getPost("idProduto"), "src" => $filtro->getFileInfo("imagem")['imagem']['name']));
    				
    				
    			}
    			else
    			{
    				print $erros;
    			}
    		}
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function deleteAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
    		$vitrine = $doctrine->getRepository("Produto\Entity\ProdutoVitrine")->findOneBytenis($this->getRequest()->getPost("idAction"));
    		if($vitrine)
    		{
    			$service = $this->getServiceLocator()->get("Admin\Service\Vitrine");
    			$service->delete($vitrine->getIdvitrine());
    		}
    		$service = $this->getServiceLocator()->get("Admin\Service\Produtos");
    		$service->delete($this->getRequest()->getPost("idAction"));
    	}
    	$layout = new ViewModel(array("msg" => "Produto removido com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function adicionaCategoriaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosCategoria');
    		$retorno = $service->insert(array('nome' => $this->getRequest()->getPost("titulo")));
    		$layout = new ViewModel(array("msg" => $retorno->getIdcategoria()));
    	}
    	else
    	{
    		$layout = new ViewModel();
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function editarCategoriaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosCategoria');  		
    		$retorno = $service->update(array("id" => $this->getRequest()->getPost("idCategoria"), "nome" =>  $this->getRequest()->getPost("valor")));
    		$layout = new ViewModel(array("msg" => $retorno->getIdcategoria()));
    	}
    	else
    	{
    		$layout = new ViewModel();
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function adicionaSubCategoriaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosSubCategoria');
    		$retorno = $service->insert(array('nome' => $this->getRequest()->getPost("titulo"), "idCategoria" => $this->getRequest()->getPost("categoria")));
    		$layout = new ViewModel(array("msg" => $retorno->getIdsubcategoria()));
    	}
    	else
    	{
    		$layout = new ViewModel();
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function editarSubCategoriaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosSubCategoria');
    		$retorno = $service->update(array("id" => $this->getRequest()->getPost("idCategoria"), "nome" =>  $this->getRequest()->getPost("valor")));
    		$layout = new ViewModel(array("msg" => $retorno->getIdsubcategoria()));
    	}
    	else
    	{
    		$layout = new ViewModel();
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function populateCategoriaAndSubcategoriaAjaxAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$doctrine = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    		$repositoryCategoria = $doctrine->getRepository("Produto\Entity\ProdutoCategoria")->findAll();
    	
    		$layout = new ViewModel(array(
    				"categorias" => $repositoryCategoria
    		));
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function deleteCategoriaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosCategoria');
    		$service->delete($this->getRequest()->getPost("idCategoria"));
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function deleteSubCategoriaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosSubCategoria');
    		$service->delete($this->getRequest()->getPost("idSubcategoria"));
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function salvarTecnologiaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$sets = explode(",", $this->getRequest()->getPost("tecnologia"));
    		$service = $this->getServiceLocator()->get("Admin\Service\Tecnologia");
    		$service->atualizaProdutoSets(array("listaSets" => $sets, "idProduto" => $this->getRequest()->getPost("idProduto")));
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function editarTecnologiaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$tecSet = array();
    	$doctrine = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    	$repositoryTecnologias = $doctrine->getRepository("Base\Entity\BaseMenu")->findOneByidmenu(3);
    	$repositoryTecnologiasSets =  $doctrine->getRepository("Base\Entity\BaseTecnologia")->findByparenttenis($this->getRequest()->getPost("idProduto"));
    		foreach($repositoryTecnologiasSets AS $set)
    		{
    			$tecSet[] = $set->getParenttecnologia()->getIdbaseSubmenu();
    		}
    		
    	$layout = new ViewModel(array("tecnologias" => $repositoryTecnologias,"Sets" => $tecSet));
    	}
    	else
    	{
    	$layout = new ViewModel();
    	}
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function adicionaCorAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosCor');
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./www/img/produtos');
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			$erros = false;
    			$fname = $info['name'];
    			$ext = pathinfo($fname, PATHINFO_EXTENSION);
    			
    			$filtro = $requestPost->addFilters(array(new Rename(array(
    					"target" => "load.".$ext,
    					"randomize" => true
    			))), null, $file);
    			$tamanho = new ImageSize(array(
    					'minWidth' => 650, 'minHeight' => 400,
    			));
    			$mime = new MimeType(array(
    					'image/gif', 'image/jpg','image/png','image/jpeg',
    					'enableHeaderCheck' => true
    			));
    			if(!$tamanho->isValid($info)) $erros = "- É necessário uma imagem com tamanho minimo de 650x400\n";
    			//if(!$mime->isValid($info)) $erros = "- O tipo de arquivo suportado é gif, jpg, png\n";
    			
    			if($requestPost->receive() && $erros == false)
    			{
    				$im = new \Imagick();
    				$im->readImage($filtro->getFileName("imagem"));
    				$im->flattenImages();
    				$im->setImageFormat('png');
    				$im->thumbnailImage(650,400);
    				$im->writeImage($filtro->getFileName("imagem")."big.png");
    				$im->thumbnailImage(400,250);
    				$im->writeImage($filtro->getFileName("imagem")."medio.png");
    				$service->insert(array("tenis" => $this->getRequest()->getPost("idProduto"),"nossoNumero" => $this->getRequest()->getPost("modelo"), "src" => $filtro->getFileInfo("imagem")['imagem']['name']));
    				
    			}
    			else
    			{
    				print $erros;
    			}
    		}
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function deleteSugestaoAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get('Admin\Service\ProdutosCor');
    		$service->delete($this->getRequest()->getPost("idAction"));
    	}
    	$layout = new ViewModel(array("msg" => "Sugestão removida com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
    
}

