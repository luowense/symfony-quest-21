<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        "Action",
        "Aventure",
        "Animation",
        "Fantastic",
        "Horror",
    ];
    public function load(ObjectManager $manager)
    {
        $faker =  Factory::create('en_US');
        for ($i = 0; $i <= 1000; $i++){
            $category = new Category();
            $slugify = new Slugify();
            $category->setName($faker->word);
            $category->setSlug($slugify->generate($category->getName()));
            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }
        $manager->flush();
    }
}
