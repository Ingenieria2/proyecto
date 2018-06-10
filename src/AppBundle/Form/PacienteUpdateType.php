<?php

namespace AppBundle\Form;

use AppBundle\Entity\Paciente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class PacienteUpdateType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    
    $choices = array();
    foreach ($options['doc'] as $doc) 
    {
      $code = $doc['nombre'];
      $choices[$code] = $doc['id'];
    }
    $ob_social = array();
    foreach ($options['os'] as $o) 
    {
      $code = $o['nombre'];
      $ob_social[$code] = $o['id'];
    }

    $builder
    ->add('apellido', TextType::class, array(
      "label"=>"Apellido", 
      "required"=>"required", 
      "attr"=>array(
                    "class"=>"form-control", 
                    "placeholder"=>"Apellido"
       )))
    ->add('nombre', TextType::class, array(
      "label"=>"Nombre", 
      "required"=>"required", 
      "attr"=>array(
                    "class"=>"form-control", 
                    "placeholder"=>"Nombre"
       )))
    ->add('fecha_Nac', DateTimeType::class, array(
      "label"=>"Fecha de Nacimiento",
      'widget'    => 'single_text', 
      'format'    => 'dd/MM/yyyy', 
      "required"=>"required", 
      "attr"=>array(
                    "class"=>"form-control", 
                    "placeholder"=>"Fecha de Naciemiento"
       )))
    ->add('genero', ChoiceType::class, array( 
        'multiple' => false, 
        'expanded' => true, 
        'choices' => [
            'Femenino' => "F", 
            'Masculino' => "M"],  
        "label"=>"Genero", 
        "required"=>"required", 
        "attr"=>array(
        "class"=>"form-control")))
    ->add('idTipoDocumento', ChoiceType::class, array(
        "label"        => "Tipo de Documento",
        'placeholder'  => 'tipo_documento',
        'choices'      => $choices, 
        "attr"         => array(
                          "class" =>  "form-control")
        ))
     ->add('idObraSocial', ChoiceType::class, array(
        "label"       =>  "Obra social",
        'placeholder' => 'obra_social',
        'choices'     => $ob_social, 
        "attr"        =>  array(
                          "class" => "form-control")
        ))
     ->add('documento', NumberType::class, array("label"=>"Documento", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"Documento")))
     ->add('domicilio', TextType::class, array("label"=>"Domicilio", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"Domicilio")))
     ->add('telefono', NumberType::class, array("label"=>"Telefono", "required"=>"required", "attr"=>array("class"=>"form-control", "placeholder"=>"Telefono")))
    ->add('SingUpPatient', SubmitType::class, array('label' => 'Registrar', "attr"=>array("class"=>"btn btn-primary")));
  }
  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => 'AppBundle\Entity\Paciente',
          'doc' => Null,
          'os' => Null
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