<?php

namespace App\Service\TemplateMethod;

abstract class ConstruirCasa {
    protected $casa = [];

    public function construir() {
        $this->construirEstrutura();
        $this->adicionarPortas();
        $this->adicionarJanelas();
        $this->adicionarTelhado();
        $this->adicionarExtras();
        return $this->casa;
    }

    protected function construirEstrutura() {
        $this->casa['estrutura'] = 'Estrutura da casa construída';
    }

    protected function adicionarPortas() {
        $this->casa['portas'] = 'Duas portas adicionadas';
    }

    protected function adicionarJanelas() {
        $this->casa['janelas'] = 'Três janelas adicionadas';
    }

    protected function adicionarTelhado() {
        $this->casa['telhado'] = 'Telhado construído';
    }

    protected abstract function adicionarExtras();
}
