<?php

namespace App\DataFixtures;
use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class AppFixtures extends Fixture
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher =$hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $generator = Faker\Factory::create("us_US");
        for($i=0;$i<20; $i++){
            $user = new User();
            $password = $this->hasher->hashPassword($user , 'password');
          
            
            $user->setFirstName($generator->firstName())
            ->setLastName($generator->lastName)
            ->setEmail($generator->email)
            ->setPassword($password);
            $manager ->persist($user);

        for($j=0;$j<rand(10,30); $j++){
            $news = new News();
            $news -> setTitle($generator->sentence)
            -> setContent($generator->text())
            ->setStatus($generator->randomElement(['DRAFT','PUBLISHED','DELETED']))
            ->setCreatedAt($generator->dateTimeBetween('-1year','today'))
            ->setUser($user);
            $manager->persist($news);
        }    


        }
        

      

        $manager->flush();
    }
}
