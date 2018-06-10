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

class UsuarioUpdateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('mail', EmailType::class, array(
            "label"     =>  "e-mail", 
            "required"  =>  "required", 
            "attr"      =>  array(
                            "class"         =>  "form-control", 
                            "placeholder"   =>  "mail")))
        ->add('username', TextType::class, array(
            "label"     =>  "Nombre de usuario", 
            "required"  =>  "required", 
            "disabled"  =>  true,
            "attr"      =>  array(
                            "class"         => "form-control", 
                            "placeholder"   => "username",
                            "disabled"      =>  false)))
        ->add('nombre', TextType::class, array(
            "label"     =>  "Nombre", 
            "required"  =>  "required", 
            "attr"      =>  array(
                            "class"         =>  "form-control", 
                            "placeholder"   =>  "Nombre")))
        ->add('apellido', TextType::class, array(
            "label"     =>  "Apellido", 
            "required"  =>  "required", 
            "attr"      =>  array(
                            "class"         =>  "form-control", 
                            "placeholder"   =>  "Apellido")))
        ->add('plainPassword', RepeatedType::class, array(
                'type'  =>  PasswordType::class,
                            'first_options' =>  array(
                                'label'     =>  'Cambiar contraseña', 
                                "required"  =>    "required", 
                                "attr"      =>    array(
                                            "class"         => "form-control", 
                                            "placeholder"   => "Contraseña")),
                            'second_options' => array(
                                'label'     =>  'Repita la contraseña', 
                                "required"  =>  "required", 
                                "attr"      =>  array(
                                            "class"         =>  "form-control", 
                                            "placeholder"   =>  "Contraseña")),
            ))
        ->add('creadoEn', DateTimeType::class, array(
            'widget'    => 'single_text', 
            'format'    => 'dd/MM/yyyy',
            'label'     => 'Creado en : ', 
            'required'  => 'required',  
            "disabled"  =>  true,
            'attr'      => array(
                        "class"     =>  "form-control",
                        "disabled"   => false)))

        ->add('activo', HiddenType::class, array("label"=>"Activo", "attr"=>array("class"=>"form-control")))
        ->add('borrado', HiddenType::class, array("label"=>"Borrado", "attr"=>array("class"=>"form-control")))
        ->add('Update', SubmitType::class, array('label' => 'Guardar', "attr"=>array("class"=>"btn btn-primary")));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
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