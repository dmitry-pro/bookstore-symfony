<?php

namespace AppBundle\Controller;

use CommonBundle\Behavior\Controller\Pagination as PaginationTrait;
use DataBundle\Repository\BookRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BooksController extends Controller
{
    use PaginationTrait;

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

        $books = $this->getBookRepository()->findBooksPaginated($search, ['genre' => $genre, 'author' => $author], $this->getParameter('books_per_page'), $page);

        // todo: cache
        $genres = $this->getDoctrine()->getRepository('DataBundle:Genre')->findAll();
        $authors = $this->getDoctrine()->getRepository('DataBundle:Author')->findAll();

        return [
            'genres' => $genres,
            'authors' => $authors,
            'books' => $books,
            'pagination' => $this->getPagination($page, $this->getParameter('books_per_page'), $books->count())
        ];
    }

    /**
     * @return BookRepository
     */
    protected function getBookRepository()
    {
        return $this->getDoctrine()->getRepository('DataBundle:Book');
    }

}
