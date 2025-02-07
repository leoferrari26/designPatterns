<?php

namespace App\Service\MethodFactory;

class TransporteAereo implements TransporteInterface
{

	 public function entrega(): string
    {
        return "Entrega via aviāo";
    }
}