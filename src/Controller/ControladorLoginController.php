<?php

namespace App\Controller;

use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControladorLoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'ControladorLoginController',
        ]);
    }
//    #[Route('/creaUsuario', name: 'creaUsuario')]
//    public function creaUsuario(EntityManagerInterface $entityManager): Response
//    {
//        $usuario = new Usuarios();
//        $usuario->setUsuario('jorge@jorge.com');
//        $usuario->setContraseña('jorge');
//
//        $entityManager->persist($usuario);
//        $entityManager->flush();
//        return new Response('Usuario guardado con id: ' . $usuario->getId());
//    }
//
//    #[Route('/mostrarUsuario/{id}', name: 'mostrarUsuario')]
//    public function mostrarUsuario(EntityManagerInterface $entityManager, int $id): Response
//    {
//        $usuario = $entityManager->getRepository(Usuarios::class)->find($id);
//        if (!$usuario) {
//            throw $this->createNotFoundException('Usuario no encontrado');
//        }
//        return new Response('El nombre del Usuario es: ' . $usuario->getUsuario().
//        ' y su contraseña es: ' . $usuario->getContraseña());
//    }


}
