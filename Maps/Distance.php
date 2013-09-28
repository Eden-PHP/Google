<?php //--> 
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Map distance Class
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Maps_Distance extends Base
{ 
	const URL_MAP_DISTANCE = 'http://maps.googleapis.com/maps/api/distancematrix/json';
	
	/* Public Properties 
	-------------------------------*/
	/**
	 * Set Distance to avoid highways
	 *
	 * @return this
	 */
	public function avoidHighways()
	{
		$this->query['avoid'] = 'highways';
		return $this;
	}
	
	/**
	 * Set Distance to avoid tolls
	 *
	 * @return this
	 */
	public function avoidTolls()
	{
		$this->query['avoid']  = 'tolls';
		return $this;
	}
	
	/**
	 * Specifies the mode of transport to use when 
	 * calculating directions is bicycling.
	 *
	 * @return this
	 */
	public function bicycling()
	{
		$this->query['mode']  = 'bicycling';
		return $this;
	}
	
	/**
	 * Specifies the mode of transport to use when 
	 * calculating directions is driving.
	 *
	 * @return this
	 */
	public function driving()
	{
		$this->query['mode']  = 'driving';
		return $this;
	}
	
	/**
	 * Specifies the mode of transport to use when 
	 * calculating directions is walking.
	 *
	 * @return this
	 */
	public function walking()
	{
		$this->query['mode']  = 'walking';
		return $this;
	}
	
	/**
	 * The language in which to return results.
	 *
	 * @param string|integer
	 * @return this
	 */
	public function setLanguage($language)
	{
		//argument 1 must be a string or integer	
		Argument::i()->test(1, 'string', 'int');	
		$this->query['language'] = $language;
		
		return $this;
	}
	
	/**
	 * Returns distances in miles and feet.
	 *
	 * @return this
	 */
	public function setUnitToImperial()
	{
		$this->query['units']  = 'imperial';
		
		return $this;
	}
	
	/**
	 * Returns travel distance and time for a matrix of origins and destinations
	 *
	 * @param string|integer|float
	 * @param string|integer|float
	 * @param string
	 * @return array
	 */
	public function getResponse($origin, $destination, $sensor = 'false')
	{
		//argument test
		Argument::i()
			->test(1, 'string', 'int', 'float')		//argument 1 must be a string, integer or float
			->test(2, 'string', 'int', 'float')		//argument 2 must be a string, integer or float
			//argument 3 must be a string	
			->test(3, 'string');
			
		$this->query['origin'] 		= $origin;
		$this->query['sensor'] 		= $sensor;
		$this->query['destinations']	= $destination;
		
		return $this->getResponse(self::URL_MAP_DISTANCE, $this->query);
	}
}