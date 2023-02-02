<?php

namespace App\Controller;

use App\Entity\Crew;
use App\Form\CrewType;
use App\Repository\CrewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/crew')]
class AdminCrewController extends AbstractController
{
    #[Route('/', name: 'app_admin_crew_index', methods: ['GET'])]
    public function index(CrewRepository $crewRepository): Response
    {
        return $this->render('admin_crew/index.html.twig', [
            'crews' => $crewRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_crew_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CrewRepository $crewRepository): Response
    {
        $crew = new Crew();
        $form = $this->createForm(CrewType::class, $crew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $crewRepository->save($crew, true);

            return $this->redirectToRoute('app_admin_crew_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crew/new.html.twig', [
            'crew' => $crew,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crew_show', methods: ['GET'])]
    public function show(Crew $crew): Response
    {
        return $this->render('admin_crew/show.html.twig', [
            'crew' => $crew,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crew_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Crew $crew, CrewRepository $crewRepository): Response
    {
        $form = $this->createForm(CrewType::class, $crew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $crewRepository->save($crew, true);

            return $this->redirectToRoute('app_admin_crew_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crew/edit.html.twig', [
            'crew' => $crew,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crew_delete', methods: ['POST'])]
    public function delete(Request $request, Crew $crew, CrewRepository $crewRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $crew->getId(), $request->request->get('_token'))) {
            $crewRepository->remove($crew, true);
        }

        return $this->redirectToRoute('app_admin_crew_index', [], Response::HTTP_SEE_OTHER);
    }
}
