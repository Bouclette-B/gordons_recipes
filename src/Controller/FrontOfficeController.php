<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontOfficeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(PaginatorInterface $paginator, RecipeRepository $repo): Response
    {
        $recipes = $repo->findRandom();
        // foreach($recipes as $recipe) {
        //     $ratingDisplay = $this->displayRating($recipe);
        // }
        
        return $this->render('front_office/home.html.twig', [
            'recipes' => $recipes,
            // 'rating_display' => $ratingDisplay
        ]);
    }
    
    // public function displayRating(Recipe $recipe) {
    //     $ratingDisplay = '';
    //     for($i = 0; $i <= $recipe->getRating(); $i++) {
    //         $ratingDisplay.= '<img src="./assets/img/chef-hat-icon.svg." alt="Icone toque de cuisinier"></br>';
    //     }
    //     return $ratingDisplay;
    // }


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
