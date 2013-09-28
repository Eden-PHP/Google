<?php //--> 
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Map geocoding Class
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Maps_Geocoding extends Base
{ 
	const URL_MAP_GEOCODING	= 'http://maps.googleapis.com/maps/api/geocode/json';
	
	/* Public Properties 
	-------------------------------*/
	/**
	 * The bounding box of the viewport within which to bias geocode results more prominently.
	 *
	 * @param string
	 * @return this
	 */
	public function setBounds($bounds)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		$this->query['bounds'] = $bounds;
		
		return $this;
	}
	
	/**
	 * The language in which to return results. 
	 *
	 * @param string
	 * @return this
	 */
	public function setLanguage($language)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		$this->query['language'] = $language;
		
		return $this;
	}
	
	/**
	 * The region code
	 *
	 * @param string
	 * @return this
	 */
	public function setRegion($region)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		$this->query['region'] = $region;
		
		return $this;
	}
	
	/**
	 * Returns geocode information
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function getResponse($address, $sensor = 'false')
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
			
		$this->query['address']	= $address;		
		$this->query['sensor']		= $sensor;
			
		return $this->getResponse(self::URL_MAP_GEOCODING, $this->query);
	}
}