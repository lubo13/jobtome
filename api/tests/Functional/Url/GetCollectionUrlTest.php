<?php

namespace App\Tests\Functional\Url;

/**
 * Class GetCollectionUrlTest
 *
 * @package App\Tests\Functional\Url
 */
class GetCollectionUrlTest extends BaseUrlTest
{
    public function testGetCollectionUrl(): void
    {
        static::createClient()->request(
            'GET',
            '/api/urls',
            []
        );

        self::assertResponseStatusCodeSame(200);
        self::assertJsonContains(
            [
                '@context' => '/contexts/Url',
                '@id' => '/api/urls',
                '@type' => 'hydra:Collection',
                'hydra:member' => [
                ],
                'hydra:totalItems' => 4,
            ]
        );
    }
}
