<?php
/**
 * Created by Dmitry Prokopenko
 * https://github.com/dmitry-pro
 */

namespace BackofficeBundle\Admin;

use DataBundle\Entity\Genre;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class GenreAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'genres';

    protected $baseRoutePattern = 'genres';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('slug')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id', null, [
            'header_style' => 'width: 5%;'
        ]);

        $listMapper->add('title');
        $listMapper->add('slug');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('title')
            ->assertNotBlank()
            ->end()
            ->with('slug')
            ->assertNotBlank()
            ->end()
        ;
    }

    public function toString($object)
    {
        return $object instanceof Genre
            ? $object->getTitle()
            : 'Genre'; // breadcrumb
    }

}