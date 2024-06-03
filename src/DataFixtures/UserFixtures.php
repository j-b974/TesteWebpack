<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{

    public function getDependencies(): array
    {
	    return [RoleFixtures::class];

    }


    public function load(ObjectManager $manager): void
    {
        $lstLabel = ['administrateur','employer', 'visiteur'];
        
        for ($i=0; $i < 15; $i++) { 

            // 1 admin , 3 employer , reset visiteur 
            $label = ($i == 0) ? 0 : (($i > 3) ? 1 : 2 );
       
            $role = $this->getReference('label_'.$lstLabel[$label]);

            //                  ===========================
            $faker = Factory::create('fr_FR');

            $user = new User();
            $user->setNom($faker->name());
            $user->setEmail($faker->email());
            $user->setRole($role);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
