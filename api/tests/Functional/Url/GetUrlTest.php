<?php

namespace App\Tests\Functional\Url;

/**
 * Class GetUrlTest
 *
 * @package App\Tests\Functional\Url
 */
class GetUrlTest extends BaseUrlTest
{
    public function testGetUrl(): void
    {
        $url = self::$urlRepository->findOneBy(['origin' => '/old/homepage']);

        static::createClient()->request(
            'GET',
            '/api/urls/'.$url->getId(),
            []
        );

        self::assertResponseStatusCodeSame(200);
        self::assertJsonContains(
            [
                '@context' => '/contexts/Url',
                '@id' => '/api/urls/'.$url->getId(),
                '@type' => 'Url',
                'origin' => $url->getOrigin(),
                'location' => $url->getLocation(),
            ]
        );
    }
}
