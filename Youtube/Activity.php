<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Google\Youtube;

/**
 * Google API: Youtube - Activity
 *
 * @vendor Eden
 * @package Google\Youtube
 * @author Ian Mark Muninio <ianmuninio@openovate.com>
 */
class Activity extends Base
{
    protected $kind = 'youtube#activity';
    protected $connection = 'activities';

    /**
     * Preloads the class.
     *
     * @param string $token access token
     * @return void
     */
    public function __construct($token)
    {
        Argument::i()->test(1, 'string');
        
        parent::__construct($token);
    }
    
    /**
     * The title of the resource primarily associated with the activity.
     * 
     * @param string $title
     * @return \Eden\Google\Youtube\Activity
     */
    public function setTitle($title)
    {
        Argument::i()->test(1, 'string');
        
        $this->post['snippet']['title'] = $title;
        
        return $this;
    }
    
    /**
     * Gets the title of snippet.
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->post['snippet']['title'];
    }
    
    /**
     * The description of the resource primarily associated with the activity.
     * 
     * @param string $desc
     * @return \Eden\Google\Youtube\Activity
     */
    public function setDescription($desc)
    {
        Argument::i()->test(1, 'string');
        
        $this->post['snippet']['description'] = $desc;
        
        return $this;
    }
    
    /**
     * The date and time that the activity occurred.
     * The value is specified in <ISO 8601> (YYYY-MM-DDThh:mm:ss.sZ) format.
     * 
     * @param string $date
     * @return \Eden\Google\Youtube\Activity
     */
    public function setPublishedAt($date)
    {
        Argument::i()->test(1, 'string');
        
        $this->post['snippet']['publishedAt'] = $date;
        
        return $this;
    }
    
    /**
     * Gets the publishedAt date.
     * 
     * @return string
     */
    public function getPublishedAt()
    {
        return $this->post['snippet']['publishedAt'];
    }
    
    /**
     * The ID that YouTube uses to uniquely identify the channel associated with the activity.
     * 
     * @param string $id
     * @return \Eden\Google\Youtube\Activity
     */
    public function setChannelId($id)
    {
        Argument::i()->test(1, 'string');
        
        $this->post['snippet']['channelId'] = $id;
        
        return $this;
    }
    
    /**
     * Gets the channel id.
     * 
     * @return string
     */
    public function getChannelId()
    {
        return $this->post['snippet']['channelId'];
    }
    
    /**
     * Channel title for the channel responsible for this activity.
     * 
     * @param string $title
     * @return \Eden\Google\Youtube\Activity
     */
    public function setChannelTitle($title)
    {
        Argument::i()->test(1, 'string');
        
        $this->post['snippet']['channelTitle'] = $title;
        
        return $this;
    }
    
    /**
     * Gets the channel title.
     * 
     * @return string
     */
    public function getChannelTitle()
    {
        return $this->post['snippet']['channelTitle'];
    }
    
    /**
     * The group ID associated with the activity.
     * A group ID identifies user events that are associated with the same user and resource.
     * For example, if a user rates a video and marks the same video as a favorite,
     * the entries for those events would have the same group ID in the user's activity feed.
     * In your user interface, you can avoid repetition by grouping events with the same groupId value.
     * 
     * @param type $groupId
     * @return \Eden\Google\Youtube\Activity
     */
    public function setGroupId($groupId)
    {
        Argument::i()->test(1, 'string');
        
        $this->post['snippet']['groupId'] = $groupId;
        
        return $this;
    }
    
    /**
     * Gets the group ID associated with the activity.
     * 
     * @return string
     */
    public function getGroupId()
    {
        return $this->post['snippet']['groupId'];
    }
    
    /**
     * Sets the thumbnail.
     * Valid key values are:
     * - default
     * - medium
     * - high
     * 
     * @param string $key the key value of thumbnail
     * @param \Eden\Google\Youtube\Model\Thumbnail $thumbnail
     * @return \Eden\Google\Youtube\Activity
     */
    public function setThumbnail($key, \Eden\Google\Youtube\Model\Thumbnail $thumbnail)
    {
        Argument::i()->test(1, 'string');
        
        $this->post['snippet']['thumbnails'][$key] = $thumbnail;
        
        return $this;
    }
    
    /**
     * Gets the thumbnail.
     * 
     * @param string $key
     * @return \Eden\Google\Youtube\Model\Thumbnail
     */
    public function getThumbnail($key)
    {
        return $this->post['snippet']['thumbnails'][$key];
    }
    
    public function createComment($comment)
    {
        Argument::i()->test(1, 'string');
                
        $this->post['snippet']['description'] = $comment;
        $this->post['snippet']['type'] = 'comment';
    }
}