<a href="https://aimeos.org/">
    <img src="https://aimeos.org/fileadmin/template/icons/logo.png" alt="Aimeos logo" title="Aimeos" align="right" height="60" />
</a>

Aimeos extension allowing shops to sell digital downloads
=========================================================

The Aimeos download extension contains Aimeos library objects and views that allow shops to sell digital downloads.
Configuration allows limiting the number of days a download is available for a customer as well as the number of times
a customer can download a file. Actual physical file location is hidden from the customer to prevent the customer
from simply modifying the URL and gaining access to other files that the customer did not purchase. A Laravel
Controller implementation is provided that handles the actual download requests from the customer. Because most
downloads are not useful on mobile devices, the [Jensegger's Agent](https://github.com/jenssegers/agent) is used to
prevent downloads by customers on their tablets or phones.

## Table of contents

- [Installation](#installation)
- [Configuration](#configuration)
- [License](#license)
- [Links](#links)

## Installation

As every Aimeos extension, the easiest way is to install it via [composer](https://getcomposer.org/). If you don't have composer installed yet, you can execute this string on the command line to download it:
```
php -r "readfile('https://getcomposer.org/installer');" | php -- --filename=composer
```

Add the filesystem extension name to the "require" section of your ```composer.json``` (or your ```composer.aimeos.json```, depending on what is available) file:
```
"require": [
    "jenssegers/agent": "^3.0@dev"
    "aimeos/ai-download": "dev-master",
    ...
],
```

Afterwards you only need to execute the composer update command on the command line:
```
composer update
```

These commands will install the Aimeos extension into the extension directory and it will be available immediately.

## Configuration

The Checkout confirmation subpart will need modified. Add this configuration key to your configuration file:
```
	'classes' => array(
        'client' => array(
            'html' => array(
                'checkout' => array(
                    'confirm' => array(
                        'name' => 'Download',
                    ),
                ),
            ),
        ),
	),
```

There are 2 routes to be added to your configuration file. In ```shop.php``` you can set:
```
	'routes' => array(
        'download' => array('middleware' => 'auth'),
	),

	'page' => array(
        'download-page' => array( 'basket/mini' ),
        'no-mobile-page' => array( 'basket/mini' ),
	),

```

In your ```app\Http\routes.php``` file, you can set:
```
// Download routes
Route::group(config('shop.routes.download', ['middleware' => 'auth']), function() {
    Route::match( array( 'GET' ), 'getfile/{fileid}', array(
        'as' => 'aimeos_shop_download_file',
        'uses' => 'DownloadController@getfileAction'
    ));
    
    Route::match( array( 'GET' ), 'downloadfile/{fileid}', array(
        'as' => 'aimeos_shop_request_download',
        'uses' => 'DownloadController@downloadfileAction'
    ));
});
```

The actual download configuration is done in ```shop.php``` via something like:
```
    'distros' => array(
        'bucket' => 'S3-BUCKET-NAME',
        'max-downloads' => MAXIMUM-ALLOWED-DOWNLOADS,
        'max-time' => MAXIMUM-DAYS-DOWNLOAD-AVAILABLE-FROM-PURCHASE,
        'drivename' => 'FLYSYSTEM-DISK-NAME',
    ),
```

## License

The Aimeos download extension is licensed under the terms of the LGPLv3 Open Source license and is available for free.

## Links

* [Web site](https://aimeos.org/)
* [Documentation](https://aimeos.org/docs)
* [Help](https://aimeos.org/help)
* [Issue tracker](https://github.com/aimeos/ai-filesystem/issues)
* [Source code](https://github.com/aimeos/ai-filesystem)
