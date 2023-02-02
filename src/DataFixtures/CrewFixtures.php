<?php

namespace App\DataFixtures;

use App\Entity\Crew;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CrewFixtures extends Fixture
{

    const CREWS = [
        'Chapeaux de paille',
        'L\'équipage de Roger',
        'L\'équipage de Barbe Blanche',
        'L\'équipage du Roux',
        'Thriller Bark',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CREWS as $key => $crewName) {
            $crew = new Crew();
            $crew->setName($crewName);
            $crew->setDescription('Le capitane se nomme luffy');
            $crew->setNumber(10);
            $crew->setImage('mugi.png');
            $manager->persist($crew);
            $this->addReference('crew_' . $crewName, $crew);
        }
        $manager->flush();
    }
}
