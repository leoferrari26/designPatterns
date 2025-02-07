<?php

namespace App\Service\MethodFactory;

class TransporteNavio implements TransporteInterface
{

	 public function entrega(): string
    {
        return "Entrega via Navio";
    }
}