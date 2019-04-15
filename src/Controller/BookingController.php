<?php
namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @property \Swift_Mailer mailer
 */
class BookingController extends AbstractController
{

    private $em;

    public function __construct(ObjectManager $em, \Swift_Mailer $mailer)
    {
        $this->em = $em;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/booking", name="booking")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request){
        $booking = new Booking();
        $form = $this->createForm(BookType::class, $booking);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid() && isset($_POST['stripeToken']))
        {
            \Stripe\Stripe::setApiKey("sk_test_q5wsT6LDmB3aM4eo8fvcm5e5");
            $token = $_POST['stripeToken'];
            $price = $_POST['price'];
            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $price,
                    'currency' => 'eur',
                    'description' => 'Paiement de test',
                    'source'  => $token,
                    'statement_descriptor' => 'Billets du Louvre'
                ]);

            } catch(\Stripe\Error\Card $e) {
                return $this->render('pages/error.html.twig', [
                    'e' => $e
                ]);
            }



            $this->em->persist($booking);
            $this->em->flush();

            $message = (new \Swift_Message())
                ->setFrom('noreply@luke-maury.fr')
                ->setTo($booking->getEmail())
                ->setSubject('Confirmation de votre commande')
                ->setBody(
                    $this->renderView(
                        'mail/mail.html.twig',
                        ['booking' => $booking]
                    ),
                    'text/html'
                );
            $this->mailer->send($message);

            return $this->render('pages/confirm.html.twig', [
               'booking' => $booking
            ]);
        }

        return $this->render('pages/booking.html.twig', [
            'booking' => $booking,
            'form' => $form->createView()
        ]);


    }






}
