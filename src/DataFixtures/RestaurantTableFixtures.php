<?php

namespace App\DataFixtures;

use App\Entity\RestaurantTable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RestaurantTableFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 4 tables de 6
        for ($i = 1; $i <= 4; $i++) {
            $table = new RestaurantTable();
            $table->setName("T{$i}");
            $table->setCapacity(6);
            $manager->persist($table);
        }

        // 4 tables de 4
        for ($i = 5; $i <= 8; $i++) {
            $table = new RestaurantTable();
            $table->setName("T{$i}");
            $table->setCapacity(4);
            $manager->persist($table);
        }

        // 5 tables de 2
        for ($i = 9; $i <= 13; $i++) {
            $table = new RestaurantTable();
            $table->setName("T{$i}");
            $table->setCapacity(2);
            $manager->persist($table);
        }

        $manager->flush();
    }
}
