<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\File\Transfer\Adapter\Http AS httpUploadFile;
use Zend\Filter\File\Rename;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\ImageSize;

class BannerController extends AbstractActionController
{
	public function bannerAction()
    {
    	$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
    	$repo = $doctrine->getRepository("Base\Entity\BaseBanner");
    	$layout = new ViewModel(array("bannersDestaque" => $repo->findByNao(),"campanhaHome" => $repo->findOneBy(array("tipo" => 2))));
    	$layout->setTerminal(1);
        return $layout;
    }
    public function atualizaCampanhaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./www/img/banners');
    		$service = $this->getServiceLocator()->get('Admin\Service\Banner');
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			$fname = $info['name'];
    			$filtro = $requestPost->addFilter(new Rename(array(
    					"target" => $fname,
    					"randomize" => true
    			)), null, $file);
    			if($requestPost->receive())
    			{
    				$service->update(array("id" => 5,"src" => $filtro->getFileInfo()['imagemCampanha']['name']));
    			}
    		
    		}
    		if($this->getRequest()->getPost("titulo")){
    			$service->update(array("id" => 5,"titulo" => $this->getRequest()->getPost("titulo")));
    		}
    		if($this->getRequest()->getPost("url")){
    			$service->update(array("id" => 5,"url" => $this->getRequest()->getPost("url")));
    		}
    	}
    	$layout = new ViewModel();
    	$layout->setTerminal(1);
    	return $layout;
    }	
    public function bannerCrudAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./www/img/banners');
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			$fname = $info['name'];
    			$filtro = $requestPost->addFilter(new Rename(array(
    					"target" => $fname,
    					"randomize" => true
    			)), null, $file);
    			if($requestPost->receive())
    			{
    				$service = $this->getServiceLocator()->get('Admin\Service\Banner');
    				$service->insert(array("titulo" => $this->getRequest()->getPost("titulo"), "src" => $filtro->getFileInfo()['imagem']['name'], "url" => $this->getRequest()->getPost("url")));
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
    		$repo = $doctrine->getRepository("Base\Entity\BaseBanner")->findOneByidBanner($this->getRequest()->getPost("idAction"));
    		
    			@unlink('./www/img/banners/'.$repo->getSrc());
    			$service = $this->getServiceLocator()->get("Admin\Service\Banner");
    			$service->delete($this->getRequest()->getPost("idAction"));
    	}
    	$layout = new ViewModel(array("msg" => "Banner removido com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
}

