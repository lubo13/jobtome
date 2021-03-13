<?php

/**
 * @package
 * @author  Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\Url;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RedirectionTest
 *
 * @package App\Tests\Functional
 * @author Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */
class RedirectionTest extends WebTestCase
{
    use RefreshDatabaseTrait;

    public function testRelativeRedirection(): void
    {
        $client = static::createClient();

        $em = self::$container->get('doctrine')->getManager();
        /** @var \App\Repository\UrlRepository $urlRepository */
        $urlRepository = $em->getRepository(Url::class);
        $url = $urlRepository->findOneBy(['origin' => '/old/homepage']);

        $urlRedirectionCounter = 0;
        if ($url->getRedirection()) {
            $urlRedirectionCounter = $url->getRedirection()->getCounter();
        }

        $client->request('GET', $url->getOrigin());

        $em->refresh($url);
        self::assertResponseRedirects($url->getLocation());
        self::assertEquals($urlRedirectionCounter + 1, $url->getRedirection()->getCounter());
    }

    public function testAbsoluteRedirection(): void
    {
        $client = static::createClient();

        $em = self::$container->get('doctrine')->getManager();
        /** @var \App\Repository\UrlRepository $urlRepository */
        $urlRepository = $em->getRepository(Url::class);
        $url = $urlRepository->findOneBy(['origin' => '/jobtome']);

        $urlRedirectionCounter = 0;
        if ($url->getRedirection()) {
            $urlRedirectionCounter = $url->getRedirection()->getCounter();
        }

        $client->request('GET', $url->getOrigin());

        $em->refresh($url);
        self::assertResponseRedirects($url->getLocation());
        self::assertEquals($urlRedirectionCounter + 1, $url->getRedirection()->getCounter());
    }
}
