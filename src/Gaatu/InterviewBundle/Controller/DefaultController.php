<?php

namespace Gaatu\InterviewBundle\Controller;

use Gaatu\InterviewBundle\Entity\Product;
use Gaatu\InterviewBundle\Entity\ProductList;
use Gaatu\InterviewBundle\Form\ProductFormType;
use Gaatu\InterviewBundle\Form\ProductListFormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{
		$productFormError=null;
		$productListError=null;
		$em = $this->getDoctrine()->getManager();

		//create product form
		$productForm = $this->createForm(ProductFormType::class);
		
		//get all products to add to productlist	
		$allProducts=$em->getRepository('Gaatu\InterviewBundle\Entity\Product')->findAll();
		foreach($allProducts as $pro){
			$products[$pro->getSku()] = $pro->getSku();
		}

		//get all productlist
		$productlist=$em->getRepository('Gaatu\InterviewBundle\Entity\ProductList')->findAll();
		foreach($productlist as $prol){
			$productlists[$prol->getId()] = $prol->getId();
		}

		//create productlist form
		$productListForm = $this->createForm(ProductListFormType::class, array('products' => $products, 'productlists'=>$productlists));

		//handle product form
		$productForm->handleRequest($request);
		if ($productForm->isSubmitted() && $productForm->isValid()) {
			$product = $productForm->getData();
			$sku_length = strlen($product->getSku());
			if($sku_length>=6 && is_numeric($product->getSku())){
				$sku=substr($product->getSku(), 0, 6);
				$product->setSku($sku);
				try{
					$em->persist($product);
					$em->flush();
					return $this->redirect('/');
				}
				catch(\Exception $e){
					$productFormError='SKU Already Exist';
				}
			}
			else{
				$productFormError='Not a valid Sku';
			}       
		}

		//handle productlist form
		$productListForm->handleRequest($request);
		if ($productListForm->isSubmitted() && $productListForm->isValid()) {
			$formData=$productListForm->getData();
			$plist = $em->getRepository('Gaatu\InterviewBundle\Entity\ProductList')->findOneById($formData['productlist']);
			$product=$em->getRepository('Gaatu\InterviewBundle\Entity\Product')->findOneBySku($formData['product']);
			$plist->getProducts()->add($product);
			try{	
				$em->persist($plist);
				$em->flush();
				return $this->redirect('/');
			}
			catch(\Exception $e){
				$productListError='Already in List';
			}
			
		}
		$productlist=$em->getRepository('Gaatu\InterviewBundle\Entity\ProductList')->findAll();
		return $this->render('product.html.twig', array(
			'productForm' => $productForm->createView(),'productListForm' => $productListForm->createView(),
			'pl'=>$productlist,'productFormError'=>$productFormError,'productListError'=>$productListError
		));
	}
}
