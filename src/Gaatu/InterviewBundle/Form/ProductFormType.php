<?php

namespace Gaatu\InterviewBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {	
        $builder
        ->add('sku', TextType::class, array('label' => 'SKU', 
        	'attr'=> array('class'=>'form-control')))
        ->add('save', SubmitType::class, array('label' => 'Add Product',
        	'attr'=> array('class'=>'btn btn-primary')))
        ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    	 $resolver->setDefaults(array(
        'data_class' => 'Gaatu\InterviewBundle\Entity\Product'
    ));
    }
}