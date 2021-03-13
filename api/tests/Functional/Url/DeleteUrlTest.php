<?php

namespace App\Tests\Functional\Url;

/**
 * Class DeleteUrlTest
 *
 * @package App\Tests\Functional\Url
 */
class DeleteUrlTest extends BaseUrlTest
{
    public function testDeleteUrl(): void
    {
        $url = self::$urlRepository->findOneBy(['origin' => '/old/homepage']);

        static::createClient()->request(
            'DELETE',
            '/api/urls/'.$url->getId(),
            []
        );

        self::assertResponseStatusCodeSame(204);
    }
}
