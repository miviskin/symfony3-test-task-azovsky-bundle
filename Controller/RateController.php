<?php

namespace Miviskin\AzovskyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class RateController extends Controller
{
    /**
     * @Route("/rate", name="rateIndex")
     */
    public function indexAction()
    {
        return $this->render('MiviskinAzovskyBundle:Rate:index.html.twig');
    }

    /**
     * @Route("/rate/{currency}", name="rateCurrency")
     */
    public function getAction($currency)
    {
        return new Response(
            str_replace(',', '.', $this->get('miviskin_azovsky.manager')->getCurrencyRate(strtoupper($currency)))
        );
    }
}
