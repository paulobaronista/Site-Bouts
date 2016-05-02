<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class OndeComprarController extends AbstractActionController
{
	public function ondeComprarAction()
	{
		$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
		$repositoryOnde = $doctrine->getRepository("Base\Entity\BaseMenu")->findOneByidmenu(1);
		$layout = new ViewModel(array("ondeComprar" => $repositoryOnde));
		$layout->setTerminal(1);
		return $layout;
	}
	public function adicionaAction()
	{
		if($this->getRequest()->isPost())
		{
			$service = $this->getServiceLocator()->get("Admin\Service\OndeComprar");
			
			$service->insert(array("nome" => $this->getRequest()->getPost("titulo"),"url" => $this->getRequest()->getPost("url")));
		}
		$layout = new ViewModel(array("msg" => "Site adicionado com sucesso!"));
		$layout->setTerminal(1);
		return $layout;
	}
	public function deleteAction()
	{
		if($this->getRequest()->isPost())
		{
			$service = $this->getServiceLocator()->get("Admin\Service\OndeComprar");
			$service->delete($this->getRequest()->getPost("idAction"));
		}
		$layout = new ViewModel(array("msg" => "Mídia removida com sucesso!"));
		$layout->setTerminal(1);
		return $layout;
	}
}

