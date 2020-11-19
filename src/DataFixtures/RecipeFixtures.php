<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // Création des catégories
        for($i = 0; $i < 3; $i++) {
            $category = new Category;
            $category->setName($faker->word());
            $manager->persist($category);
            
            // Création des recette pour chaque catégorie
            for($j = 0; $j < mt_rand(4, 6); $j++){
                $recipe = new Recipe;
                $recipe->setName($faker->sentence())
                       ->setPicture($faker->imageUrl())
                       ->setCategory($category)
                       ->setRating(mt_rand(0,5))
                       ->setCreatedAt($faker->dateTimeBetween('-6 months'));
                $manager->persist($recipe);

                // Création des ingrédients pour chaque recette
                for($k = 0; $k < mt_rand(4, 6); $k ++) {
                    $ingredient = new Ingredient;
                    $ingredient->setName($faker->word())
                            ->addRecipe($recipe);
                    $manager->persist($recipe);
                }

                // Création des étapes pour chaque recette
                for($l =0; $l < mt_rand(2, 8); $l ++){
                    $step = new Step;
                    $step->setContent($faker->paragraph())
                        ->setPicture($faker->imageUrl())
                        ->setRecipe($recipe);
                    $manager->persist($step);
                }

                // Création des commentaires pour chaque recette
                // for($k = 0; $k < mt_rand(4, 6); $k++){
                //     $comment = new Comment;
                //     $comment->setAuthor($faker->name())
                //             ->setContent($faker->paragraph())
                //             ->setCreatedAt($faker->dateTimeBetween('- 6 months'))
                //             ->setRecipe($recipe);
                //     $manager->persist($comment);
                // }
            }

        }
        $manager->flush();
    }
}
