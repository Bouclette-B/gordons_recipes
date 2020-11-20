<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CommentType;







    class FrontOfficeController extends AbstractController
    {
           /**
        * @Route("/", name="home")
        */
        public function home(PaginatorInterface $paginator, RecipeRepository $repo): Response
        {
            $recipes = $repo->findRandom();
            return $this->render('front_office/home.html.twig', compact('recipes'));
        }

         /**
         * @Route("/recipe/{id}/{people}", name="recipe_show")
         */
        public function showRecipe(Recipe $recipe, Request $request, EntityManagerInterface $manager, $people): Response
        {   
            dump([$people]);
            $comment = new Comment();
            $form = $this ->createForm(CommentType::class, $comment);
            $form -> handleRequest($request);
            $recipe -> changeQuantity($people);

            if($form -> isSubmitted() && $form -> isValid()) {
                $comment -> setCreatedAt(new \DateTime());
                $comment -> setRecipe($recipe);
                $manager -> persist($comment);
                $manager-> flush();
                $this-> addFlash('success', "Maintenant tout le monde peut voir ton meilleur commentaire");
                return $this -> redirectToRoute('recipe_show', ['id' => $recipe -> getId(),
                                                                ]);
            } 

            return $this->render('front_office/show.html.twig', [
                'recipe' => $recipe,
                'commentForm' => $form -> createView(),
                'people' => $people
            ]);
        }
    }

