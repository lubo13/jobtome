<?php

namespace App\Tests\Functional\Url;

/**
 * Class PostUrlTest
 *
 * @package App\Tests\Functional\Url
 */
class PostUrlTest extends BaseUrlTest
{
    public function testPostUrl(): void
    {
        static::createClient()->request(
            'POST',
            '/api/urls',
            [
                'json' => [
                    'origin' => '/test/shortened',
                    'location' => '/new/test',
                ],
            ]
        );

        self::assertResponseStatusCodeSame(201);
        self::assertJsonContains(
            [
                '@context' => '/contexts/Url',
                '@type' => 'Url',
                'origin' => '/test/shortened',
                'location' => '/new/test',
                'redirection' => null,
            ]
        );
    }
}
