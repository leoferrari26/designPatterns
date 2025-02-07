<?php

namespace App\Controller\TemplateMethod;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TemplateMethod\CasaSimples;
use App\Service\TemplateMethod\CasaComGaragem;

class CasaController extends AbstractController {
    private $jsonFile = '../var/TemplateMethod.json';

    /**
     * @Route("/casa", name="app_template_method")
    */
    public function index() {
        $casas = $this->getCasas();
        return $this->render('TemplateMethod/construirCasa.html.twig', [
            'casas' => $casas
        ]);
    }

    /**
     * @Route("/casa/construir", name="casa_construir", methods={"POST"})
    */
    public function construirCasa(Request $request) {
        $tipo = $request->request->get('tipo');

        $builder = ($tipo === 'garagem') ? new CasaComGaragem() : new CasaSimples();
        $casa = $builder->construir();

        $this->saveCasa($casa);
        return new JsonResponse(['status' => 'Casa construída!', 'casa' => $casa]);
    }

    private function getCasas() {
        if (!file_exists($this->jsonFile)) {
            return [];
        }
        return json_decode(file_get_contents($this->jsonFile), true);
    }

    private function saveCasa($casa) {
        $casas = $this->getCasas();
        $casas[] = $casa;
        file_put_contents($this->jsonFile, json_encode($casas, JSON_PRETTY_PRINT));
    }
}
