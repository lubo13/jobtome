<?php

/**
 * @package
 * @author  Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */

declare(strict_types=1);

namespace App\Tests\Functional\Url;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Url;
use App\Repository\UrlRepository;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

/**
 * Class BaseUrlTest
 *
 * @package App\Tests\Functional\Url
 * @author Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */
abstract class BaseUrlTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    protected static UrlRepository|null $urlRepository = null;

    public static function setUpBeforeClass(): void
    {
        parent::createClient();
        $em = self::$container->get('doctrine')->getManager();
        self::$urlRepository = $em->getRepository(Url::class);
        $em = null;
    }

    public static function tearDownAfterClass(): void
    {
        self::$urlRepository = null;
    }
}
