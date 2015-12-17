<?php

/**
 * @copyright Copyright (c) 12 Paw Paperie, 2015
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @package MShop
 * @subpackage Download
 */


/**
 * Generic interface for all download items.
 *
 * @package MShop
 * @subpackage Download
 */
interface MShop_Download_Item_Interface
    extends MShop_Common_Item_Interface
{
    /**
     * Returns the unique ID of the user who purchased the download file
     *
     * @return integer The unique user ID
     */
    public function getUserId();
    
    
    /**
     * Sets the unique ID of the user who purchased the download file
     *
     * @param integer $userid The unique user ID
     * @return void
     */
    public function setUserId( $userid );
    
    
    /**
     * Returns the unique ID for the download file. This is the ID
     * sent to the user as part of the link identifying the download.
     *
     * @return string The unique download identifier
     */
    public function getFileId();
    
    
    /**
     * Sets the unique ID for the download file. This is the ID sent
     * to the user as part of the link identifying the download.
     *
     * @param string $fileid The unique download identifier
     * @return void
     */
    public function setFileId( $fileid );
    
    
    /**
     * Returns the unique ID for the order base the download is associated with
     *
     * @return integer The unique order ID
     */
    public function getOrderBaseId();
    
    
    /**
     * Sets the unique ID for the order base the download is associated with
     *
     * @param integer $orderid The unique order ID
     * @return void
     */
    public function setOrderBaseId( $orderid );
    
    
    /**
     * Gets the unique ID of the order product the download is associated with
     *
     * @return The unique product id
     */
    public function getProductId();
    
    
    /**
     * Sets the unique ID of the order product the download is associated with
     *
     * @param integer $productid The unique product ID
     */
    public function setProductId( $productid );
    
    
    /**
     * Returns the number of times the user has downloaded the file
     *
     * @return integer The number of times the user has downloaded the file
     */
    public function getDownloads();
    
    
    /**
     * Sets the number of times the user has downloaded the file
     *
     * @param integer $downloads The download count
     */
    public function setDownloads( $downloads );
    
    
	/**
	 * Returns the true url of the file download
	 *
	 * @return string URL of the file download
	 */
	public function getUrl();
    
    
	/**
	 * Sets the new url of the file download
	 *
	 * @param string $url URL of the file download
	 * @return void
	 */
	public function setUrl( $url );
}
