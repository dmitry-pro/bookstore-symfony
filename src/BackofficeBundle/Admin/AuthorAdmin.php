<?php
/**
 * Created by Dmitry Prokopenko
 * https://github.com/dmitry-pro
 */

namespace BackofficeBundle\Admin;

use DataBundle\Entity\Author;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;

class AuthorAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'authors';

    protected $baseRoutePattern = 'authors';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstName')
            ->add('lastName')
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

        $listMapper->add('firstName');
        $listMapper->add('lastName');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('firstName')
            ->assertNotBlank()
            ->end()
            ->with('lastName')
            ->assertNotBlank()
            ->end()
        ;
    }

    public function toString($object)
    {
        return $object instanceof Author
            ? $object->getFullName()
            : 'Author'; // breadcrumb
    }

}