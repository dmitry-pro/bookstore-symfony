<?php

namespace AppBundle\Controller;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BooksController extends Controller
{

    /**
     * @Route("/books", name="books_index")
     * @Template(":AppBundle:Books/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $search = $request->get('search');
        $genre = $request->get('genre');
        $author = $request->get('author');

        $page = $request->get('page', 1);

        $booksPerPage = $request->get('items_per_page', $this->getParameter('books_per_page'));

        $qb = $this->getDoctrine()->getRepository('DataBundle:Book')->findBooksQueryBuilder($search, ['genre' => $genre, 'author' => $author]);
        $adapter = new DoctrineORMAdapter($qb);
        $pagerFanta = new Pagerfanta($adapter);
        $pagerFanta->setMaxPerPage($booksPerPage);
        $pagerFanta->setCurrentPage($page);

        // todo: cache
        $genres = $this->getDoctrine()->getRepository('DataBundle:Genre')->findAll();
        $authors = $this->getDoctrine()->getRepository('DataBundle:Author')->findAll();

        $books = $pagerFanta->getCurrentPageResults();

        return [
            'genres' => $genres,
            'authors' => $authors,
            'books' => $books,
            'pagination' => [
                'page' => $page,
                'totalPages' => $pagerFanta->getNbPages(),
            ]
        ];
    }

}
