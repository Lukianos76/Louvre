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

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($booking);
            $this->em->flush();
        }
        return $this->render('pages/booking.html.twig', [
            'booking' => $booking,
            'form' => $form->createView()
        ]);


    }
}
