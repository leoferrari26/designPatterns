<?php

namespace App\Service\MethodFactory;

class TransporteCaminhao implements TransporteInterface
{

	 public function entrega(): string
    {
        return "Entrega via Caminhão";
    }
}