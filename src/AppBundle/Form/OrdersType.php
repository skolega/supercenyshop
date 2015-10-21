<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class OrdersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('province', 'text', [
                'label' => 'Województwo',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('postal', 'text', [
                'label' => 'Kod pocztowy',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('city', 'text', [
                'label' => 'Miejscowość',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('street', 'text', [
                'label' => 'Ulica',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('no', 'text', [
                'label' => 'Nr domu/lokalu',
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('comments', 'textarea', [
                'label' => false,
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Orders'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orders';
    }
}
