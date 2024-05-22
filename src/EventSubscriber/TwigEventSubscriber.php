<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Repository\ConferenceRepository;
use Twig\Environment;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class TwigEventSubscriber implements EventSubscriberInterface
{

    private $twig;
    private $conferenceRepository;
    private $logger;


    public function __construct(Environment $twig, ConferenceRepository $conferenceRepository,LoggerInterface $logger)
    {
        $this->twig = $twig;
        $this->conferenceRepository = $conferenceRepository;
        $this->logger = $logger;
    }
    public function onControllerEvent($event): void
    {
        $this->logger->info('TwigEventSubscriber: Adding global variable conferences to Twig');
        $this->twig->addGlobal('conferences', $this->conferenceRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'ControllerEvent' => 'onControllerEvent',
        ];
    }
}
