<?php

namespace App\Service\Bridge;

use App\Service\Bridge\DispositivoInterface;

class ControleRemoto
{
    protected DispositivoInterface $device;

    public function __construct(DispositivoInterface $device)
    {
        $this->device = $device;
    }

    public function togglePower(): void
    {
        if ($this->device->isEnabled()) {
            $this->device->disable();
        } else {
            $this->device->enable();
        }
    }

    public function volumeUp(): void
    {
        $this->device->setVolume($this->device->getVolume() + 10);
    }

    public function volumeDown(): void
    {
        $this->device->setVolume($this->device->getVolume() - 10);
    }

    public function channelUp(): void
    {
        $this->device->setChannel($this->device->getChannel() + 1);
    }

    public function channelDown(): void
    {
        $this->device->setChannel($this->device->getChannel() - 1);
    }
}
