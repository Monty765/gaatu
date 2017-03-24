<?php
namespace Gaatu\InterviewBundle\Entity;

use Gaatu\InterviewBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_list")
 */
class ProductList
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\ManyToMany(targetEntity="Gaatu\InterviewBundle\Entity\Product",cascade={"persist"})
     */
    private $products;

    //Many to Many relationship array collection
    public function __construct()
	{
    	$this->products = new ArrayCollection();
	}

	//ID getter/setter
	public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    //Products getter/setter
	public function getProducts()
	{
    	return $this->products;
	}

	public function setProducts($product)
	{
    	return $this->products;
	}
}
