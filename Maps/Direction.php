<?php //--> 
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Map Direction Class
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Maps_Direction extends Base
{ 
	const URL_MAP_DIRECTION = 'http://maps.googleapis.com/maps/api/directions/json';
	
	/* Public Properties 
	-------------------------------*/
	/**
	 * Set Distance to avoid highways
	 *
	 * @return this
	 */
	public function avoidHighways()
	{
		$this->query['avoid']  = 'highways';
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
	 * Requests directions via public transit 
	 * routes. Both arrivalTime and departureTime are 
	 * only valid when mode is set to "transit".
	 *
	 * @return this
	 */
	public function transit()
	{
		$this->query['mode']  = 'transit';
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
	 * Waypoints alter a route by routing it through the specified location(s)
	 *
	 * @param string|integer
	 * @return this
	 */
	public function setWaypoints($waypoint)
	{
		//argument 1 must be a string or integer	
		Argument::i()->test(1, 'string', 'int');	
		
		$this->query['waypoint'] = $waypoint;
		
		return $this;
	}
	
	/**
	 * The region code
	 *
	 * @param string|integer
	 * @return this
	 */
	public function setRegion($region)
	{
		//argument 1 must be a string or integer	
		Argument::i()->test(1, 'string', 'int');	
		$this->query['region'] = $region;
		
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
	 * Specifies that the Directions service may 
	 * provide more than one route alternative in the response.
	 *
	 * @return this
	 */
	public function setAlternatives()
	{
		$this->query['alternatives'] = 'true';
		return $this;
	}
	
	/**
	 * Specifies the desired time of departure for transit directions as seconds
	 * -timespamp
	 *
	 * @param string|int
	 * @return this
	 */
	public function setDepartureTime($departureTime)
	{
		//argument 1 must be a string or integer
		Argument::i()->test(1, 'string', 'int');
		
		if(is_string($departureTime)) {
			$departureTime = strtotime($departureTime);
		}
		
		$this->query['departureTime'] = $departureTime;
		
		return $this;
	}
	
	/**
	 * specifies the desired time of arrival for transit directions as seconds
	 * -timespamp
	 *
	 * @param string|int
	 * @return this
	 */
	public function setArrivalTime($arrivalTime)
	{
		//argument 1 must be a string or integer
		Argument::i()->test(1, 'string', 'int');
		
		if(is_string($arrivalTime)) {
			$arrivalTime = strtotime($arrivalTime);
		}
		
		$this->query['arrivalTime'] = $arrivalTime;
		
		return $this;
	}
	
	/**
	 * Returns calculated directions between locations
	 *
	 * @param string|integer|float The address or textual latitude/longitude value from which you wish to calculate directions
	 * @param string|integer|float The address or textual latitude/longitude value from which you wish to calculate directions
	 * @param booelean  Indicates whether or not the directions request comes from a device with a location sensor
	 * @return array
	 */
	public function getDirection($origin, $destination, $sensor = 'false')
	{
		//argument test
		Argument::i()
			->test(1, 'string', 'int', 'float')		//argument 1 must be a string, integer or float
			->test(2, 'string', 'int', 'float')		//argument 2 must be a string, integer or float
			//argument 3 must be a string	
			->test(3, 'string');
		
		$this->query['origin'] 		= $origin;
		$this->query['sensor'] 		= $sensor;
		$this->query['destination']	= $destination;
		
		return $this->getResponse(self::URL_MAP_DIRECTION, $this->query);
	}
}