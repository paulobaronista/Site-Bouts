<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\File\Transfer\Adapter\Http AS httpUploadFile;
use Zend\Filter\File\Rename;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\ImageSize;

class TecnologiaAdmController extends AbstractActionController
{

	public function tecnologiaAdmAction()
    {
    	$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
    	$tecnologia = $doctrine->getRepository("Base\Entity\BaseConteudo")->findBymenu(3);
    	$layout = new ViewModel(array("tecnologia" => $tecnologia));
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function tecnologiaAdmCrudAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./www/img/tecnologia');
    		$produtoLast = null;
    		$erros = false;
    		$data = null;
    		$legenda = array('logo' => "Imagem do logo",
    			    'imagem_destaque' => 'Imagem de destaque',
    				'imagem_perspectiva_primeira' => 'Imagem da primeira perspectiva',
    				'imagem_perspectiva_segunda' => 'Imagem da segunda perspectiva',
    				'imagem_perspectiva_terceira' => 'Imagem da terceira perspectiva',
    				'imagem_perspectiva_quarta' => 'Imagem da quarta perspectiva'
    		);
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			if($file != "logo")
    			{
    				$tamanho = new ImageSize(array(
    					'minWidth' => 650, 'minHeight' => 400,
    				));
    			if(!$tamanho->isValid($info)) $erros .= $legenda[$file]." deve ter no mínimo 650x400\n";
    			}
    		}
    			if($erros == false)
    			{
			    		foreach($requestPost->getFileInfo() as $file => $info)
			    		{
			    				$erros = false;
			    				$fname = $info['name'];
			    				$ext = pathinfo($fname, PATHINFO_EXTENSION);
			    	
			    				$filtro = $requestPost->addFilters(array(new Rename(array(
			    						"target" => "load.".$ext,
			    						"randomize" => true
			    				))), null, $file);
			    				
			    				if($requestPost->receive() && $erros == false)
			    				{
			    					$data[$file] = $filtro->getFileInfo($file)[$file]['name'];
			    				}
			    		}
    					$service = $this->getServiceLocator()->get('Admin\Service\Tecnologia');
    					$service->insert(array("arquivos" => $data,"descricao" => $this->getRequest()->getPost("descricao"), "titulo" =>$this->getRequest()->getPost("titulo")));
    			}
    			else
    			{
    				print $erros;
    			}
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function editarAction()
    {
    	$requestPost = new httpUploadFile();
    	$requestPost->setDestination('./www/img/tecnologia');
    	$texto = array();
    	$data = array();
    	if($this->getRequest()->isPost())
    	{
    		if($this->getRequest()->getPost("titulo")) $texto['titulo'] = $this->getRequest()->getPost("titulo");
    		if($this->getRequest()->getPost("descricao")) $texto['descricao'] = $this->getRequest()->getPost("descricao");
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			$erros = false;
    			$fname = $info['name'];
    			$ext = pathinfo($fname, PATHINFO_EXTENSION);
    			
    			$filtro = $requestPost->addFilters(array(new Rename(array(
    					"target" => "load.".$ext,
    					"randomize" => true
    			))), null, $file);
    			 
    			if($requestPost->receive() && $erros == false)
    			{
    				$data[$file] = $filtro->getFileInfo($file)[$file]['name'];
    			}
    		}
    		
    		$service = $this->getServiceLocator()->get('Admin\Service\Tecnologia');
    		$service->update(array("arquivos" => $data,"textos" => $texto,"idTecnologia" => $this->getRequest()->getPost("idTecnologia"),"assets" => $this->getRequest()->getPost()->toArray()));
    	}
    	$layout = new ViewModel(array("msg" => "Tecnologia editada com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function deleteAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		
    		$service = $this->getServiceLocator()->get('Admin\Service\Tecnologia');
    		$service->delete($this->getRequest()->getPost("idAction"));
    	}
    	$layout = new ViewModel(array("msg" => "Tecnologia removida com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
}

