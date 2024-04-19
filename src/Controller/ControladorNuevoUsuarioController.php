<?php

namespace App\Controller;
// importo las clases
use App\Entity\Usuarios;
use App\Form\NuevoUsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControladorNuevoUsuarioController extends AbstractController
{
    #[Route('/nuevoUsuario', name: 'app_nuevo_usuario')]// creo la ruta y su nombre
    // la funcion acepta una clase entity para interactuar con la BD y un request para procesar el formulario
    public function nuevoUsuario(EntityManagerInterface $entityManager,Request $request): Response
    {
        // creo una instancia de la entidad Usuario
        $usuario = new Usuarios();

        // creo el formulario utilizando el tipo de formulario NuevoUsuarioType y lo vinculo con la entidad Usuario
        $form = $this->createForm(NuevoUsuarioType::class, $usuario);
        // proceso los datos del formulario
        $form->handleRequest($request);

        // comprueba si el formulario se ha enviado y es valido
        if ($form->isSubmitted() && $form->isValid()) {
            // preparo el objeto y luego lo inserto en la BD
            $entityManager->persist($usuario);
            $entityManager->flush();
            // recargo la pagina y muestro un mensaje de exito
            return $this->render('nuevo_usuario/index.html.twig', [
                'form' => $form->createView(),
                'message' => 'Usuario creado correctamente',
            ]);
        }

        // si el formulario no ha sido enviado solo lo renderizo
        return $this->render('nuevo_usuario/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
