<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = file_get_contents('var/data/formation.json');

        foreach(json_decode($data,true) as $key => $raw){
            $formation = new Formation();
            $formation->setId($key);
            $formation->setTitre($raw['Titre']);
            $formation->setDescription($raw['Description']);
            $formation->setDuree($raw['Duree']);
            $formation->setNiveau($raw['Level']);
            $formation->setStage($raw['Stage']);
            $formation->setFormation($raw['Formation']);
            $formation->setCampus($raw['Campus']);
            $manager->persist($formation);
        }

        $manager->flush();
    }

}
