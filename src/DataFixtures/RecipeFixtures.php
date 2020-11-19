<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Ingredient;
use App\Entity\Quantity;
use App\Entity\Recipe;
use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
<<<<<<< HEAD
        
=======

>>>>>>> 0cb17c8b24ad0a18ad4d1e6f19b72dd51134f3eb
        // Création des catégories
        for($i = 0; $i < 3; $i++) {
            $category = new Category;
            $category->setName($faker->word());
            $manager->persist($category);
            
            // Création des recette pour chaque catégorie
            for($j = 0; $j < mt_rand(4, 6); $j++){
                $recipe = new Recipe;
                $recipe->setName($faker->sentence())
                       ->setPicture("http://placehold.it/350x150")
                       ->setCategory($category)
                       ->setRating(mt_rand(0,5))
                       ->setCreatedAt($faker->dateTimeBetween('-6 months'));
                $this->setReference('recipe'. $j, $recipe);
<<<<<<< HEAD
                
=======
    

>>>>>>> 0cb17c8b24ad0a18ad4d1e6f19b72dd51134f3eb
                // Création des ingrédients pour chaque recette
                for($k = 0; $k < mt_rand(4, 6); $k ++) {
                    $ingredient = new Ingredient;
                    $ingredient->setName($faker->word())
<<<<<<< HEAD
                            ->addRecipe($this->getReference('recipe'. $j));
                    $this->setReference('ingredient'. $j, $ingredient);
=======
                                ->addRecipe($this->getReference('recipe'. $j));
                    $this->setReference('ingredient', $ingredient);
                    
                    for($z = 0; $z < mt_rand(4, 6); $z ++) {
                        $quantity = new Quantity;
                        $quantity -> setNumber($faker -> randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2)) 
                                 ->setUnity($faker -> word())
                                 ->addIngredient($this->getReference('ingredient'));
                                 $manager->persist($quantity);
                    }
>>>>>>> 0cb17c8b24ad0a18ad4d1e6f19b72dd51134f3eb
                    $manager->persist($ingredient);
                }
                
                // Création des étapes pour chaque recette
                for($l =0; $l < mt_rand(2, 8); $l ++){
                    $step = new Step;
                    $step->setContent($faker->paragraph())
<<<<<<< HEAD
                    ->setPicture("http://placehold.it/350x150")
                    ->setRecipe($recipe);
=======
                        ->setPicture("http://placehold.it/350x150")
                        ->setRecipe($recipe);
>>>>>>> 0cb17c8b24ad0a18ad4d1e6f19b72dd51134f3eb
                    $manager->persist($step);
                }
                
                $manager->persist($recipe);
                
                // Création des commentaires pour chaque recette
                // for($k = 0; $k < mt_rand(4, 6); $k++){
                    //     $comment = new Comment;
                //     $comment->setAuthor($faker->name())
                //             ->setContent($faker->paragraph())
                //             ->setCreatedAt($faker->dateTimeBetween('- 6 months'))
                //             ->setRecipe($recipe);
                //     $manager->persist($comment);
                // }
                $manager->persist($recipe);
            }

        }
        $manager->flush();
    }
}
