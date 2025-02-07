<?php

namespace App\Service\Bridge;

interface DispositivoInterface
{
    public function isEnabled(): bool;
    public function enable(): void;
    public function disable(): void;
    public function getVolume(): int;
    public function setVolume(int $percent): void;
    public function getChannel(): int;
    public function setChannel(int $channel): void;
}
