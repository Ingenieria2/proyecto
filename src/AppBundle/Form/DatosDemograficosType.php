<?php

namespace AppBundle\Form;

use AppBundle\Entity\Datos_Demograficos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DatosDemograficosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $choices = array();
    foreach ($options['vivienda'] as $doc) 
    {
      $code = $doc['nombre'];
      $choices[$code] = $doc['id'];
    }
    $agua = array();
    foreach ($options['agua'] as $ag) 
    {
      $code = $ag['nombre'];
      $agua[$code] = $ag['id'];
    }
    $calefaccion = array();
    foreach ($options['calefaccion'] as $c) 
    {
      $code = $c['nombre'];
      $calefaccion[$code] = $c['id'];
    }
        $builder
        ->add('heladera', ChoiceType::class, array( 
            'multiple' => false, 
            'expanded' => true, 
            'choices' => [
                'Si' => 1, 
                'No' => 0],
            "label"=>"¿ Tiene heladera en el hogar?", 
            "required"=>"required", 
            "attr"=>array(
                "class"=>"form-control")))
        ->add('electricidad', ChoiceType::class, array( 
            'multiple' => false, 
            'expanded' => true, 
            'choices' => [
                'Si' => 1, 
                'No' => 0], 
            "label"=>"¿ Tiene servicio electrico en el domicilio?", 
            "required"=>"required", 
            "attr"=>array(
                "class"=>"form-control")))
        ->add('mascotas', ChoiceType::class, array( 
            'multiple' => false, 
            'expanded' => true, 
            'choices' => [
                'Si' => 1, 
                'No' => 0], 
            "label"=>"¿ Tiene mascota en el domicilio?", 
            "required"=>"required", 
            "attr"=>array(
                "class"=>"form-control")))
        ->add('idVivienda', ChoiceType::class, array(
          "label"        => "Tipo de Vivienda",
          'placeholder'  => 'vivienda',
          'choices'      => $choices, 
          "attr"         => array(
          "class" =>  "form-control")))
     ->add('idAgua', ChoiceType::class, array(
        "label"       =>  "Tipo de Agua",
        'placeholder' => 'agua',
        'choices'     => $agua, 
        "attr"        =>  array(
        "class" => "form-control")))
     ->add('idCalefaccion', ChoiceType::class, array(
        "label"       =>  "Tipo de Calefaccion",
        'placeholder' => 'calefaccion',
        'choices'     => $calefaccion, 
        "attr"        =>  array(
        "class" => "form-control")))
        ->add('SingUpDemographicsData', SubmitType::class, array('label' => 'Registrar', "attr"=>array("class"=>"btn btn-primary")));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Datos_Demograficos',
            'vivienda' => Null,
            'agua' => Null,
            'calefaccion' => Null
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
