<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Recipe;
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
                $steps = "<p>" . join($faker->paragraphs(5), '</p><p>') . '</p>';
                $recipe->setName($faker->sentence())
                       ->setPicture($faker->imageUrl())
                       ->setCategory($category);
                $manager->persist($recipe);

                // Création des commentaires pour chaque recette
                for($k = 0; $k < mt_rand(4, 6); $k++){
                    $comment = new Comment;
                    $comment->setAuthor($faker->name())
                            ->setContent($faker->paragraph())
                            ->setCreatedAt($faker->dateTimeBetween('- 6 months'))
                            ->setRecipe($recipe);
                    $manager->persist($comment);
                }
            }

        }
        $manager->flush();
    }
}
