<?php //--> 
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Map Static Class
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Maps_Image extends Base
{ 
	const URL_MAP_IMAGE_STATIC	= 'http://maps.googleapis.com/maps/api/staticmap';
	const URL_MAP_IMAGE_STREET	= 'http://maps.googleapis.com/maps/api/streetview';
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($apiKey)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->apiKey = $apiKey; 
	}
	
	/**
	 * Affects the number of pixels that are returned.
	 *
	 * @param integer
	 * @return this
	 */
	public function setScale($scale)
	{
		//argument 1 must be a integer 	
		Argument::i()->test(1, 'int');	
		
		$this->query['scale'] = $scale;
		
		return $this;
	}
	
	/**
	 * Defines the format of the resulting image. 
	 * By default, the Static Maps API creates PNG images.
	 *
	 * @param string
	 * @return this
	 */
	public function setFormat($format)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		
		$this->query['format'] = $format;
		
		return $this;
	}
	
	/**
	 * Defines the language to use for display of labels on map tiles
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
	 * Defines the appropriate borders to display, 
	 * based on geo-political sensitivities.
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
	 * Define one or more markers to attach to the image at
	 * specified locations. 
	 *
	 * @param string
	 * @return this
	 */
	public function setMarkers($markers)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		
		$this->query['markers'] = $markers;
		
		return $this;
	}
	
	/**
	 * Defines a single path of two or more connected points 
	 * to overlay on the image at specified locations.
	 *
	 * @param string
	 * @return this
	 */
	public function setPath($path)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		
		$this->query['path']  = $path;
		
		return $this;
	}
	
	/**
	 * Specifies one or more locations that should remain 
	 * visible on the map, though no markers or other 
	 * indicators will be displayed.
	 *
	 * @param string
	 * @return this
	 */
	public function setVisible($visible)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		
		$this->query['visible']  = $visible;
		
		return $this;
	}
	
	/**
	 * Defines a custom style to alter the presentation of a 
	 * specific feature (road, park, etc.) of the map.
	 *
	 * @param string
	 * @return this
	 */
	public function setStyle($style)
	{
		//argument 1 must be a string 	
		Argument::i()->test(1, 'string');	
		
		$this->query['style']  = $style;
		
		return $this;
	}
	
	/**
	 * Indicates the compass heading of the camera. 
	 * Accepted values are from 0 to 360 (both values 
	 * indicating North, with 90 indicating East, and 180 South).
	 *
	 * @param integer
	 * @return this
	 */
	public function setHeading($heading)
	{
		//argument 1 must be a integer	
		Argument::i()->test(1, 'int');	
		
		$this->query['heading']  = $heading;
		
		return $this;
	}
	
	/**
	 * Determines the horizontal field of view of the image. 
	 * The field of view is expressed in degrees, with a 
	 * maximum allowed value of 120. 
	 *
	 * @param integer
	 * @return this
	 */
	public function setFov($fov)
	{
		//argument 1 must be a integer	
		Argument::i()->test(1, 'int');	
		
		$this->query['fov']  = $fov;
		
		return $this;
	}
	
	/**
	 * specifies the up or down angle of the camera relative 
	 * to the Street View vehicle.
	 *
	 * @param integer
	 * @return this
	 */
	public function setPitch($pitch)
	{
		//argument 1 must be a integer	
		Argument::i()->test(1, 'int');	
		
		$this->query['pitch']  = $pitch;
		
		return $this;
	}
	
	/**
	 * Specifies a standard roadmap image, as is normally 
	 * shown on the Google Maps website. If no maptype 
	 * value is specified, the Static Maps API serves 
	 * roadmap tiles by default.
	 *
	 * @return this
	 */
	public function useRoadMap()
	{
		$this->query['maptype']  = 'roadmap';
		
		return $this;
	}
	
	/**
	 * Specifies a satellite image
	 *
	 * @return this
	 */
	public function useSatelliteMap()
	{
		$this->query['maptype']  = 'satellite';
		
		return $this;
	}
	
	/**
	 * Specifies a physical relief map image, 
	 * showing terrain and vegetation.
	 *
	 * @return this
	 */
	public function useTerrainMap()
	{
		$this->query['maptype']  = 'terrain';
		
		return $this;
	}
	
	/**
	 * Specifies a hybrid of the satellite and 
	 * roadmap image, showing a transparent layer 
	 * of major streets and place names on the satellite image.
	 *
	 * @return this
	 */
	public function useHybridMap()
	{
		$this->query['maptype']  = 'hybrid';
		
		return $this;
	}
	
	/**
	 * Return url of the image map
	 *
	 * @param string Defines the center of the map, latitude,longitude pai or address pair
	 * @param string Defines the zoom level of the map, which determines the magnification level of the map
	 * @param string This parameter takes a string of the form {horizontal_value}x{vertical_value}
	 * @param string
	 * @return url
	 */
	public function getStaticMap($center, $zoom, $size, $sensor = 'false')
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string')
			//argument 4 must be a string	
			->test(4, 'string');
			
		$this->query['center']	= $center;
		$this->query['zoom']	= $zoom;
		$this->query['size']	= $size;
		$this->query['sensor'] = $sensor;		
		
		return $this->getResponse(self::URL_MAP_IMAGE_STATIC, $this->query);
	}
	
	/**
	 * Return url of the street map
	 *
	 * @param string Latitude,longitude pai or address pair
	 * @param string Size is specified as {width}x{height}
	 * @param string
	 * @return url
	 */
	public function getStreetMap($location, $size, $sensor = 'false')
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string');
			
		$this->query['size']		= $size;		
		$this->query['location']	= $location;	
		$this->query['sensor']		= $sensor;		
		
		return $this->getResponse(self::URL_MAP_IMAGE_STREET, $this->query);
	}
}