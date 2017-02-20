<?php
/**
 * Project:         octodev
 * Date & Time:     21-01-2017 - 18:10
 *
 * @author:         Job Verplanke <job.verplanke@gmail.com>
 * @file:           Captcha
 * @package:        JobVerplanke\Captcha\Components
 * @version:        0.1
 * @php-version:    7.0.8
 * @link:           https://github.com/jobverplanke/
 *
 * @copyright:      Copyright (c) 2017 Job Verplanke
 */

namespace JobVerplanke\Captcha\Components;

use Lang;
use Cms\Classes\ComponentBase;
use JobVerplanke\Captcha\Models\Settings;

/**
 * Class Captcha
 *
 * @package JobVerplanke\Captcha\Components
 */
class Captcha extends ComponentBase
{

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name' => 'Google reCaptcha.',
            'description' => 'Add Google\'s reCaptcha.',
        ];
    }

    /**
     *
     */
    public function onRun()
    {
        \App::setLocale(Settings::get('captcha.lang'));
        $this->prepareVars();
        $this->addJs('/plugins/jobverplanke/captcha/assets/js/captcha.js');
    }

    /**
     * Prepare the variables for the onRun function.
     */ 
    private function prepareVars()
    {
        // Set page variables
        $this->page['recaptcha_site_key'] = Settings::get('captcha.site_key');
        $this->page['recaptcha_theme'] = Settings::get('captcha.theme');
        $this->page['recaptcha_size'] = Settings::get('captcha.size');
        $this->page['google_api'] = 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit';
        $this->page['custom_message'] = Lang::get('jobverplanke.captcha::lang.frontend.error');
        $this->page['debug'] = $this->convertToBool(Settings::get('captcha.debug'));
    }

    /**
     * Convert int to bool
     *
     * @param $i
     *
     * @return bool
     */
    private function convertToBool($i)
    {
        return (bool) $i;
    }
}
