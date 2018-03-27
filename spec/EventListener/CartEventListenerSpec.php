<?php

namespace spec\Sulu\SyliusIntegrationPlugin\EventListener;

use PhpSpec\ObjectBehavior;
use Sulu\SyliusIntegrationPlugin\EventListener\CartEventListener;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\OrderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartEventListenerSpec extends ObjectBehavior
{
    function let(SessionInterface $session)
    {
        $this->beConstructedWith($session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CartEventListener::class);
    }

    function is_should_set(
        SessionInterface $session,
        ResourceControllerEvent $event,
        OrderInterface $order
    ) {
        $event->getSubject()->willReturn($order);

        $order->getId()->willReturn(12345);

        $session->set('_sylius.cart', 12345)->shouldBeCalled();

        $this->handleUpdate($event);
    }
}
