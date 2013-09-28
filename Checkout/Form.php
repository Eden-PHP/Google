<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */

/**
 * Google 
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Checkout_Form extends Base
{ 
	const URL_TEST_CHECKOUT	= 'https://sandbox.google.com/checkout/api/checkout/v2/checkoutForm/Merchant/%s';
	const URL_LIVE_CHECKOUT	= 'https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/%s';
	
	protected $merchantId		= NULL;
	
	public function __construct($merchantId)
	{
		//argument test
		Argument::i()->test(1, 'string');
			
		$this->merchantId = $merchantId;
		
	}
	/**
	 * Returns a checkout form
	 *
	 * @param string
	 * @param string|integer
	 * @param string
	 * @param string|integer
	 * @param string 
	 * @param boolean Set to false for live url
	 * @return array
	 */
	public function checkoutForm($itemName, $price, $description, $quantity, $currency = 'USD', $test = true)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			->test(2, 'string', 'int')		//argument 2 must be a string or integer	
			//argument 3 must be a string
			->test(3, 'string')
			->test(4, 'string', 'int')		//argument 4 must be a string or integer	
			//argument 5 must be a string
			->test(5, 'string')
			//argument 6 must be a booelean	
			->test(6, 'bool');
		
		if($test = true) {
			//set url to sandbox
			$url = sprintf(self::URL_TEST_CHECKOUT, $this->merchantId);
		} else {
			//set url to live account
			$url = sprintf(self::URL_LIVE_CHECKOUT, $this->merchantId);
		}
		//make a xml template
		$form = Template::i()
			->set('url', $url)
			->set('itemName', $itemName)
			->set('itemDescription', $description)
			->set('itemPrice', $price)
			->set('itemCurrency', $currency)
			->set('itemQuantity', $quantity)
			->set('merchantId', $this->merchantId)
			->parsePHP(dirname(__FILE__).'/template/form.php');
		
		return $form;
	}
}