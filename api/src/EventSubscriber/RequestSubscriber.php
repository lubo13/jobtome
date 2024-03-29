<?php

/**
 * @package
 * @author  Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Redirection;
use App\Repository\RedirectionRepository;
use App\Repository\UrlRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * Class RequestListener
 *
 * @package App\EventSubscriber
 * @author Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */
class RequestSubscriber implements EventSubscriberInterface
{
    private UrlRepository $urlRepository;

    private RedirectionRepository $redirectionRepository;

    public function __construct(UrlRepository $urlRepository, RedirectionRepository $redirectionRepository)
    {
        $this->urlRepository = $urlRepository;
        $this->redirectionRepository = $redirectionRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    /**
     * Because it is very basic and easy the logic of incrementation of the counter is here and not moved to service
     *
     * @param \Symfony\Component\HttpKernel\Event\RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event): void
    {
        $pathInfo = $event->getRequest()->getPathInfo();

        $url = $this->urlRepository->findOneBy(['origin' => $pathInfo]);

        if ($url) {
            $redirection = $this->redirectionRepository->findOneBy(['url' => $url]);

            if (! $redirection) {
                $redirection = new Redirection();
                $redirection->setUrl($url);
            }
            $redirection->incrementCounter();

            $this->redirectionRepository->save($redirection);

            $event->setResponse(new RedirectResponse($url->getLocation(), 302));
        }
    }
}
