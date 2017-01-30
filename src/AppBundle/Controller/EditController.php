<?php
/**
 * Created by PhpStorm.
 * User: Skolem
 * Date: 2017. 01. 25.
 * Time: 16:45
 */

namespace AppBundle\Controller;

use AppBundle\Form\AnswerForm;
use AppBundle\Form\QuestionForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends Controller
{

    /**
     * @Route("/faq/edit", name="edit")
     */

    public function editAction(Request $request)
    {
        $createFormObject = NULL;
        $repositoryRoute = NULL;

        $statement = $request->query->get('statement');
        $id = $request->query->get('id');

        if ($statement == 'question') {

            $repositoryRoute = 'AppBundle:Questions';
            $createFormObject = QuestionForm::class;

        } else if ($statement == 'answer') {

            $repositoryRoute = 'AppBundle:Answers';
            $createFormObject = AnswerForm::class;

        } else {
            //hiba
        }

        $specificObject = $this->getDoctrine()->getRepository($repositoryRoute)->find($id);

        $form = $this->createForm($createFormObject, $specificObject);
        $form->handleRequest($request);

        if ($form->isValid()) {

            if ($form->has('saveQuestion') && $form->get('saveQuestion')->isClicked()) {

                $specificObject->setShortQuestion($form['shortQuestion']->getData());
                $specificObject->setLongQuestion($form['longQuestion']->getData());

            } else if ($form->has('saveAnswer') && $form->get('saveAnswer')->isClicked()) {

                $specificObject->setAnswer($form['answer']->getData());

                $id = $specificObject->getQuestionId()->getQId();
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

        } else {

            return $this->render('faq/edit.html.twig', [
                'faqForm' => $form->createView()
            ]);

        }

        return $this->redirectToRoute('faq_unique', array('page' => $id));
    }


}