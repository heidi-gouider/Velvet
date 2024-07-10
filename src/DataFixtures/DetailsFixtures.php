<?php

namespace App\DataFixtures;

use App\Entity\Detail;
use App\Entity\Commande;
use App\Entity\Disc;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DetailsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        include 'Velvet.php';
        $userRepo = $manager->getRepository(User::class);
        $users = $userRepo->findAll();

        // if (empty($users)) {
        //     throw new \Exception('No users found, please load UsersFixtures first.');
        // }
        $commandeRepo = $manager->getRepository(Commande::class);

        foreach ($commande as $comData) {
            $commandeDB = new Commande();
            $dateCommande = new \DateTime($comData['date_commande']);
            $commandeDB
                ->setId($comData['id'])
                ->setUser($userId['user_id'])
                // Je convertis la chaîne de caractères en un objet DateTime
                // ->setDateCommande($comData['date_commande'])
                // $dateCommande = new \DateTime($comData['date_commande'])
                ->setDateCommande($dateCommande)
                ->setTotal($comData['total'])
                ->setEtat((int)$comData['etat']);

                 // Associez un utilisateur de la référence
            $userReference = $this->getReference("user-" . (($i % 5) + 1)); // Associe un utilisateur par rotation
            $commandeDB->setUser($userReference);
            $manager->persist($commandeDB);

            // empêcher l'auto incrément
            $metadata = $manager->getClassMetaData(Commande::class);
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        }
        $manager->flush();

        $discRepo = $manager->getRepository(Disc::class);

        // J'initialise un tableau vide pour stoker les données de détail
        $detail = [];
        foreach ($detail as $detailData) {
            $detailDB = new detail();
            $detailDB
                ->setQuantity($detailData['quantite']);
            // j'obtient la commande correspondante à partir de l'Id spécifié dans $detailData['commande_id']
            $commande = $commandeRepo->find($detailData['commande_id']);
            $detailDB->setCommande($commande);

            $disc = $discRepo->find($detailData['disc_id']);
            $detailDB->setDisc($disc);



            $manager->persist($detailDB);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UsersFixtures::class,
        ];
    }

}
