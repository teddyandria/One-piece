<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    const MEMBERS = [
        'Luffy' => 'wanoluffy.png',
        'Law' => 'law.png',
        'Barbe Blanche' => 'barbeblanche.png',
        'Kaido' => 'kaido2.png'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::MEMBERS as $key => $memberName) { {
                $member = new Member();
                $member->setName($key);
                $member->setAge(28);
                $member->setPhoto($memberName);
                $member->setCrew($this->getReference('crew_Chapeaux de paille'));
                $manager->persist($member);
                $manager->flush();
            }
        }
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CrewFixtures::class,
        ];
    }
}
