<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\DataFixtures\CrewFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    const MEMBERS = [
        "Luffy" => [
            'Age' => 19,
            'Photo' => 'wanoluffy.png',
        ],
        "Shanks" => [
            'Age' => 42,
            'Photo' => 'shanks3.png',
        ],
        "Barbe Blanche" => [
            'Age' => 72,
            'Photo' => 'barbeblanche.png',
        ],
        "Kaido" => [
            'Age' => 58,
            'Photo' => 'kaido2.png',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (CrewFixtures::CREWS as $key) {
            foreach (self::MEMBERS as $memberName => $memberInfo) {
                $member = new Member();
                $member->setName($memberName);
                $member->setAge($memberInfo['Age']);
                $member->setPhoto($memberInfo['Photo']);
                $crew = $this->getReference('crew_' . $key);
                $member->setCrew($crew);
                $manager->persist($member);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CrewFixtures::class,
        ];
    }
}
