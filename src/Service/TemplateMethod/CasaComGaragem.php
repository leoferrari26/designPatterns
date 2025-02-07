<?php

namespace App\Service\TemplateMethod;

class CasaComGaragem extends ConstruirCasa {
    protected function adicionarExtras() {
        $this->casa['extra'] = 'Garagem adicionada';
    }
}
