<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\WordType;

use AppBundle\Entity\Word;
use AppBundle\Entity\Type;

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


            // type select 

            $typeRepo = $this->getDoctrine()->getRepository("AppBundle:Type");

            /*$id =1;
        
            $type= $typeRepo->find($id);
            $newWord->settype($type);
            */

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

    }
    /**
     * @Route("/Delete/{id}", name="delete")
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
     * @Route("/Show")
     * @Template()
     */
    public function ShowAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('AppBundle:Word');

        return $this->render('Word/Show.html.twig', array('posts' => $posts));
    }
    /**
     * @Route("/ShowSingle/{id}")
     * @Template()
     */
    public function ShowSingleAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Word')->find($id);

        return $this->render('Word/ShowSingle.html.twig', array('post' => $post));
    }
    /**
     * @Route("/Update/{id}", name="update")
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
     * @Route("/Vote/{id}", name="vote")
     * @Template()
     */
    public function VoteAction($id)
    {
        $wordRepo = $this->getDoctrine()->getRepository("AppBundle:Word");
        
        $word= $wordRepo->find($id);

        $vote = $word->getVote();

        $vote++;

        $word->setVote($vote);

        

        $em = $this->getDoctrine()->getManager();
        $em->persist($word);
        $em->flush();

        

    }

}
