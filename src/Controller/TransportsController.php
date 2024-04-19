<?php

namespace App\Controller;
use App\Entity\Transport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avistransport;
use App\Form\NouvelAvisType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class TransportsController extends AbstractController
{
    #[Route('/  ', name: 'app_transports')]
    public function index(): Response
    {
        return $this->render('Transport/index.html.twig');
    }

    #[Route('/AfficherU', name: 'app_afficher')]
    public function AfficherUser(EntityManagerInterface $entityManager): Response
    {
        $transports = $entityManager
            ->getRepository(Transport::class)
            ->findAll();
    
        return $this->render('Transport/index.html.twig', [
            'transports' => $transports,
        ]);
    }
    

    #[Route('/afficher123', name: 'app_transport_index', methods: ['GET'])]
    public function afficher12(EntityManagerInterface $entityManager,Request $request): Response
    {
        if($request->query->get('station_depart')&&$request->query->get('station_arrive')!=NULL){
            $station_depart=$request->query->get('station_depart');
            $station_arrive=$request->query->get('station_arrive');
            $transports = $entityManager
            ->getRepository(Transport::class)->findBy(['station_depart'=>$station_depart,'station_arrive'=>$station_arrive]);
            dd($transports);

        }
        $transports = $entityManager
            ->getRepository(Transport::class)
            ->findAll();

            return $this->render('Transport/USERpage.html.twig', [
                'transports' => $transports,
            ]);
    }


    
    #***********************************CHERCHER UN MOYEN DE TRANSPORT **************#
    #[Route('/search-transport', name:'search_transport', methods:['GET','POST'])]
    public function searchTransport(Request $request): Response
    {
        
        $stationDepart = $request->query->get('station_depart');
        $stationArrive = $request->query->get('station_arrive');
    
        if ($stationDepart && $stationArrive) {
            
            $transports = $this->getDoctrine()->getRepository(Transport::class)->findBy([
                'stationDepart' => $stationDepart,
                'stationArrive' => $stationArrive,
            ]);
    
            
            return $this->render('Transport/USERpage.html.twig', [
                'transports' => $transports,
                'station_depart' => $stationDepart,
                'station_arrive' => $stationArrive,
            ]);
        } else {
            
            return $this->render('Transport/USERpage.html.twig', [
                'transports' => [],
                'station_depart' => $stationDepart,
                'station_arrive' => $stationArrive,
            ]);
        }
}
#[Route('/submit-avis/{id}', name: 'submit_avis', methods: ['GET', 'POST'])]
public function submitAvis(Request $request, Transport $transport): Response
{
        $avis = new Avistransport();
        $form = $this->createForm(NouvelAvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $avis->setIdt($transport);

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();

          
            return $this->redirectToRoute('search_transport');
        }

        return $this->render('transport/avis.html.twig', [
            'form' => $form->createView(),
            'transport' => $transport,
        ]);
    }
    
}