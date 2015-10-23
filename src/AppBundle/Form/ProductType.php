<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category')
            ->add('name', 'text', array('label' => "Nazwa produktu"))
            ->add('description')
            ->add('price', 'money', array('label' => "Cena", 'currency' => 'PLN'))
            ->add('amount')
            ->add('imageFile', 'file', array('label' => "Zdęcie główne produktu"))
            ->add('type')
            ->add('package')
            ->add('weight')
            ->add('height') 
            ->add('length')
            ->add('width')
            ->add('color')
            ->add('facture')
            ->add('product_dimensions')
            ->add('manufactures')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_product';
    }
}
