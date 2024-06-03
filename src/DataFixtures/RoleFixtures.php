<?php

namespace App\DataFixtures;

use App\Entity\Role as EntityRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lstRole = ['administrateur','employer', 'visiteur'];

        foreach ($lstRole as $label) 
        {
            $role = new EntityRole();
            $role->setLabel($label);
            // creer 3 reference pour user::class
            $this->addReference('label_'.$label, $role);
            $manager->persist($role);

        }

        $manager->flush();
    }
}
