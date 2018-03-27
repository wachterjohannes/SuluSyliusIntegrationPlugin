<?php

namespace Sulu\SyliusIntegrationPlugin\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectToSuluController
{
    public function redirectAction()
    {
        return new RedirectResponse('http://127.0.0.1:8000/completed');
    }
}
