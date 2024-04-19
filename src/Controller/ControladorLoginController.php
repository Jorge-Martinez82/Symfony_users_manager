<?php

namespace App\Controller;
// importo las clases
use App\Entity\Usuarios;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControladorLoginController extends AbstractController
{

    #[Route('/login', name: 'app_login')]// defino la ruta y su nombre
    // la funcion acepta una clase entity para interactuar con la BD y un request para procesar el formulario
    public function login(EntityManagerInterface $entityManager, Request $request): Response
    {

        // creo el formulario del tipo Login
        $form = $this->createForm(LoginType::class);
        // proceso los datos de la solicitud
        $form->handleRequest($request);

        // comprueba si el formulario se ha enviado y es valido
        if ($form->isSubmitted() && $form->isValid()) {
            // obtiene los datos del formulario
            $formData = $form->getData();

            // obtengo el repositorio de la clase Usuarios y busco el usuario en la base de datos
            $userRepository = $entityManager->getRepository(Usuarios::class);
            $user = $userRepository->findOneBy(['usuario' => $formData['usuario']]);

            // verifica si el usuario existe y su contraseña coincide
            if ($user && $user->getPassword() === $formData['password']) {
                // recarga la pagina mostrando un mensaje de exito
                return $this->render('login/index.html.twig', [
                    'form' => $form->createView(),
                    'message' => 'Login realizado correctamente',
                ]);
            } else {
                // si el  usuario no existe en la base de datos o la contraseña no coincide
                // recarga la pagina con un mensaje de error
                return $this->render('login/index.html.twig', [
                    'form' => $form->createView(),
                    'error_message' => 'Usuario o contraseña incorrectos',
                ]);
            }
        }

        // si el formulario no ha sido enviado simplemente renderizar el formulario
        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
