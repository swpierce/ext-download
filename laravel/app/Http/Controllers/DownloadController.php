<?php
/**
 * @copyright Copyright (c) 12 Paw Paperie, 2015
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Jenssegers\Agent\Agent;

use Carbon\Carbon;

class DownloadController extends Controller
{
    public function downloadfileAction( $fileid )
    {
        $agent = new Agent();
        if( $agent->isMobile() || $agent->isTablet() )
        {
            $params = app( '\Aimeos\Shop\Base\Page' )->getSections( 'no-mobile-page' );
            return \View::make( 'shop::page.nomobile', $params );
        }
        
        $user = Auth::user();
        
        $context = \App::make( '\Aimeos\Shop\Base\Context' )->get();
        $dlManager = \MShop_Factory::createManager( $context, 'download' );
        
        $search = $dlManager->createSearch( true );
        $expr = array(
            $search->compare( '==', 'download.fileid', $fileid ),
            $search->compare( '==', 'download.userid', $user->id ),
            $search->getConditions(),
        );
        $search->setConditions( $search->combine( '&&', $expr ) );
        
        $dlList = $dlManager->searchItems( $search );
        $download = reset( $dlList );
        
        $relPath = $download->getUrl();
        
        $disk = Storage::disk( config( 'shop.distros.drivename' ) );
        
        $filename = substr( strrchr( $relPath, "/" ), 1 );
        $filesize = $disk->size( $relPath );
        
        $expDate = Carbon::parse( $download->getTimeCreated() )->addDays( config( 'shop.distros.max-time' ) );
        $expiration = $expDate->toFormattedDateString();
        $today = Carbon::now();
        
        $downloadtotal = config( 'shop.distros.max-downloads' );
        $downloadcount = $download->getDownloads();
        
        $params = app( '\Aimeos\Shop\Base\Page' )->getSections( 'download-page' );
        $params[ 'fileid' ] = $fileid;
        $params[ 'filename' ] = $filename;
        $params[ 'filesize' ] = $filesize;
        $params[ 'downloadtotal' ] = $downloadtotal;
        $params[ 'downloadcount' ] = $downloadcount;

        if( $today->gt( $expDate ) || $downloadcount >= $downloadtotal ) {
            $params[ 'expiration' ] = 'Expired';
        } else {
            $params[ 'expiration' ] = $expiration;
        }
        
        return \View::make( 'shop::page.download', $params );
        
    }
    
    public function getfileAction( $fileid )
    {
        $user = Auth::user();
        
        $context = \App::make( '\Aimeos\Shop\Base\Context' )->get();
        $dlManager = \MShop_Factory::createManager( $context, 'download' );
        
        $search = $dlManager->createSearch( true );
        $expr = array(
            $search->compare( '==', 'download.fileid', $fileid ),
            $search->compare( '==', 'download.userid', $user->id ),
            $search->getConditions(),
        );
        $search->setConditions( $search->combine( '&&', $expr ) );
        
        $dlList = $dlManager->searchItems( $search );
        $download = reset( $dlList );
        
        $relPath = $download->getUrl();
        
        $disk = Storage::disk( config( 'shop.distros.drivename' ) );
        
        $dispName = substr( strrchr( $relPath, "/" ), 1 );
        
        $dlCount = $download->getDownloads();
        $download->setDownloads( ++$dlCount );
        $dlManager->saveItem( $download );
        
        $fileContents = $disk->get( $relPath );
        header( "Content-Type: application/octet-stream" );
        header( "Content-Disposition: attachment; filename=$dispName" );
        header( "Content-Length: " . strlen( $fileContents ) );
        echo $fileContents;
    }
}
