<?php

/**
 * @package
 * @author  Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Url;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomepageController
 *
 * @package App\Controller
 * @author Lubo Grozdanov <grozdanov.lubo@gmail.com>
 */
class HomepageController extends AbstractController
{
    #[Route(path: '/', name: 'homepage')]
    public function homepage(): Response
    {
        $urlRepository = $this->getDoctrine()->getRepository(Url::class);
        $urls = $urlRepository->findAll();

        return $this->render('homepage.html.twig', ['urls' => $urls]);
    }
}
