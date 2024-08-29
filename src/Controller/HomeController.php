<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ContactRepository $repository): Response
    {
        return $this->render('home/index.html.twig', [
            'contacts' => $repository->findAll(),
            'form' => $this->createForm(ContactType::class, new Contact()),
        ]);
    }

    #[Route('/create', name: 'app_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ContactType::class, new Contact());
        
        $contact = null;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $em->persist($contact);
            $em->flush();
            
            $form = $this->createForm(ContactType::class, new Contact()); // reset
        }
 
        $response = $this->render('home/_form.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact,
        ]);
 
        $hasErrors = $form->isSubmitted() && !$form->isValid();
        $statusCode = $hasErrors ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK;
        $response->setStatusCode($statusCode);

        return $response;
    }
}
