<?php

namespace Sulu\SyliusIntegrationPlugin\Producer;

use Doctrine\ORM\Event\LifecycleEventArgs;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Sylius\Component\Product\Model\ProductInterface;

class ProductProducer
{
    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    public function postPersist(LifecycleEventArgs $event)
    {
        $product = $event->getEntity();
        if (!$product instanceof ProductInterface) {
            return;
        }

        $message = serialize(['code' => $product->getCode(), 'name' => $product->getName()]);

        $this->producer->publish($message);
    }
}
