<?php

namespace Sulu\SyliusIntegrationPlugin\Producer;

use Doctrine\ORM\Event\LifecycleEventArgs;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Sylius\Component\Core\Model\ProductVariantInterface;

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
        $variant = $event->getEntity();
        if (!$variant instanceof ProductVariantInterface) {
            return;
        }

        $message = serialize(
            [
                'code' => $variant->getProduct()->getCode(),
                'name' => $variant->getProduct()->getName(),
                'variantCode' => $variant->getCode(),
                'variantName' => $variant->getName(),
                'price' => $variant->getChannelPricings()->first()->getPrice(),
            ]
        );

        $this->producer->publish($message);
    }
}
