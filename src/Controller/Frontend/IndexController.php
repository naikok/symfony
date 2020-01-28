<?php
namespace App\Controller\Frontend;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class IndexController extends AbstractController
{
    /**
     * Returns main view
     */

    public function index()
    {
        return $this->render('views/form.html.twig', []);
    }
}