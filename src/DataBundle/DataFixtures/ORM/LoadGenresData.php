<?php
/**
 * Created by Dmitry Prokopenko
 * https://github.com/dmitry-pro
 */

namespace DataBundle\DataFixtures\ORM;

use DataBundle\Entity\Genre;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGenresData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $genres = [
            ['title' => 'Comedy', 'slug' => 'comedy'],
            ['title' => 'Story', 'slug' => 'story'],
            ['title' => 'Novel', 'slug' => 'novel'],
        ];

        foreach ($genres as $_genre) {
            $genre = new Genre();
            $genre
                ->setSlug($_genre['slug'])
                ->setTitle($_genre['title'])
            ;
            $manager->persist($genre);
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
