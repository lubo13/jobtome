<?php

namespace App\Tests\Functional\Url;

/**
 * Class PutUrlTest
 *
 * @package App\Tests\Functional\Url
 */
class PutUrlTest extends BaseUrlTest
{
    public function testPutUrl(): void
    {
        $url = self::$urlRepository->findOneBy(['origin' => '/old/homepage']);

        static::createClient()->request(
            'PUT',
            '/api/urls/'.$url->getId(),
            [
                'json' => [
                    'origin' => '/test/shortened',
                    'location' => '/new/test',
                ],
            ]
        );

        self::assertResponseStatusCodeSame(200);
        self::assertJsonContains(
            [
                '@context' => '/contexts/Url',
                '@type' => 'Url',
                'origin' => '/test/shortened',
                'location' => '/new/test',
            ]
        );
    }
}
