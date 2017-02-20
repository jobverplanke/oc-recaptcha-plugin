<?php
/**
 * Project:         octodev
 * Date & Time:     18-01-2017 - 09:56
 *
 * @author:         Job Verplanke <job.verplanke@gmail.com>
 * @file:           Settings
 * @package:        JobVerplanke\Captcha\Models
 * @version:        0.1
 * @php-version:    7.0.8
 * @link:           https://github.com/jobverplanke/
 *
 * @copyright:      Copyright (c) 2017 Job Verplanke
 */

namespace JobVerplanke\Captcha\Models;

use Model;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = [
        'System.Behaviors.SettingsModel'
    ];

    public $settingsCode = 'jobverplanke_captcha_settings';

    public $settingsFields = 'fields.yaml';


    public $rules = [
        'captcha.site_key' => 'required',
        'captcha.secret_key' => 'required',
    ];

    public $customMessages = [
        'captcha.site_key.required' => 'Site key is required.',
        'captcha.secret_key.required' => 'Secret key is required.',
    ];

}