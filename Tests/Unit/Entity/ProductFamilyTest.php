<?php
namespace Pim\Bundle\ProductBundle\Tests\Unit\Entity;

use Pim\Bundle\ProductBundle\Entity\ProductFamily;
use Pim\Bundle\ProductBundle\Entity\ProductAttribute;

/**
 * Test related class
 *
 * @author    Filips Alpe <filips@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */
class ProductFamilyTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test related method
     */
    public function testConstruct()
    {
        $productFamily = new ProductFamily();
        $this->assertInstanceOf('Pim\Bundle\ProductBundle\Entity\ProductFamily', $productFamily);
    }

    /**
     * Test getter/setter for name property
     */
    public function testGetSetName()
    {
        $productFamily = new ProductFamily();
        $this->assertEmpty($productFamily->getName());

        // Change value and assert new
        $newName = 'test-name';
        $productFamily->setName($newName);
        $this->assertEquals($newName, $productFamily->getName());
    }

    /**
     * Test getter/setter for description property
     */
    public function testGetSetDescription()
    {
        $productFamily = new ProductFamily();
        $this->assertEmpty($productFamily->getDescription());

        // Change value and assert new
        $newDescription = 'test-description';
        $productFamily->setDescription($newDescription);
        $this->assertEquals($newDescription, $productFamily->getDescription());
    }

    /**
     * Test getter/setter for attributes property
     */
    public function testGetAddRemoveAttribute()
    {
        $productFamily = new ProductFamily();
        $this->assertEmpty($productFamily->getDescription());

        // Change value and assert new
        $newAttribute = new ProductAttribute();
        $productFamily->addAttribute($newAttribute);
        $attributes = $productFamily->getAttributes();
        $this->assertInstanceOf('Pim\Bundle\ProductBundle\Entity\ProductAttribute', $attributes[0]);

        $productFamily->removeAttribute($newAttribute);
        $attributes = $productFamily->getAttributes();
        $this->assertNotInstanceOf('Pim\Bundle\ProductBundle\Entity\ProductAttribute', $attributes[0]);
    }

    /**
     * Test for __toString method
     */
    public function testToString()
    {
        $productFamily = new ProductFamily();
        $string = 'test-string';
        $productFamily->setName($string);
        $this->assertEquals($string, $productFamily->__toString());
    }
}
