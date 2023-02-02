<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/member', name: 'member_')]
class MemberController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MemberRepository $memberRepository): Response
    {
        $members = $memberRepository->findAll();

        return $this->render('member/index.html.twig', [
            'members' => $members,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, MemberRepository $crewRepository): Response
    {
        $member = new Member();

        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $crewRepository->save($member, true);
            return $this->redirectToRoute('crew_index');
        }
        return $this->renderForm('member/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show(int $id, MemberRepository $memberRepository): Response
    {
        $member = $memberRepository->findOneBy(['id' => $id]);

        return $this->render('member/show.html.twig', [
            'member' => $member,
        ]);
    }
}
