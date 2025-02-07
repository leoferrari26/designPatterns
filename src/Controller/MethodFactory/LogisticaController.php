<?php

namespace App\Controller\MethodFactory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MethodFactory\LogisticaFactory;

class LogisticaController extends AbstractController
{   

    /**
     * @Route("/logistica", name="app_home_method_factory")
    */
    public function index()
    {
        return $this->render('MethodFactory/logistica.html.twig');
    }

    /**
     * @Route("/logistica/create", name="app_method_factory", methods={"POST"})
    */
    public function createTransport(Request $request): JsonResponse
    {
        $peso = (int) $request->request->get('peso');
        $altura = (float) $request->request->get('altura');
        $largura = (float) $request->request->get('largura');
        $km = (float) $request->request->get('km');
        $atravessaOceano = filter_var($request->request->get('atravessaOceano'), FILTER_VALIDATE_BOOLEAN);

        $transport = LogisticaFactory::criarTransporte($peso, $altura, $largura, $km, $atravessaOceano);
        
        return new JsonResponse(['status' => 'Transporte selecionado!', 'message' => $transport->entrega()]);
    }
}
