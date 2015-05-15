<?php

	namespace AppBundle\Service;

	use AppBundle\Entity\Word;

	class SendMail
	{

		private $templating;
		private $mailer;

		public function __construct($templating, $mailer)
		{
			$this->templating = $templating;
			$this->mailer = $mailer;

		}

		public function SendMail($newWord, $view)
		{
			
			$message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('ericatillon@gmail.com')
            ->setTo('ericatillon@gmail.com')
            ->setBody($this->templating->render('Mail/'.$view.'.html.twig', array('name' => $newWord)));
			
            //$this->mailer->send($message);
            $this->mailer->send($message);
		}
	}