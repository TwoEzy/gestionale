<?php

namespace Application\Controller;

use Application\Form\ClienteCreationForm;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClienteController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();

        /** @var EntityManager $em */
        $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        /** @var EntityRepository $clienteRepository */
        $clienteRepository = $em->getRepository('Application\Entity\Cliente');

        var_dump($clienteRepository->findAll());


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
                $cognome = $form->getData()['cognome'];
                $email = $form->getData()['email'];
                $telefono= $form->getData()['num'];


                /** @var EntityManager $em */
                $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

                $em->find('Application\Entity\Cliente', 1);

                $cliente = new Cliente();
                $cliente->setNome($nome);
                $cliente->setCognome($cognome);
                $cliente->setEmail($email);
                $cliente->setNumero($telefono);

                $em->persist($cliente);
                $em->flush();


            }
        }
        $viewModel->setVariable("form", $form);
        return $viewModel;

    }
}
