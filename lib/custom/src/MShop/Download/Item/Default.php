<?php

/**
 * @copyright Copyright (c) 12 Paw Paperie, 2015
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @package MShop
 * @subpackage Media
 */


/**
 * Default implementation of the download item.
 *
 * @package MShop
 * @subpackage Download
 */
class MShop_Download_Item_Default
	extends MShop_Common_Item_Abstract
	implements MShop_Download_Item_Interface
{
	private $_values;

	/**
	 * Initializes the download item object.
	 *
	 * @param array $values Initial values of the download item
	 */
	public function __construct( array $values = array() )
	{
		parent::__construct( 'download.', $values );

		$this->_values = $values;
	}


    /**
     * Returns the unique ID of the user who purchased the download file
     *
     * @return integer The unique user ID
     */
    public function getUserId()
    {
        return ( isset( $this->_values['userid'] ) ? (int) $this->_values['userid'] : '' );
    }
    
    
    /**
     * Sets the unique ID of the user who purchased the download file
     *
     * @param integer $userid The unique user ID
     * @return void
     */
    public function setUserId( $userid )
    {
		if( $userid == $this->getUserId() ) { return; }

		$this->_values['userid'] = ( $userid != null ? (int) $userid : null );
		$this->setModified();
    }
    
    
    /**
     * Returns the unique ID for the download file. This is the ID
     * sent to the user as part of the link identifying the download.
     *
     * @return string The unique download identifier
     */
    public function getFileId()
    {
        return ( isset( $this->_values['fileid'] ) ? (int) $this->_values['fileid'] : '' );
    }
    
    
    /**
     * Sets the unique ID for the download file. This is the ID sent
     * to the user as part of the link identifying the download.
     *
     * @param string $fileid The unique download identifier
     * @return void
     */
    public function setFileId( $fileid )
    {
		if( $fileid == $this->getFileId() ) { return; }

		$this->_values['fileid'] = ( $fileid != null ? (int) $fileid : null );
		$this->setModified();
    }
    
    
    /**
     * Returns the unique ID for the order base the download is associated with
     *
     * @return integer The unique order ID
     */
    public function getOrderBaseId()
    {
        return ( isset( $this->_values['orderid'] ) ? (int) $this->_values['orderid'] : '' );
    }
    
    
    /**
     * Sets the unique ID for the order base the download is associated with
     *
     * @param integer $orderid The unique order ID
     * @return void
     */
    public function setOrderBaseId( $orderid )
    {
		if( $orderid == $this->getOrderBaseId() ) { return; }

		$this->_values['orderid'] = ( $orderid != null ? (int) $orderid : null );
		$this->setModified();
    }
    
    
    /**
     * Gets the unique ID of the order product the download is associated with
     *
     * @return The unique product id
     */
    public function getProductId() {
        return ( isset( $this->_values['prodid'] ) ? (int) $this->_values['prodid'] : '' );
    }
    
    
    /**
     * Sets the unique ID of the order product the download is associated with
     *
     * @param integer $productid The unique product ID
     */
    public function setProductId( $productid ) {
        if( $productid == $this->getProductId() ) { return; }
        
        $this->_values['prodid'] = ( $productid != null ? (int) $productid : null );
        $this->setModified();
    }
    
    
    /**
     * Returns the number of times the user has downloaded the file
     *
     * @return integer The number of times the user has downloaded the file
     */
    public function getDownloads()
    {
        return ( isset( $this->_values['downloads'] ) ? (int) $this->_values['downloads'] : '' );
    }
    
    
    /**
     * Sets the number of times the user has downloaded the file
     *
     * @param integer $downloads The download count
     */
    public function setDownloads( $downloads )
    {
		if( $downloads == $this->getDownloads() ) { return; }

		$this->_values['downloads'] = ( $downloads != null ? (int) $downloads : null );
		$this->setModified();
    }
    
    
	/**
	 * Returns the url of the download item.
	 *
	 * @return string URL of the download file
	 */
	public function getUrl()
	{
		return ( isset( $this->_values['url'] ) ? (string) $this->_values['url'] : '' );
	}


	/**
	 * Sets the new url of the download item.
	 *
	 * @param string $url URL of the download file
	 */
	public function setUrl( $url )
	{
		if( $url == $this->getUrl() ) { return; }

		$this->_values['url'] = (string) $url;
		$this->setModified();
	}


	/**
	 * Sets the item values from the given array.
	 *
	 * @param array $list Associative list of item keys and their values
	 * @return array Associative list of keys and their values that are unknown
	 */
	public function fromArray( array $list )
	{
		$unknown = array();
		$list = parent::fromArray( $list );

		foreach( $list as $key => $value )
		{
			switch( $key )
			{
				case 'download.userid': $this->setUserId( $value ); break;
				case 'download.fileid': $this->setFileId( $value ); break;
				case 'download.orderid': $this->setOrderBaseId( $value ); break;
				case 'download.downloads': $this->setDownloads( $value ); break;
				case 'download.url': $this->setUrl( $value ); break;
				default: $unknown[$key] = $value;
			}
		}

		return $unknown;
	}


	/**
	 * Returns the item values as array.
	 *
	 * @return Associative list of item properties and their values
	 */
	public function toArray()
	{
		$list = parent::toArray();

		$list['download.userid'] = $this->getUserId();
		$list['download.fileid'] = $this->getFileId();
		$list['download.orderid'] = $this->getOrderBaseId();
		$list['download.downloads'] = $this->getDownloads();
		$list['download.url'] = $this->getUrl();

		return $list;
	}
}
