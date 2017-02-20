<?php
/**
 * Project:         octodev
 * Date & Time:     21-01-2017 - 18:02
 *
 * @author:         Job Verplanke <job.verplanke@gmail.com>
 * @file:           Middleware
 * @package:        JobVerplanke\Captcha\Classes
 * @version:        0.1
 * @php-version:    7.0.8
 * @link:           https://github.com/jobverplanke/
 *
 * @copyright:      Copyright (c) 2017 Job Verplanke
 */

namespace JobVerplanke\Captcha\Classes;

use Flash;
use Closure;
use ReCaptcha\ReCaptcha;
use JobVerplanke\Captcha\Models\Settings;
use October\Rain\Exception\AjaxException;

/**
 * Class Middleware
 *
 * @package JobVerplanke\Captcha\Classes
 */
class Middleware
{
    protected $error;
    protected $secret_key;

    /**
     * Middleware constructor.
     */
    public function __construct()
    {
        $this->secret_key = Settings::get('captcha.secret_key');
    }

    /**
     * @param         $request
     * @param Closure $next
     *
     * @return $this
     * @throws AjaxException
     */
    public function handle($request, Closure $next)
    {
        if($request->exists('g-recaptcha-response')) {

            $recaptcha = new ReCaptcha($this->secret_key);
            $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

            if (!$response->isSuccess()) {

                if($request->ajax()) {
                    throw new AjaxException($response->getErrorCodes());
                } else {
                    foreach ($response->getErrorCodes() as $this->code) {
                        Flash::error( $this->code );
                    }
                    return redirect()->back()->withInput();
                }
            }
        }

        return $next($request);
    }
}