<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\NuevoUsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControladorNuevoUsuarioController extends AbstractController
{
    #[Route('/nuevoUsuario', name: 'app_nuevo_usuario')]
    public function nuevoUsuario(EntityManagerInterface $entityManager,Request $request): Response
    {
        // Crear una instancia de la entidad Usuario
        $usuario = new Usuarios();

        // Crear el formulario utilizando el tipo de formulario NuevoUsuarioType
        $form = $this->createForm(NuevoUsuarioType::class, $usuario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Persistir el objeto Usuarios en la base de datos
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('app_inicio');
        }

        // Si el formulario no ha sido enviado o no es válido, renderizar el formulario
        return $this->render('nuevo_usuario/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
