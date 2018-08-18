<?php

namespace Eli2n\XmlResponse;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class XmlResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return mixed
     */
    public function boot()
    {
        return Response::macro('xml', function ($data, $status_code = 200, $options = []) {
            return (new XmlResponse)->getResponse($data, $status_code, $options);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/xml.php', 'xml');
    }
}
