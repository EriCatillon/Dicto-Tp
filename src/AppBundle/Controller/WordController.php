<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;

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
        //
        //$container->get('request')->getClientIp();

        /*$ip = $this->container->get('request')->getClientIp(); 

        var_dump($ip);*/
        

        $newWord = new Word();

        $WordForm = $this->createForm(new WordType,$newWord);

        $WordForm->handleRequest($request);

        $request = $this->get('request');
        $cookies = $request->cookies;


        if ($cookies->has('mail') && !$WordForm->isValid())
        {
            //$form = $WordForm->getForm();
            $WordForm->get('mail')->setData($cookies->get('mail'));
        }

        if ($WordForm->isValid()) {

            


            $newWord->setvote(0);

            $typeRepo = $this->getDoctrine()->getRepository("AppBundle:Type");

            $em = $this->getDoctrine()->getManager();
            $em->persist($newWord);
            $em->flush();
            // set cookie
            $value = $newWord->getmail();

            $cookie = new Cookie('mail', $value, (time() + 3600 * 24 * 7), '/');
            $response = new Response();
            $response->headers->setCookie($cookie);
            $response->send(); 


            // mail
            $this->get('send_mail')->SendMail($newWord,'Create');
            //
            return $this->redirect($this->generateUrl('app_word_show'));

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

        $this->get('send_mail')->SendMail($word,'Delete');


        $em = $this->getDoctrine()->getManager();
        $em->remove($word);
        $em->flush();

        

        $this->addFlash('success','actu update');

        return $this->redirect($this->generateUrl('app_word_show'));

    }
    /**
     * @Route("/Show")
     * @Template()
     */
    public function ShowAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('AppBundle:Word')->findBy(array(), array('theWord' => 'ASC'));

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
        
        $wordRepo = $this->getDoctrine()->getRepository("AppBundle:Word");
        
        $word= $wordRepo->find($id);

        $wordForm = $this->createForm(new WordType,$word);

        $wordForm->handleRequest($request);

        if ($wordForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($word);
            $em->flush();

            $this->addFlash('success','Actu save');

            // mail

            $this->get('send_mail')->SendMail($word,'Update');

            return $this->redirect($this->generateUrl('app_word_show'));

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

        $value = $word->gettheWord();

        $request = $this->get('request');
        $cookies = $request->cookies;

        if ($cookies->get('vote'.$id) == $value)
        {
            return $this->redirect($this->generateUrl('app_word_show'));

        }else{

            $cookie = new Cookie('vote'.$id, $value, (time() + 3600 * 24 * 7), '/');
            $response = new Response();
            $response->headers->setCookie($cookie);
            $response->send(); 

            $vote++;

            $word->setVote($vote);

            $em = $this->getDoctrine()->getManager();
            $em->persist($word);
            $em->flush();

            $post = $em->getRepository('AppBundle:Word')->find($id);

            return $this->render('Word/Vote.html.twig', array('post' => $post));        }

        
        
    }

}
