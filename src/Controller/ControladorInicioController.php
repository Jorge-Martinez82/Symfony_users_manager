<?php

namespace App\Controller;
// importo las clases necesarias
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControladorInicioController extends AbstractController
{

    #[Route('/inicio', name: 'app_inicio')] //define la ruta y el nombre de esta
    public function index(): Response
    {
        // renderiza la plantilla de este controlador
        return $this->render('inicio/index.html.twig', [
        ]);
    }
}
