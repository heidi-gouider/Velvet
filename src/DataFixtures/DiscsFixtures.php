<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Disc;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DiscsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        include 'Velvet.php';
        $artistRepo = $manager->getRepository(Artist::class);

        foreach ($artist as $art) {
            $artistDB = new Artist();
            $artistDB
                ->setId($art['artist_id'])
                ->setName($art['artist_name']);
            // ->setUrl($art['artist_url']);

            $manager->persist($artistDB);

            // empêcher l'auto incrément
            $metadata = $manager->getClassMetaData(Artist::class);
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        }
        $manager->flush();

        foreach ($disc as $d) {
            $discDB = new Disc();
            $discDB
                ->setTitle($d['disc_title'])
                ->setLabel($d['disc_label'])
                ->setPicture($d['disc_picture'])
                ->setPrix($d['disc_prix'])
                ->setQuantite($d['disc_quantite'])
                ->setQuantiteVendu($d['disc_vente'])
                ->setYear($d['disc_year'])
                ->setGenre($d['disc_genre']);
            // Calculer la quantité vendue (vente) à partir des détails
            $totalVente = 0;
            foreach ($d as $detail) {
                $totalVente += $detail['quantity'];
            }
            $discDB->setQuantiteVendu($totalVente);
            $artist = $artistRepo->find($d['artist_id']);
            $discDB->setArtist($artist);
            $manager->persist($discDB);
        }

        $manager->flush();
    }
}
