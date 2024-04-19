<?php

namespace App\Controller;
use App\Entity\Transport; 
use App\Form\TransportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;



class TransportsAdminController extends AbstractController
{
   
    #[Route('/transports/admin', name: 'app_transports_admin')]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $transports = $entityManager->getRepository(Transport::class)->findAll();
    
        return $this->render('transports_admin/index.html.twig', [
            'transports' => $transports,
        ]);
    }
    
    //*******************************AFFICHER***********************************//
    #[Route('/afficher', name: 'app_transport_admin', methods: ['GET'])]
    public function afficher (EntityManagerInterface $entityManager): Response
    {
        $transports = $entityManager
            ->getRepository(Transport::class)
            ->findAll();

        return $this->render('transports_admin/index.html.twig', [
            'transports' => $transports,
        ]);
    }
    //*******************************AJOUTEER***********************************//

    #[Route('/ajouter', name: 'app_transport_ajouter', methods: ['GET', 'POST'])]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $transport = new Transport();
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transport);
            $entityManager->flush();

            return $this->redirectToRoute('app_transport_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Transport/new.html.twig', [
            'transport' => $transport,
            'form' => $form,
        ]);
    }
    //*****************************SUPPRIMER***********************************//
    #[Route('/{idt}', name: 'app_transport_delete', methods: ['POST'])]
    public function delete(Request $request, $idt, EntityManagerInterface $entityManager): Response
    {
        $transport = $entityManager->getRepository(Transport::class)->find($idt);
    
        if (!$transport) {
            throw $this->createNotFoundException('Transport non trouvé');
        }
    
        if ($this->isCsrfTokenValid('delete'.$transport->getIdt(), $request->request->get('_token'))) {
            $entityManager->remove($transport);
            $entityManager->flush();
        }
    
        
        $transports = $entityManager->getRepository(Transport::class)->findAll();
    
        
        return $this->render('transports_admin/index.html.twig', [
            'transports' => $transports,
            'controller_name' => 'TransportsAdminController',
        ]);
    }
    

    //*******************************Modifierr***********************************//

    #[Route('/{idt}/edit', name: 'app_transport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $idt, EntityManagerInterface $entityManager): Response
    {
        $transport = $entityManager->getRepository(Transport::class)->find($idt);
        if (!$transport) {
            throw $this->createNotFoundException('Transport not found');
        }
    
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_transports_admin', ['idt' => $idt]);
        }
        return $this->render('transports_admin/show.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
//**********************************show********************************************** */
  // #[Route('/{idt}', name: 'app_transport_show', methods: ['GET'])]
    //public function show(Transport $transport): Response
    //{
      //  return $this->render('transport/show.html.twig', [
        //    'transport' => $transport,
       // ]);
    //}

    


}
