<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Ingredient;
use App\Entity\Quantity;
use App\Entity\Recipe;
use App\Entity\Step;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\IngredientRepository;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class IngredientFixtures extends Fixture
{
    public const INGREDIENT_REFERENCE = "ingredient";

    public function load(ObjectManager $manager) {

        $faker = \Faker\Factory::create('fr_FR');

        // Ingrédients
        for($k = 0; $k < mt_rand(4, 6); $k ++) {
            $ingredient = new Ingredient;
            $ingredient->setName($faker->word());
            $manager->persist($ingredient);
            $manager -> flush();

            $this->addReference(self::INGREDIENT_REFERENCE, $ingredient);
        }
    }
}

class RecipeFixtures extends Fixture
{

    private $ingredientRepo;

    public function __construct(IngredientRepository $ingredientRepo)
    {
        $this->ingredientRepo = $ingredientRepo;
    }

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
                       ->setPicture("http://placehold.it/350x150")
                       ->setCategory($category)
                       ->setRating(mt_rand(0,5))
                       ->setPeople(mt_rand(1,5))
                       ->setVoters(mt_rand(0,100))
                       ->setCreatedAt($faker->dateTimeBetween('-6 months'));
                $this->setReference('recipe'. $j, $recipe);
    

                // Création des quantités pour chaque recette
                for($k = 0; $k < mt_rand(4, 6); $k ++) {
                    $quantity = new Quantity;
                    $quantity->setAmount(($faker -> randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2)))
                                ->setRecipe($this->getReference('recipe'. $j))
                                -> setAmount($faker -> randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2))
                                ->setMeasurement($faker -> word())
                                -> setIngredient($this->getReference(IngredientFixtures::INGREDIENT_REFERENCE));
                    $manager->persist($quantity);
                }
                
                // Création des étapes pour chaque recette
                for($l =0; $l < mt_rand(2, 8); $l ++){
                    $step = new Step;
                    $step->setContent($faker->paragraph())
                        ->setPicture("http://placehold.it/350x150")
                        ->setRecipe($recipe);
                    $manager->persist($step);
                }

                //Création des commentaires pour chaque recette
                for($k = 0; $k < mt_rand(4, 6); $k++){
                    $comment = new Comment;
                    $comment->setAuthor($faker->name())
                            ->setContent($faker->paragraph())
                            ->setCreatedAt($faker->dateTimeBetween('- 6 months'))
                            ->setRecipe($recipe);
                    $manager->persist($comment);
                }
                $manager->persist($recipe);
            }

        }
        $manager->flush();
    }
}
