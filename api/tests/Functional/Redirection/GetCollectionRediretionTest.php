<?php

namespace App\Tests\Functional\Redirection;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

/**
 * Class GreetingsTest
 *
 * @package App\Tests\Api
 */
class GetCollectionRediretionTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testGetRedirectionCollection(): void
    {
        static::createClient()->request('GET', '/api/redirections');

        self::assertResponseStatusCodeSame(200);
        self::assertJsonContains(
            [
                '@context' => '/contexts/Redirection',
                '@id' => '/api/redirections',
                '@type' => 'hydra:Collection',
                'hydra:member' => [
                ],
                'hydra:totalItems' => 2,
            ]
        );
    }
}
