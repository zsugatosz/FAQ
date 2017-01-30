<?php
/**
 * Created by PhpStorm.
 * User: Skolem
 * Date: 2017. 01. 23.
 * Time: 19:29
 */

namespace AppBundle\Controller;

use AppBundle\Form\QuestionForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class NewController extends Controller
{

    /**
     * @Route("/faq/new", name="new_question")
     */

    public function newAction(Request $request)
    {

        $form = $this->createForm(QuestionForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form['shortQuestion']->getData() != null) {

            $question = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            $qId = $question->getQId();
            return $this->redirectToRoute('faq_unique', array('page' => $qId));
        }

        return $this->render('faq/new.html.twig', [
            'faqForm' => $form->createView()
        ]);
    }


}