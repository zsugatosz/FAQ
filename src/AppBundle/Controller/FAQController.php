<?php
/**
 * Created by PhpStorm.
 * User: Skolem
 * Date: 2017. 01. 23.
 * Time: 22:56
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Answers;
use AppBundle\Form\AnswerForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FAQController extends Controller
{

    /**
     * @Route("/faq/{page}", name="faq_unique", requirements={"page": "\d+"})
     */

    public function showAction($page, Request $request)
    {
        $repositoryQuestions = $this->getDoctrine()
            ->getRepository('AppBundle:Questions');

        $questions = $repositoryQuestions->findBy(array('qId' => $page));

        if ($questions == null) {
            return $this->redirectToRoute('list');
        }

        $oneQuestion = $repositoryQuestions->find($page);

        $form = $this->createForm(AnswerForm::class);
        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($form->get('saveAnswer')->isClicked() && $form['answer']->getData() != null) {

                $newAnswer = new Answers();

                $oneQuestion->addAnswer($newAnswer->setAnswer($form->get('answer')->getData()));
                $newAnswer->setQuestionId($oneQuestion);

                $em = $this->getDoctrine()->getManager();
                $em->persist($newAnswer);
                $em->flush();

                return $this->redirectToRoute('faq_unique', array('page' => $page));
            }
        }

        return $this->render(
            'faq/faqUnique.html.twig',
            array('viewQuestion' => $questions,
                'faqForm' => $form->createView()
            )
        );

    }

}