<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Subscription;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $users = [];
        $subscriptions = [];
        $medias = [];
        $categories = [];

        //Subscriptions
        for ($i = 0; $i < 4; $i++) {
            $subscription = new Subscription();
            $subscription->setName($faker->word());
            $subscription->setPrice($faker->numberBetween(0, 20));
            $subscription->setDuration($faker->numberBetween(1, 12));
            array_push($subscriptions, $subscription);

            $manager->persist($subscription);
        }

        //Categories
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $category->setLabel($faker->word());
            array_push($categories, $category);

            $manager->persist($category);
        }

        for ($i = 0; $i < 15; $i++) {
            $media = new Media();
            $media->setTitle($faker->words($faker->numberBetween(1, 5), true));
            $media->setShortDescription($faker->sentence());
            $media->setLongDescription($faker->paragraphs(2, true));
            $media->setReleaseDate($faker->dateTime());
            $media->setCoverImage($faker->imageUrl(500, 500, 'movies', true));
            array_push($medias, $media);

            $manager->persist($media);
        }

        for ($i =0; $i < 10; $i++){
            $user = new User();
            $user->setEmail($faker->email());
            $user->setUsername($faker->username());
            $user->setPassword($faker->password());
            array_push($users, $user); 
            $subscription = $subscriptions[array_rand($subscriptions)];
            $user->setCurrentSubscription($subscription);   

            $manager->persist($user);
        }

        //TODO :
        // for ($i = 0; $i < 20; $i++) {
        //     $comment = new Comment();
        //     $comment->setContent($faker->paragraphs(2, true));
        //     $publisher = $users[array_rand($users)];
        //     $comment->setPublisher($publisher);
        //     $media = $medias[array_rand($medias)];
        // }

        $manager->flush();
    }
}
