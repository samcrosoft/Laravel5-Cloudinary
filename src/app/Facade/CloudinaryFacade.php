<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 12/02/2015
 * Time: 21:24
 */

namespace Samcrosoft\Cloudinary\Facade;

use Illuminate\Support\Facades\Facade;
use Samcrosoft\Cloudinary\Provider\CloudinaryServiceProvider;

/**
 * Class CloudinaryFacade
 * @package Samcrosoft\Cloudinary\Facade
 */
class CloudinaryFacade extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CloudinaryServiceProvider::PROVIDER_ALIAS;
    }
}
