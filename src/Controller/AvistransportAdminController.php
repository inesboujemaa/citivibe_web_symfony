<?php

namespace App\Controller;

use App\Entity\Avistransport;
use App\Form\Avistransport1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/avistransport/admin')]
class AvistransportAdminController extends AbstractController
{
    #[Route('/', name: 'app_avistransport_admin_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $avistransports = $entityManager
            ->getRepository(Avistransport::class)
            ->findAll();

        return $this->render('avistransport_admin/index.html.twig', [
            'avistransports' => $avistransports,
        ]);
    }

    #[Route('/new', name: 'app_avistransport_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avistransport = new Avistransport();
        $form = $this->createForm(Avistransport1Type::class, $avistransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avistransport);
            $entityManager->flush();

            return $this->redirectToRoute('app_avistransport_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avistransport_admin/new.html.twig', [
            'avistransport' => $avistransport,
            'form' => $form,
        ]);
    }

    #[Route('/{idavis}', name: 'app_avistransport_admin_show', methods: ['GET'])]
    public function show(Avistransport $avistransport): Response
    {
        return $this->render('avistransport_admin/show.html.twig', [
            'avistransport' => $avistransport,
        ]);
    }

    #[Route('/{idavis}/edit', name: 'app_avistransport_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avistransport $avistransport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Avistransport1Type::class, $avistransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_avistransport_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avistransport_admin/edit.html.twig', [
            'avistransport' => $avistransport,
            'form' => $form,
        ]);
    }

    #[Route('/{idavis}', name: 'app_avistransport_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Avistransport $avistransport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avistransport->getIdavis(), $request->request->get('_token'))) {
            $entityManager->remove($avistransport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_avistransport_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
