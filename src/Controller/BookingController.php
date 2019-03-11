<?php
namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{

    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
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
            \Stripe\Stripe::setApiKey("sk_test_4eC39HqLyjWDarjtT1zdp7dc");
            $token = $_POST['stripeToken'];
            $charge = \Stripe\Charge::create([
                'amount' => $_POST['price'],
                'currency' => 'eur',
                'description' => 'Paiement de test',
                'source' => $token,
            ]);

            $this->em->persist($booking);
            $this->em->flush();
        }

        return $this->render('pages/booking.html.twig', [
            'booking' => $booking,
            'form' => $form->createView()
        ]);


    }






}
