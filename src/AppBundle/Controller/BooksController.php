<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BooksController extends Controller
{
    /**
     * @Route("/books", name="books_index")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('books_search');
    }

    /**
     * @Route("/books/search", name="books_search")
     * @Template(":AppBundle:Books/search.html.twig")
     */
    public function searchAction(Request $request)
    {
        $query = $request->get('query');

        return [];
    }
}
