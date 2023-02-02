<?php

namespace App\DataFixtures;

use App\Entity\Crew;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CrewFixtures extends Fixture
{

    const CREWS = [
        [
            'name' => 'Mugiwara',
            'Description' => 'Yonko',
            'Nombre' => 10,
            'Image' => 'crewmugi.png',
        ],
        [
            'name' => 'Equipage du Roux',
            'Description' => 'Yonko',
            'Nombre' => 20,
            'Image' => 'rouw.png',
        ],
        [
            'name' => 'Equipage de  Barbe Blanche',
            'Description' => 'Yonko',
            'Nombre' => 700,
            'Image' => 'bb.png',
        ],
        [
            'name' => 'Cent Bete',
            'Description' => 'Yonko',
            'Nombre' => 1500,
            'Image' => 'centbete.png',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CREWS as $key => $crewInfo) {
            $crew = new Crew();
            $crew->setName($crewInfo['name']);
            $crew->setDescription($crewInfo['Description']);
            $crew->setNumber($crewInfo['Nombre']);
            $crew->setImage($crewInfo['Image']);
            $manager->persist($crew);
            $this->addReference('crew_' . $key, $crew);
        }
        $manager->flush();
    }
}
