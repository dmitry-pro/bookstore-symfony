<?php

namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \FOS\RestBundle\Controller\Annotations as REST;

class ApiController extends FOSRestController
{
    // todo: many different REST controllers with semantic actions
    // todo: API versions

    /**
     * @Route("/api/books.{_format}", defaults={"_format" = "json"}, name="api_books_index")
     * @REST\View()
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBooks(Request $request)
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

        $books = $pagerFanta->getCurrentPageResults();

        $view = $this->view([
            'total' => $pagerFanta->getNbPages(),
            'count' => count($books),
            'items' => iterator_to_array($books),
        ], 200);

        return $this->handleView($view);
    }

}
