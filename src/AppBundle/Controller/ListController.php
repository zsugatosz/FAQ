<?php
/**
 * Created by PhpStorm.
 * User: Skolem
 * Date: 2017. 01. 23.
 * Time: 19:57
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ListController extends Controller
{
    /**
     * @Route("/faq/list", name="list")
     */
    public function listAction()
    {
        $repositoryQuestions = $this->getDoctrine()
            ->getRepository('AppBundle:Questions');

        $questions = $repositoryQuestions->findAll();

        return $this->render(
            'faq/list.html.twig',
            array('viewQuestion' => $questions
            )
        );

    }


}