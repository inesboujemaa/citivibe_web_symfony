<?php

namespace App\Controller;

use App\Entity\Avistransport;
use App\Entity\Transport;
use App\Form\AvistransportType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Transport\Transports;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avistransport')]
class AvistransportController extends AbstractController
{
    #[Route('/', name: 'app_avistransport_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $avistransports = $entityManager
            ->getRepository(Avistransport::class)
            ->findAll();

        return $this->render('avistransport/index.html.twig', [
            'avistransports' => $avistransports,
        ]);
    }

    #[Route('/new   ', name: 'app_avistransport_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avistransport = new Avistransport();
        $avistransport->setNote($request->query->get('note'));
        $avistransport->setAvis($request->query->get('avis'));
        $avistransport->setIdt($entityManager
            ->getRepository(Transport::class)
            ->findOneBy(['idt'=>$request->query->get('transport_id')]));
        // dd($entityManager
        // ->getRepository(Transports::class)
        // ->findOneBy(['idavis'=>$request->query->get('transport_id')]));
        
            $entityManager->persist($avistransport);
            $entityManager->flush();

            return $this->redirectToRoute('search_transport', [], Response::HTTP_SEE_OTHER);
        

        
    }

    #[Route('/{idavis}', name: 'app_avistransport_show', methods: ['GET'])]
    public function show(Avistransport $avistransport): Response
    {
        return $this->render('avistransport/show.html.twig', [
            'avistransport' => $avistransport,
        ]);
    }

    #[Route('/{idavis}/edit', name: 'app_avistransport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avistransport $avistransport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvistransportType::class, $avistransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avistransport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avistransport/edit.html.twig', [
            'avistransport' => $avistransport,
            'form' => $form,
        ]);
    }

    #[Route('/{idavis}', name: 'app_avistransport_delete', methods: ['POST'])]
    public function delete(Request $request, Avistransport $avistransport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avistransport->getIdavis(), $request->request->get('_token'))) {
            $entityManager->remove($avistransport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avistransport_index', [], Response::HTTP_SEE_OTHER);
    }
}
