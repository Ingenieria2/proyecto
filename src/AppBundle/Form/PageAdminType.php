<?php

namespace AppBundle\Form;

use AppBundle\Entity\Configuracion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class PageAdminType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
          $builder
        ->add('titulo', TextType::class, array("label"=>"Titulo", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"titulo")))
        ->add('descripcion', TextType::class, array("label"=>"Descripción", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"descripción")))
        ->add('contacto', EmailType::class, array("label"=>"e-mail", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"mail")))
        ->add('listado', TextType::class, array("label"=>"Cantidad de elementos del listado", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"Cantidad de elementos del listado")))
        ->add('habilitado', ChoiceType::class, array( 
            'multiple' => false, 
            'expanded' => true, 
            'choices' => [
                'Habilitar Sitio'     => 1,
                'Deshabilitar Sitio'  => 0], 
            "label"=>"Sitio Habilitado", 
            "required"=>"required", 
            "attr"=>array(
                "class"=>"form-control")))
        ->add('mensaje', TextType::class, array("label"=>"Mensaje de Sitio Deshabilitado", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"mensaje")))
        ->add('Guardar', SubmitType::class, array('label' => 'Guardar', "attr"=>array("class"=>"btn btn-primary")));
  }
  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => 'AppBundle\Entity\Configuracion'
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
