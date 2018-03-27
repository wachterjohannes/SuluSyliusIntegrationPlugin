<?php

namespace Sulu\SyliusIntegrationPlugin\EventListener;

use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Order\Context\CartContextInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartEventListener
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var string
     */
    private $sessionKey;

    public function __construct(SessionInterface $session, string $sessionKey = '_sylius.cart')
    {
        $this->session = $session;
        $this->sessionKey = $sessionKey;
    }

    public function handleUpdate(ResourceControllerEvent $event)
    {
        $this->session->set($this->sessionKey, $event->getSubject()->getId());
    }
}
