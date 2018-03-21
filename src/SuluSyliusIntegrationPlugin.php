<?php

declare(strict_types=1);

namespace Sulu\SyliusIntegrationPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SuluSyliusIntegrationPlugin extends Bundle
{
    use SyliusPluginTrait;
}
