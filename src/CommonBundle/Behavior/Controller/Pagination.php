<?php

namespace CommonBundle\Behavior\Controller;


trait Pagination
{

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