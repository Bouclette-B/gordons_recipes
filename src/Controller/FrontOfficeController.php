<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\QuickSearchType;
use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontOfficeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(PaginatorInterface $paginator, RecipeRepository $repo, Request $request): Response
    {
        $searchForm = $this->createQuickSearchForm($request);
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            return $this->processQuickSearchForm($searchForm);
        } else {
            $recipes = $repo->findRandom();
            return $this->render('front_office/home.html.twig', [
                'recipes' => $recipes,
                'search_form' => $searchForm->createView(),
                'cards_title' => 'Les recettes à la Une'
                ]);
        }
    }

    /**
     * @Route("/recipe/{id}", name="recipe_show")
     */
    public function showRecipe(Recipe $recipe, Request $request): Response
    {   
        $searchForm = $this->createQuickSearchForm($request);

        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            return $this->processQuickSearchForm($searchForm);
        } else {

        return $this->render('front_office/show.html.twig', [
            'recipe' => $recipe,
            'search_form' => $searchForm->createView(),
            ]);
        }
    }
        
    /**
     * @Route("/search/{search}", name="recipe_search")
     */
    public function search(RecipeRepository $repo, $search, PaginatorInterface $paginator, Request $request) {

        if($search != null) {
            $recipes = $paginator->paginate($repo->findByName($search));
        } else {
            $recipes = $paginator->paginate($repo->findAll());
        }

        return $this->render('front_office/search.html.twig', [
            'recipes' => $recipes,
            'cards_title' => "Résultats de votre recherche",
            'search' => $search
            ]);
    }

    // Fonctions permettant de gérer le formulaire de recherche dans la navbar, à insérer dans chaque page
    public function createQuickSearchForm(Request $request) {
        $recipe = new Recipe;
        $searchForm = $this->createForm(QuickSearchType::class, $recipe);
        return $searchForm->handleRequest($request);
    }
    
    public function processQuickSearchForm($searchForm) {
            $search = $searchForm->getData();
            $search = $search->getName();
            return $this->redirectToRoute('recipe_search', ['search' =>$search]);    
    }


}

