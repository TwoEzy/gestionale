<?php

namespace Application\Controller;

use Application\Form\ClienteCreationForm;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClienteController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function createAction()
    {
        $viewModel = new ViewModel();
        $form = new ClienteCreationForm();

        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());
            if ($form->isValid()) {
                $nome = $form->getData()['name'];
                echo $nome;
            }
        }
        $viewModel->setVariable("form", $form);
        return $viewModel;

    }
}
