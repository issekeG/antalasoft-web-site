<?php

namespace App\Controller;
namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{
    #[Route('/antalasoft-contact', name: 'app_contact_mail')]
    public function sendEmail(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        $message = "";

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from('contact@antalasoft.com')
                ->to('contact@antalasoft.com')
                ->cc('i.gickelokabi@antalasoft.com')
                ->bcc('i.gickelokabi@gmail.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject($data->getSubject())
                ->text($data->getMessage())
                ->html("<p>{$data->getSubject()}</p><p>{$data->getMessage()}</p>");

            $mailer->send($email);


            $message = "Merci pour votre message, nous reviendrons vers vous dans un délai de 24 heures au plus.";


        }

        return $this->render('contact/contact-index.html.twig', [
            'message'=>$message,
            'contactForm' => $form->createView(),
        ]);

    }
}
