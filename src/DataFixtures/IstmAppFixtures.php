<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Profile;
use App\Entity\User;
use EsperoSoft\Faker\Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IstmAppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = new Faker();
        $profile = new Profile();
        $users = [];
        for ($i=0; $i < 3; $i++) { 
            $user = (new User())->setFullName($faker->full_name())
                                ->setEmail($faker->email())
                                ->setPassword(sha1("olivier"))
                                ->setFonction($faker->country())
                                ->setRole(rand(0, 1) ? 'Admin' : 'User');
            $profile = (new Profile())->setPicture($faker->image())
                                    ->setDescription($faker->description(60))
                                    ->setCreatedAt($faker->dateTimeImmutable());
            $users[] = $user;
            $user->setProfile($profile);
            $manager->persist($profile);
            $manager->persist($user);
        }

        $articles = [];
        for ($i=0; $i < 10; $i++) {
            $article = (new Article())->setTitle($faker->title())
                                    ->setContent($faker->text(30, 150))
                                    ->setImageUrl($faker->image())
                                    ->setCreatedAt($faker->dateTimeImmutable());
            $articles[] = $article;
            $article->setAuthor($users[rand(0, count($users)-1)]);
            $manager->persist($article);
        }
        $manager->flush();
    }
}
