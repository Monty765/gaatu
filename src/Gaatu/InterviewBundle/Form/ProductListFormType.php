<?php
namespace Gaatu\InterviewBundle\Form;

use Gaatu\InterviewBundle\Entity\Product;
use Gaatu\InterviewBundle\Entity\ProductList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ProductListFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {	
        $builder
        	->add('product', ChoiceType::class, array(
			'choices' => 	$options['data']['products'],
			'label' => 'Product',
			'attr'=> array('class'=>'form-control')))
			->add('productlist', ChoiceType::class, array(
			'choices' => $options['data']['productlists'],
			'choices_as_values' => true,
			'label' => 'ProductList',
			'attr'=> array('class'=>'form-control')))
        	->add('save', SubmitType::class, array('label' => 'Add to list',
        	'attr'=> array('class'=>'btn btn-primary')))
        	->getForm();
    }
}