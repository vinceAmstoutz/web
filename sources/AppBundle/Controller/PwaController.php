<?php

namespace AppBundle\Controller;

use AppBundle\Pwa\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PwaController extends Controller
{
    public function programAction()
    {
        $page = new Page('programDay1', 'programDay1');
        return $this->render(':pwa:talks.html.twig', ['talks' => [
            ['title' => 'titre 1', 'abstract' => 'Extrait 1', 'startHour' => '10h15', 'endHour' => '10h55'],
            ['title' => 'titre 2', 'abstract' => 'Extrait 2', 'startHour' => '10h15', 'endHour' => '10h55'],
            ['title' => 'titre 3', 'abstract' => 'Extrait 3', 'startHour' => '11h00', 'endHour' => '11h40'],
        ], 'page' => $page]);
    }

    public function locationAction()
    {
        $page = new Page('location', 'location');

        return $this->render(':pwa:location.html.twig', ['page' => $page]);
    }
}
