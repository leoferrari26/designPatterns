<?php

namespace App\Service\Bridge;

class Radio implements DispositivoInterface
{
    private bool $enabled = false;
    private int $volume = 50;
    private int $channel = 1;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $percent): void
    {
        $this->volume = max(0, min(100, $percent));
    }

    public function getChannel(): int
    {
        return $this->channel;
    }

    public function setChannel(int $channel): void
    {
        $this->channel = $channel;
    }
}
