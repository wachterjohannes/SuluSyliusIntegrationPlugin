<?php

namespace spec\Sulu\SyliusIntegrationPlugin\Controller;

use PhpSpec\ObjectBehavior;
use Sulu\SyliusIntegrationPlugin\Controller\RedirectToSuluController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectToSuluControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RedirectToSuluController::class);
    }

    function it_should_return_redirect_esponse()
    {
        $this->redirectAction()->shouldBeLike(new RedirectResponse('http://127.0.0.1:8000/completed'));
    }
}
