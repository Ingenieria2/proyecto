<?php

namespace AppBundle\Form;

use AppBundle\Entity\Permiso;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PermisoAdminType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $choices = array();
        if( $options['permiso'] != NULL)
        {
            foreach ($options['permiso'] as $doc) 
            {
                $code = $doc->getDescripcion();
                $choices[$code] = $doc->getPermiso();
            }
        }

        $builder
        ->add('permisos', ChoiceType::class, array( 
            'multiple' => true, 
            'expanded' => true, 
            'choices'  => $choices, 
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
          'data_class' => 'AppBundle\Entity\Rol',
          'permiso' => Null
      ));
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
      return 'appbundle_rol';
  }

}
