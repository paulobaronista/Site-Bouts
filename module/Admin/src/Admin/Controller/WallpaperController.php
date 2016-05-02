<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\File\Transfer\Adapter\Http AS httpUploadFile;
use Zend\Filter\File\Rename;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\ImageSize;

class WallpaperController extends AbstractActionController
{

	public function wallpaperAction()
    {
    	$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
    	$wallpaper = $doctrine->getRepository("Base\Entity\BaseConteudo")->findOneBymenu(5);
    	$layout = new ViewModel(array("wallpaper" => $wallpaper));
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function wallpaperCrudAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$requestPost = new httpUploadFile();
    		$requestPost->setDestination('./www/img/wallpapers');
    		foreach($requestPost->getFileInfo() as $file => $info)
    		{
    			$fname = $info['name'];
    			$filtro = $requestPost->addFilter(new Rename(array(
    					"target" => $fname,
    					"randomize" => true
    			)), null, $file);
    			if($requestPost->receive())
    			{
    				$service = $this->getServiceLocator()->get('Admin\Service\Wallpaper');
    				$service->insert(array("tituloImagem" => $this->getRequest()->getPost("titulo"), "src" => $filtro->getFileInfo()['imagem']['name']));
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
    		$repo = $doctrine->getRepository("Base\Entity\BaseImagens")->findOneByidbaseImagens($this->getRequest()->getPost("idAction"));
    		if(is_file('./www/img/wallpapers/'.$repo->getSrc()))
    		{
    			unlink('./www/img/wallpapers/'.$repo->getSrc());
    			$service = $this->getServiceLocator()->get("Admin\Service\Wallpaper");
    			$service->delete($this->getRequest()->getPost("idAction"));
    		}
    	}
    	$layout = new ViewModel(array("msg" => "Clipping removido com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
}

