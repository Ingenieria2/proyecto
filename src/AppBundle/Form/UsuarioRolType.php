<?php

namespace AppBundle\Form;

use AppBundle\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuarioRolType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();
        if( $options['roles'] != NULL)
        {
            foreach ($options['roles'] as $doc) 
            {
                $code = $doc['descripcion'];
                $choices[$code] = $doc['nombre'];
            }
        }

        $builder
        ->add('roles', ChoiceType::class, array( 
            'multiple' => true, 
            'expanded' => true, 
            'choices'  => $choices, 
            "label"    => "Roles", 
            "required" => "required", 
            "attr"=>array(
                "class"=>"form-control")))
        ->add('Update', SubmitType::class, array('label' => 'Guardar', "attr"=>array("class"=>"btn btn-primary")));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario',
            'roles' => Null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_usuario';
    }

}