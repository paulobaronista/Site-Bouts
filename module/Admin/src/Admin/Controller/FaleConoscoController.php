<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FaleConoscoController extends AbstractActionController
{
	public function faleconoscoAction()
	{
		$doctrine = $this->getServiceLocator()->get("Doctrine\Orm\EntityManager");
    	$repo = $doctrine->getRepository("Base\Entity\BaseContato")->findAll();
		
		$view = new ViewModel(array("listaEmails" => $repo));
		$view->setTerminal(true);
		return $view;
	}
	public function inserirAction()
	{
		$request = $this->getRequest();
		if($request->isPost())
		{
		    $service = $this->getServiceLocator()->get("Admin\Service\Contato");
		    $service->insert(array("email" => $request->getPost("email"), "funcao" => $request->getPost("funcao")));
		}
		$view = new ViewModel();
		$view->setTerminal(true);
		return $view;
	}
	public function removerAction()
	{
		$request = $this->getRequest();
		if($request->isPost())
		{
			$service = $this->getServiceLocator()->get("Admin\Service\Contato");
			$service->delete($request->getPost("idEmail"));
		}
		$view = new ViewModel();
		$view->setTerminal(true);
		return $view;
	}
}

