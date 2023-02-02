<?php

namespace App\Controller;

use App\Entity\Crew;
use App\Repository\CrewRepository;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/crew', name: 'crew_')]
class CrewController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CrewRepository $crewRepository, MemberRepository $memberRepository): Response
    {
        $crews = $crewRepository->findAll();
        // $members = $memberRepository->findOneBy();
        return $this->render('crew/index.html.twig', [
            // 'members' => $members,
            'crews' => $crews
        ]);
    }

    #[Route('/{crewName}', name: 'show')]
    public function show(string $crewName, CrewRepository $crewRepository, MemberRepository $memberRepository): Response
    {
        $crew = $crewRepository->findOneBy(['Name' => $crewName]);

        $crewId = $crew->getId();
        $members = $memberRepository->findOneBy(['crew' => $crewId]);

        return $this->render('crew/show.html.twig', [
            'crew' => $crew,
            'members' => $members,
        ]);
    }
}
