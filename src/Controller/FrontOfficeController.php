<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recipe;



    class FrontOfficeController extends AbstractController
    {
         /**
         * @Route("/recipe/{id}", name="recipe_show")
         */
        public function showRecipe(Recipe $recipe): Response
        {   
            return $this->render('front_office/show.html.twig', [
                'recipe' => $recipe,
            ]);
        }
}
