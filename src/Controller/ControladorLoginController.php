<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControladorLoginController extends AbstractController
{

    #[Route('/login', name: 'app_login')]
    public function login(EntityManagerInterface $entityManager, Request $request): Response
    {

        // Crear el formulario de login
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);

        // Verificar si el formulario ha sido enviado y es válido
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener los datos del formulario
            $formData = $form->getData();

            // Buscar el usuario en la base de datos por el correo electrónico
            $userRepository = $entityManager->getRepository(Usuarios::class);
            $user = $userRepository->findOneBy(['usuario' => $formData['usuario']]);

            // Verificar si el usuario existe
            if ($user && $user->getPassword() === $formData['password']) {
                // El usuario existe en la base de datos y la contraseña coincide
                // Mostrar un mensaje de éxito en la misma página
                return $this->render('login/index.html.twig', [
                    'form' => $form->createView(),
                    'message' => 'Login realizado correctamente',
                ]);
            } else {
                // El usuario no existe en la base de datos o la contraseña no coincide
                // Mostrar un mensaje de error o redirigir al formulario de login con un mensaje de error
                return $this->render('login/index.html.twig', [
                    'form' => $form->createView(),
                    'error_message' => 'Usuario o contraseña incorrectos',
                ]);
            }
        }

        // Si el formulario no ha sido enviado o no es válido, simplemente renderizar el formulario
        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
