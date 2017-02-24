<?php
/**
 * Created by Dmitry Prokopenko
 * https://github.com/dmitry-pro
 */

namespace DataBundle\DataFixtures\ORM;

use DataBundle\Entity\Author;
use DataBundle\Entity\Book;
use DataBundle\Entity\Genre;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBooksData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $books = [
            ['title' => 'Killers', 'genre' => 'story', 'author' => 'Hemingway', 'year' => 1000],
            ['title' => 'For whom the bell tolls', 'genre' => 'novel', 'author' => 'Hemingway', 'year' => 1001],
            ['title' => 'Kilimanjaro Snows', 'genre' => 'story', 'author' => 'Hemingway', 'year' => 1002],
            ['title' => 'Voyna i mir', 'genre' => 'story', 'author' => 'Tolstoy', 'year' => 1003],
            ['title' => 'Anna Karenina', 'genre' => 'story', 'author' => 'Tolstoy', 'year' => 1004],
            ['title' => 'Anna Karenina', 'genre' => 'story', 'author' => 'Tolstoy', 'year' => 1005],
            ['title' => 'Fahrenheit 451', 'genre' => 'story', 'author' => 'Bradbury', 'year' => 1953],
        ];

        foreach ($books as $_book) {
            $book = new Book();

            $genre = $manager->getRepository(Genre::class)->findBy(['slug' => $_book['genre']]);
            $author = $manager->getRepository(Author::class)->findBy(['lastName' => $_book['author']]);

            $book
                ->setTitle($_book['title'])
                ->setAuthor($author[0])
                ->setGenre($genre[0])
                ->setYear($_book['year'])
            ;
            $manager->persist($book);
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 3;
    }
}
