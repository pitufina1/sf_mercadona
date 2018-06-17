<?php

namespace App\Form;

use App\Entity\Empresa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('email')
            ->add('contrasena')
            ->add('cp')
            ->add('cif')
              ->add('medio', ChoiceType::class, array(
                'choices' => array(
                    'AEREO' => 'AÉREO',
                    'MARITIMO' => 'MARÍTIMO',
                    'TERRESTRE' => 'TERRESTRE'
                ),
                'attr' => array('display' => 'inline-block'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                'mapped' => false,
                'empty_data'  => null,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
