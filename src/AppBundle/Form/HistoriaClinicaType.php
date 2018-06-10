<?php

namespace AppBundle\Form;

use AppBundle\Entity\Control_Salud;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class HistoriaClinicaType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('fecha', DatetimeType::class, array(
            'widget'    => 'single_text', 
            'format'    => 'dd/MM/yyyy',
            "label"=>"Fecha de Control", 
            "required"=>"required", 
            "attr"=>array(
               "class"=>"form-control", 
               "placeholder"=>"dd/mm/aaaa"
         )))
    ->add('edad', NumberType::class, array(
      "label"=>"Edad", 
      "disabled"=> true, 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"Años"
        )))
    ->add('peso', NumberType::class, array(
      "label"=>"Peso", 
      "required"=>"required", 
      "attr"=>array(
        "class" =>"form-control", 
        "placeholder"=>"peso"
        )))
    ->add('vacunasCompletas', ChoiceType::class, array( 
        'multiple' => false, 
        'expanded' => true, 
        'choices' => [
            'No' => 0, 
            'Si' => 1],  
        "label"=>"¿ Tiene las vacunas completas?", 
        "required"=>"required", 
        "attr"=>array(
        "class"=>"form-control")))
    ->add('vacunasObservaciones', TextType::class, array(
       "label"=>"Vacunas Observaciones:", 
      "required"=>"required", 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"Observaciones sobre la vacunación"
        )))
     ->add('maduracionAcorde', ChoiceType::class, array( 
        'multiple' => false, 
        'expanded' => true, 
        'choices' => [
            'No' => 0, 
            'Si' => 1],  
        "label"=>"¿ La maduración es acorde?", 
        "required"=>"required", 
        "attr"=>array(
        "class"=>"form-control")))
     ->add('maduracionObservaciones', TextType::class, array(
       "label"=>"Observaciones de maduración:", 
      "required"=>"required", 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"Observaciones sobre la maduración"
        )))
    ->add('examenFisicoNormal', ChoiceType::class, array( 
        'multiple' => false, 
        'expanded' => true, 
        'choices' => [
            'No' => 0, 
            'Si' => 1],  
        "label"=>"¿ Presenta un examen físico normal?", 
        "required"=>"required", 
        "attr"=>array(
        "class"=>"form-control",
        "placeholder"=>"examen fisico")))
    ->add('examenFisicoObservaciones', TextType::class, array(
       "label"=>"Observaciones del examen fisico:", 
      "required"=>"required", 
      "attr"=>array(
      "class"=>"form-control", 
      "placeholder"=>"Observaciones del examen físico"
        )))
    ->add('pc', NumberType::class, array(
      "label"=>"Percentilo cefálico", 
      "required"=>"required", 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"pc"
        )))
    ->add('ppc', NumberType::class, array(
      "label"=>"Percentilo perímetro cefálico", 
      "required"=>"required", 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"ppc"
        )))
    ->add('talla', NumberType::class, array(
      "label"=>"Talla:", 
      "required"=>"required", 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"talla"
        )))
    ->add('alimentacion', TextType::class, array(
      "label"=>"Alimentación:", 
      "required"=>"required", 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"alimentacion"
        )))
    ->add('observacionesGenerales', TextType::class, array(
      "label"=>"Observaciones Generales:", 
      "required"=>"required", 
      "attr"=>array(
        "class"=>"form-control", 
        "placeholder"=>"Observaciones Generales"
        )))
    ->add('SingUpClinicHistory', SubmitType::class, array('label' => 'Registrar', "attr"=>array("class"=>"btn btn-primary")));
  }
  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => 'AppBundle\Entity\Control_Salud'
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