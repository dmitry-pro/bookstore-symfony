<?php
/**
 * Created by Dmitry Prokopenko
 * https://github.com/dmitry-pro
 */

namespace DataBundle\DataFixtures\ORM;

use DataBundle\Entity\Author;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAuthorsData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $authors = [
            ['firstName' => 'Ernest', 'lastName' => 'Hemingway'],
            ['firstName' => 'Lev', 'lastName' => 'Tolstoy'],
            ['firstName' => 'Ray', 'lastName' => 'Bradbury'],
        ];

        foreach ($authors as $_author) {
            $author = new Author();
            $author
                ->setfirstName($_author['firstName'])
                ->setLastName($_author['lastName'])
            ;
            $manager->persist($author);
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 2;
    }
}
