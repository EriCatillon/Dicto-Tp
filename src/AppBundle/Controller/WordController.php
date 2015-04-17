<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\WordType;

use AppBundle\Entity\Word;

class WordController extends Controller
{
    /**
     * @Route("/Create")
     * @Template()
     */
    public function CreateAction(Request $request)
    {
        /*return array(
                // ...
            ); */
        $newWord = new Word();

        $WordForm = $this->createForm(new WordType,$newWord);

        $WordForm->handleRequest($request);

        if ($WordForm->isValid()) {

            //$newWord->setDateCreated( new Datetime() );
            $newWord->setvote(0);
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($newWord);
            $em->flush();

            $this->addFlash('success','Actu save');

        }
        $params = array(
            "wordForm" => $WordForm->createView()
        );


        return $this->render('Word/Create.html.twig',$params);
    }
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
     * @Route("/Delete/{id}")
     * @Template()
     */
    public function DeleteAction($id,Request $request)
    {
        $wordRepo = $this->getDoctrine()->getRepository("AppBundle:Word");
        
        $word= $wordRepo->find($id);


        if (!$word) {

            $this->addFlash('success','actu inexistante');

        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($word);
        $em->flush();

        $this->addFlash('success','actu update');

    }

    /**
     * @Route("/Update/{id}")
     * @Template()
     */
    public function UpdateAction($id,Request $request)
    {
        //return array(
                // ...
          //  );    
        $wordRepo = $this->getDoctrine()->getRepository("AppBundle:Word");
        
        $word= $wordRepo->find($id);

        $wordForm = $this->createForm(new WordType,$word);

        $wordForm->handleRequest($request);

        //dump($actu);

        //$actu->setTitle('reedsfre');

        //$em = $this->getDoctrine()->getManager();
        //$em->persist($actu);
        //$em->flush();
        if ($wordForm->isValid()) {
            // doctrine sauvegarde l'entité

            $em = $this->getDoctrine()->getManager();
            $em->persist($word);
            $em->flush();

            $this->addFlash('success','Actu save');

        }

        $params = array(
            "wordForm" => $wordForm->createView()
        );


        return $this->render('Word/Update.html.twig',$params);
    }

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
