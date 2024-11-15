<?php

namespace App\Library;

use function App\Library\Functions\get_config;

class Captcha
{
    private $captcha;

    public function __construct($captcha = null)
    {
        $captcha = !empty($captcha) ? $captcha : get_config('captcha_type');
        switch ($captcha) {
            case 'recaptcha':
                $this->setCaptcha(new \App\Library\Captcha\Google());
                break;
            case 'hcaptcha':
                $this->setCaptcha(new \App\Library\Captcha\HCaptcha());
                break;
            case 'turnstile':
                $this->setCaptcha(new \App\Library\Captcha\Turnstile());
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getCaptcha()
    {
        return $this->captcha;
    }

    /**
     * @param $captcha
     * @return void
     */
    public function setCaptcha($captcha)
    {
        $this->captcha = $captcha;
    }

    /**
     * @return mixed
     */
    public function get_script_file_url()
    {
        return $this->captcha->get_script_file_url();
    }

    /**
     * @return string
     */
    public function get_script_file()
    {
        return $this->captcha->get_script_file();
    }

    /**
     * @return string
     */
    public function get_html_element()
    {
        return $this->captcha->get_html_element();
    }

    /**
     * @param  array|null  $action
     * @return mixed
     */
    public function validate(array $action = null)
    {
        return $this->captcha->validate($action);
    }
}