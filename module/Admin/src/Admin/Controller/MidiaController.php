<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MidiaController extends AbstractActionController
{

	public function midiaAction()
    {
    	$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
    	$midia = $doctrine->getRepository("Base\Entity\BaseVideos")->findBy(array(), array('idVideos' => 'DESC'));
    	$layout = new ViewModel(array("midias" => $midia));
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function adicionaAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get("Admin\Service\Midia");
    		$service->insert(array("titulo" => $this->getRequest()->getPost("titulo"), "urlYoutube" => $this->getRequest()->getPost("url")));
    	}
    	$layout = new ViewModel(array("msg" => "Mídia adicionada com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
    public function deleteAction()
    {
    	if($this->getRequest()->isPost())
    	{
    		$service = $this->getServiceLocator()->get("Admin\Service\Midia");
    		$service->delete($this->getRequest()->getPost("idAction"));
    	}
    	$layout = new ViewModel(array("msg" => "Mídia removida com sucesso!"));
    	$layout->setTerminal(1);
    	return $layout;
    }
}

