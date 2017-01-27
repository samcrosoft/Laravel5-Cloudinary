<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 12/02/2015
 * Time: 21:25
 */

namespace Samcrosoft\Cloudinary\Provider;

use Illuminate\Support\ServiceProvider;

/**
 * Class CloudinaryServiceProvider
 * @package Samcrosoft\Cloudinary\Provider
 */
class CloudinaryServiceProvider extends ServiceProvider
{

    const PROVIDER_ALIAS = "Cloudy";

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(self::PROVIDER_ALIAS, function () {
            return $this->app->make('Samcrosoft\Cloudinary\Wrapper\CloudinaryWrapper');
        });
    }
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/cloudinary.php' => config_path('cloudinary.php')
        ]);
    }

    /**
     * @return array
     */
    public function provides(){
        return [
            self::PROVIDER_ALIAS
        ];
    }
}