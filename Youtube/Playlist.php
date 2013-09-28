<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */ 

/**
 * Google youtube playlist
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Playlist extends Base
{ 
	const URL_YOUTUBE_PLAYLIST			= 'https://gdata.youtube.com/feeds/api/users/%s/playlists';
	const URL_YOUTUBE_PLAYLIST_UPDATE	= 'https://gdata.youtube.com/feeds/api/users/%s/playlists/%s';
	const URL_YOUTUBE_PLAYLIST_DELETE	= 'https://gdata.youtube.com/feeds/api/users/%s/playlists/%s';
	const URL_YOUTUBE_PLAYLIST_GET		= 'https://gdata.youtube.com/feeds/api/playlists/%s';  
	const URL_YOUTUBE_PLAYLIST_VIDEO	= 'https://gdata.youtube.com/feeds/api/playlists/%s/%s'; 
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($token, $developerId)
	{
		//argument test
		Argument::i()
			->test(1, 'string')
			->test(2, 'string');
		
		$this->developerId	= $developerId;
		$this->token		= $token; 
	}

	/**
	 * Returns user playlist
	 *
	 * @param string
	 * @return array
	 */
	public function getList($userId = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->query[self::RESPONSE] = self::JSON_FORMAT;
				
		return $this->getResponse(sprintf(self::URL_YOUTUBE_PLAYLIST, $userId), $this->query);
	}
	
	/**
	 * Create a playlist
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @return array
	 */
	public function create($title, $summary, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string');
	
		//make a xml template
		$query = Template::i()
			->set(self::TITLE, $title)
			->set(self::SUMMARY, $summary)
			->parsePHP(dirname(__FILE__).'/template/createplaylist.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_PLAYLIST, $userId), $query);
	}
	
	/**
	 * Create a playlist
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return array
	 */
	public function update($title, $summary, $playlistId, $userId = self::DEFAULT_VALUE)
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
		
		//make a xml template
		$query = Template::i()
			->set(self::TITLE, $title)
			->set(self::SUMMARY, $summary)
			->parsePHP(dirname(__FILE__).'/template/createplaylist.php');
		
		return $this->put(sprintf(self::URL_YOUTUBE_PLAYLIST_UPDATE, $userId, $playlistId), $query);
	}
	
	/**
	 * Add video to a playlist
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @return array
	 */
	public function addVideo($videoId, $position, $playlistId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string');

		//make a xml template
		$query = Template::i()
			->set(self::VIDEO_ID, $videoId)
			->set(self::POSITION, $position)
			->parsePHP(dirname(__FILE__).'/template/addvideo.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_PLAYLIST_GET, $playlistId), $query);
	}
	
	/**
	 * Add video to a playlist
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @return array
	 */
	public function updateVideo($position, $playlistId, $entryId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string');
		
		//make a xml template
		$query = Template::i()
			->set(self::POSITION, $position)
			->parsePHP(dirname(__FILE__).'/template/addvideo.php');
		
		return $this->put(sprintf(self::URL_YOUTUBE_PLAYLIST_VIDEO, $playlistId, $entryId), $query);
	}
	
	/**
	 * Remove a video in the playlist 
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function removeVideo($playlistId, $entryId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->delete(sprintf(self::URL_YOUTUBE_PLAYLIST_VIDEO, $playlistId, $entryId));
	}
	
	/**
	 * Delete a playlist 
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function delete($playlistId, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->delete(sprintf(self::URL_YOUTUBE_PLAYLIST_DELETE, $userId, $playlistId));
	}
}