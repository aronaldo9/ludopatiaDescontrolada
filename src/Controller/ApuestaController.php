<?php

namespace App\Controller;

use App\Entity\Apuesta;
use App\Form\ApuestaType;
use App\Repository\ApuestaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/apuesta')]
class ApuestaController extends AbstractController
{
    #[Route('/', name: 'app_apuesta_index', methods: ['GET'])]
    public function index(ApuestaRepository $apuestaRepository): Response
    {
        return $this->render('apuesta/index.html.twig', [
            'apuestas' => $apuestaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_apuesta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $apuestum = new Apuesta();
        $form = $this->createForm(ApuestaType::class, $apuestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($apuestum);
            $entityManager->flush();

            return $this->redirectToRoute('app_apuesta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('apuesta/new.html.twig', [
            'apuestum' => $apuestum,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_apuesta_show', methods: ['GET'])]
    public function show(Apuesta $apuestum): Response
    {
        return $this->render('apuesta/show.html.twig', [
            'apuestum' => $apuestum,
        ]);
    }

    #[Route('/{id}/comprar/{precio}', name: 'app_apuesta_comprar', methods: ['GET'])]
    public function comprar(Apuesta $apuestum, $precio, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('Acceso denegado. Debes estar autenticado para ver esta página.');
        }
        // Verificar si la apuesta ya tiene un usuario asignado
        $compraExitosa = $user->newGasto($precio);

        if (!$compraExitosa) {
            // La compra no se pudo realizar debido a fondos insuficientes
            // Puedes manejar esto de alguna manera, como redirigir a una página de error
            // o mostrar un mensaje al usuario
            return $this->redirectToRoute('app_user_index');
        }
            if (!$apuestum->getUsuario()) {
                $apuestum->setUsuario($user);
                $entityManager->flush();
        
                return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
            }else{
    
            }
        

    
        return $this->render('main/index.html.twig', [
            'apuestum' => $apuestum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_apuesta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Apuesta $apuestum, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ApuestaType::class, $apuestum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           // $apuestum->setUser($this->getUser());
           // $entityManager->flush();

            return $this->redirectToRoute('app_apuesta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('apuesta/edit.html.twig', [
            'apuestum' => $apuestum,
            'form' => $form,
        ]);
    }
   

    #[Route('/{id}', name: 'app_apuesta_delete', methods: ['POST'])]
    public function delete(Request $request, Apuesta $apuestum, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apuestum->getId(), $request->request->get('_token'))) {
            $entityManager->remove($apuestum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_apuesta_index', [], Response::HTTP_SEE_OTHER);
    }
}
