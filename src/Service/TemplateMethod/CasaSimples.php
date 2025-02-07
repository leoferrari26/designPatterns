<?php

namespace App\Service\TemplateMethod;

class CasaSimples extends ConstruirCasa {
    protected function adicionarExtras() {
        $this->casa['extra'] = 'Sem adicionais';
    }
}
