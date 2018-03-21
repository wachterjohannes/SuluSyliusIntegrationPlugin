<?php

namespace spec\Sulu\SyliusIntegrationPlugin\Producer;

use Doctrine\ORM\Event\LifecycleEventArgs;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sulu\SyliusIntegrationPlugin\Producer\ProductProducer;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Product\Model\ProductTranslationInterface;

class ProductProducerSpec extends ObjectBehavior
{
    function let(ProducerInterface $producer)
    {
        $this->beConstructedWith($producer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductProducer::class);
    }

    function it_should_use_only_product_interface_models(
        ProducerInterface $producer,
        LifecycleEventArgs $event,
        ProductTranslationInterface $notProduct
    ) {
        $event->getEntity()->willReturn($notProduct);
        $producer->publish(Argument::any())->shouldNotBeCalled();

        $this->postPersist($event);
    }

    function it_publishes_a_message_whenever_a_new_product_is_created(
        ProducerInterface $producer,
        LifecycleEventArgs $event,
        ProductInterface $product
    ) {
        $event->getEntity()->willReturn($product);

        $product->getCode()->willReturn('XYZ123');
        $product->getName()->willReturn('Sylius T-Shirt');
        $producer->publish(
            serialize(
                [
                    'code' => 'XYZ123',
                    'name' => 'Sylius T-Shirt'
                ]
            )
        )->shouldBeCalled();

        $this->postPersist($event);
    }
}
