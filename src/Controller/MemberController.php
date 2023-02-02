<?php

namespace App\Controller;

use App\Service\CallApiService;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/member', name: 'member_')]
class MemberController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MemberRepository $memberRepository, CallApiService $callApiService): Response
    {
        $members = $memberRepository->findAll();

        return $this->render('member/index.html.twig', [
            'members' => $members,
            'data' => $callApiService->getOnePieceData(),
        ]);
    }
}
