<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ContactRepository $repository, Request $request): Response
    {
        $form = $this->createForm(ContactType::class, new Contact());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            dump($contact);
            // ... perform some action, such as saving the task to the database
        }

        return $this->render('home/index.html.twig', [
            'contacts' => $repository->findAll(),
            'form' => $form
        ]);
    }
}
