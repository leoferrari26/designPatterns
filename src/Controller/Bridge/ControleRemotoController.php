<?php

namespace App\Controller\Bridge;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Bridge\TV;
use App\Service\Bridge\Radio;
use App\Service\Bridge\ControleRemoto;
use App\Storage\Storage;


class ControleRemotoController extends AbstractController
{   
    private $storage;

    public function __construct()
    {
        $this->storage = new Storage('Bridge');
    }
    /**
     * @Route("/controle-remoto", name="app_bridge")
     */
    public function control(Request $request): Response
    {   
        $deviceType = $request->query->get('device');
        $state = $this->storage->getStorage($deviceType);

        $device = $deviceType === 'radio' ? new Radio() : new TV();
        $remote = new ControleRemoto($device);

        if ($state['power']) {
            $device->enable();
        } else {
            $device->disable();
        }
        $device->setVolume($state['volume']);
        $device->setChannel($state['channel']);

        // Executar ação da interface
        $action = $request->query->get('action', '');
        switch ($action) {
            case 'togglePower':
                $remote->togglePower();
                break;
            case 'volumeUp':
                $remote->volumeUp();
                break;
            case 'volumeDown':
                $remote->volumeDown();
                break;
            case 'channelUp':
                $remote->channelUp();
                break;
            case 'channelDown':
                $remote->channelDown();
                break;
        }

        $this->storage->saveStorage([
            'device' => $deviceType,
            'power' => $device->isEnabled(),
            'volume' => $device->getVolume(),
            'channel' => $device->getChannel()
        ], $deviceType);

        return $this->render('Bridge/controleRemoto.html.twig', [
            'device' => $deviceType,
            'power' => $device->isEnabled() ? 'Ligado' : 'Desligado',
            'volume' => $device->getVolume(),
            'channel' => $device->getChannel(),
        ]);
    }
}
