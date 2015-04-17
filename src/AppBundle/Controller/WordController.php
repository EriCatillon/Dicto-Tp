<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WordController extends Controller
{
    /**
     * @Route("/Create")
     * @Template()
     */
    public function CreateAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/Word")
     * @Template()
     */
    public function WordAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/Delete")
     * @Template()
     */
    public function DeleteAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/Update")
     * @Template()
     */
    public function UpdateAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/Vote")
     * @Template()
     */
    public function VoteAction()
    {
        return array(
                // ...
            );    }

}
