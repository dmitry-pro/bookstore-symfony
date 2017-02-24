<?php

namespace AppBundle\Controller;

use DataBundle\Repository\BookRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BooksController extends Controller
{
    const BOOKS_PER_PAGE = 2;
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

        $books = $this->getBookRepository()->findBooksPaginated($search, ['genre' => $genre, 'author' => $author], static::BOOKS_PER_PAGE, $page);

        // todo: cache
        $genres = $this->getDoctrine()->getRepository('DataBundle:Genre')->findAll();
        $authors = $this->getDoctrine()->getRepository('DataBundle:Author')->findAll();

        return [
            'genres' => $genres,
            'authors' => $authors,
            'books' => $books,
            'pagination' => $this->getPagination($page, static::BOOKS_PER_PAGE, $books->count())
        ];
    }

    /**
     * @return BookRepository
     */
    protected function getBookRepository()
    {
        return $this->getDoctrine()->getRepository('DataBundle:Book');
    }

    /**
     * @param int $page
     * @param int $limitPerPage
     * @param int $nbEntities
     *
     * @return array
     */
    protected function getPagination($page, $limitPerPage, $nbEntities)
    {
        $pagination = [
            'page'       => $page,
            'totalPages' => ceil($nbEntities / $limitPerPage)
        ];

        if ($pagination['totalPages'] <= 0) {
            $pagination['totalPages'] = 1;
        }

        return $pagination;
    }
}
