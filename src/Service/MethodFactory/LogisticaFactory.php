<?php

namespace App\Service\MethodFactory;

use App\Service\MethodFactory\TransporteCaminhao;
use App\Service\MethodFactory\TransporteAereo;
use App\Service\MethodFactory\TransporteNavio;
use App\Service\MethodFactory\TransporteInterface;

class LogisticaFactory
{	
	public static function criarTransporte(int $peso, float $altura, float $largura, float $km, bool $atravessaOceano): TransporteInterface
    {
        if (self::deveUsarCaminhao($peso, $km, $atravessaOceano)) {
            return new TransporteCaminhao();
        }

        if (self::deveUsarAviao($peso, $altura, $largura, $atravessaOceano)) {
            return new TransporteAereo();
        }

        if (self::deveUsarNavio($peso, $altura, $largura, $atravessaOceano)) {
            return new TransporteNavio();
        }

        return new TransporteCaminhao();
    }

    private static function deveUsarCaminhao(int $peso, float $km, bool $atravessaOceano): bool
    {
        return !$atravessaOceano && $peso <= 10000 && $km < 1000;
    }

    private static function deveUsarAviao(int $peso, float $altura, float $largura, bool $atravessaOceano): bool
    {
        return $atravessaOceano && $peso <= 5000 && $altura <= 3 && $largura <= 2.5;
    }

    private static function deveUsarNavio(int $peso, float $altura, float $largura, bool $atravessaOceano): bool
    {
        return $atravessaOceano && ($peso > 5000 || $altura > 3 || $largura > 2.5);
    }

}
