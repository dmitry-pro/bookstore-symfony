<?php
/**
 * Created by Dmitry Prokopenko
 * https://github.com/dmitry-pro
 */

namespace BackofficeBundle\Admin;

use DataBundle\Entity\Book;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class BookAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'books';

    protected $baseRoutePattern = 'books';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('year')
            ->add('genre', 'sonata_type_model', [
                'property' => 'title',
                'btn_add' => true,
            ])
            ->add('author', 'sonata_type_model', [
                'property' => 'fullName',
                'btn_add' => true,
            ])
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
        $listMapper->add('year');
        $listMapper->add('genre');
        $listMapper->add('author');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('title')
            ->assertNotBlank()
            ->end()
            ->with('year')
            ->assertRange(['min' => 0, 'max' => date("Y")])
            ->end()
        ;
    }

    public function toString($object)
    {
        return $object instanceof Book
            ? $object->getTitle()
            : 'Book'; // breadcrumb
    }

}