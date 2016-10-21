<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class ApiCustomCookieListener
 * @package AppBundle\EventListener
 */
class ApiCustomCookieListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        // We only secure urls in our API
        if (strpos(
            $event->getRequest()->getPathInfo(),
            '/api/'
          ) !== 0
        ) {
            return;
        }

        $cookie = $event->getRequest()->headers->get('cookie');
        $double = $event->getRequest()->headers->get('X-Doubled-Cookie');

        if ($cookie !== $double) {
            $event->setResponse(
              new Response('', 400)
            );
        }
    }
}