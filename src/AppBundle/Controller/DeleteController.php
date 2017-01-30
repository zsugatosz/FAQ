<?php
/**
 * Created by PhpStorm.
 * User: Skolem
 * Date: 2017. 01. 24.
 * Time: 21:45
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DeleteController extends Controller
{
    /**
     * @Route("/faq/delete", name="delete")
     */
    public function deleteAction(Request $request)
    {
        $createFormObject = NULL;
        $repositoryRoute = NULL;

        $statement = $request->query->get('statement');
        $id = $request->query->get('id');

        if ($statement == 'question') {

            $repositoryRoute = 'AppBundle:Questions';

        } else if ($statement == 'answer') {

            $repositoryRoute = 'AppBundle:Answers';

        } else {
            //hiba
        }

        $specificObject = $this->getDoctrine()->getRepository($repositoryRoute)->find($id);
        $em = $this->getDoctrine()->getManager();

        if ($statement == 'question') {

            foreach ($specificObject->getAnswers() as $answers) {
                $em->remove($answers);
            }
        }

        $em->remove($specificObject);
        $em->flush();
        $em->clear();

        if ($statement == 'answer') {

            $qId = $specificObject->getQuestionId()->getQId();

            return $this->redirectToRoute('faq_unique', array('page' => $qId));
        }

        return new RedirectResponse($this->generateUrl('list'));
    }

}