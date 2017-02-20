<?php namespace JobVerplanke\Captcha;

use System\Classes\PluginBase;

/**
 * Class Plugin
 *
 * @package JobVerplanke\Captcha
 */
class Plugin extends PluginBase
{

    /**
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'jobverplanke.captcha::lang.plugin.label',
            'description' => 'jobverplanke.captcha::lang.plugin.description',
            'author'      => 'Job Verplanke',
            'icon'        => 'icon-google',
        ];
    }

    /**
     * @return array
     */
    public function registerComponents()
    {
        return [
            'JobVerplanke\Captcha\Components\Captcha' => 'captcha',
        ];
    }

    /**
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'jobverplanke.captcha::lang.settings.label',
                'description' => 'jobverplanke.captcha::lang.settings.description',
                'icon'        => 'icon-key',
                'class'       => 'JobVerplanke\Captcha\Models\Settings',
                'order'       => 500,
                'keywords'    => 'settings recaptcha captcha google',
            ],
        ];
    }

    /**
     * Initialize reCaptcha middleware
     */
    public function boot()
    {
        \Cms\Classes\CmsController::extend(function($controller) {
            $controller->middleware('JobVerplanke\Captcha\Classes\Middleware');
        });
    }
}
