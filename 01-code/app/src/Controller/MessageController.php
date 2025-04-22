<?php 

namespace App\Controller ;

use App\Form\MessageType;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController{

    #[Route("/message", name: "home")]
    public function home ()
    {

        $form = $this->createForm(MessageType::class);

        return $this->render("message/exemple.html.twig", [
            "form" => $form->createView()
        ]);
    }

}