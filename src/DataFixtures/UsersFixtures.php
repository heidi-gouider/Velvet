<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
                                        

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        // private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin = new User();
        $admin->setEmail('admin@demo.fr');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        // $faker = Faker\Factory::create('fr_FR');
// Create regular users
        for($usr = 1; $usr <= 5; $usr++){
            $user = new User();
            $user->setEmail("user{$usr}@demo.fr");           
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );
            $manager->persist($user);
        }

        $manager->flush();
    }
}
    // public function __construct(
    //     private UserPasswordHasherInterface $passwordEncoder,
        // private SluggerInterface $slugger
    // ){}
    // public function load(ObjectManager $manager): void
    // {
        // $product = new Product();
        // $manager->persist($product);
        // include 'Velvet.php';

        // $userRepo = $manager->getRepository(User::class);

        // foreach ($user as $userData) {
        //     $userDB = new User();
            // $dateUser = new \DateTime($comData['date_commande']);
            // $userDB
                // ->setId($userData['id'])
                // Je convertis la chaîne de caractères en un objet DateTime
                // ->setDateCommande($comData['date_commande'])
                // $dateCommande = new \DateTime($comData['date_commande'])
                // ->setDateCommande($dateCommande)
                // ->setEmail($userDB->email)

                // ->setRoles($userData['roles'])
                // ->setPassword($userData['password']);
                // ->setIsVerifed((int)$userData['is_verified']);

            // $manager->persist($userDB);

            // empêcher l'auto incrément
    //         $metadata = $manager->getClassMetaData(User::class);
    //         $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
    //     }
    //     $manager->flush();

    //     $userRepo = $manager->getRepository(User::class);


    //     $manager->flush();
    // }

