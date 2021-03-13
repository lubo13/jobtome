<?php

namespace App\Tests\Functional\Redirection;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Redirection;
use App\Repository\RedirectionRepository;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

/**
 * Class GetRedirectionTest
 *
 * @package App\Tests\Functional\Redirection
 */
class GetRedirectionTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    protected static RedirectionRepository|null $redirectionRepository = null;

    public static function setUpBeforeClass(): void
    {
        parent::createClient();
        $em = self::$container->get('doctrine')->getManager();
        self::$redirectionRepository = $em->getRepository(Redirection::class);
        $em = null;
    }

    public static function tearDownAfterClass(): void
    {
        self::$redirectionRepository = null;
    }

    public function testGetRedirectionCollection(): void
    {
        $redirection = self::$redirectionRepository->findOneByUrlOrigin('/old/homepage');

        static::createClient()->request('GET', '/api/redirections/'.$redirection->getId());

        self::assertResponseStatusCodeSame(200);
        self::assertJsonContains(
            [
                '@context' => '/contexts/Redirection',
                '@id' => '/api/redirections/'.$redirection->getId(),
                '@type' => 'Redirection',
                'id' => $redirection->getId(),
                'counter' => $redirection->getCounter(),
                'url' => '/api/urls/'.$redirection->getUrl()->getId(),
            ]
        );
    }
}
