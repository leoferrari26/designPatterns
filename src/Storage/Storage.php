<?php

namespace App\Storage;

class Storage
{
    private string $filePath;

    public function __construct($tipoDesign)
    {
        $this->filePath = __DIR__ . "/../../var/$tipoDesign.json";

        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([
                'tv' => ['power' => false, 'volume' => 50, 'channel' => 1],
                'radio' => ['power' => false, 'volume' => 30, 'channel' => 1]
            ], JSON_PRETTY_PRINT));
        }
    }

    public function getStorage($deviceType): array
    {
        $data = json_decode(file_get_contents($this->filePath), true);
        return $data[$deviceType] ?? ['power' => false, 'volume' => 50, 'channel' => 1];
    }

    public function saveStorage(array $state, $deviceType): void
    {
        $data = json_decode(file_get_contents($this->filePath), true);
        $data[$deviceType] = $state;
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
