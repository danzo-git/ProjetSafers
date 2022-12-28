<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer
{   private $twig;
    private $mailer;
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer=$mailer;
        $this->twig=$twig;
    }

    // #[Route('/email')]
    public function sendEmail(string  $from,string $to,string $subject,string $text, string $template,array $parameters) :void
    {
        $email = (new Email())
            ->from($from)
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($text)
            ->html(
                $this->twig->render($template,$parameters),
                'text/html'
            );

        $this->mailer->send($email);

        // ...
    }
}
?>