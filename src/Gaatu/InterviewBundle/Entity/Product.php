<?php
namespace Gaatu\InterviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Product
{
    /**
     * Auto-incremented ID.
     */
    private $id;

    /**
     * int
     *
     * Represents unique 6 digit integer.
     */
    private $sku;

    // ...
}
