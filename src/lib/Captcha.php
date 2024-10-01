<?php

namespace App\Library;

use App\Library\Captcha\Google;
use function App\Library\Functions\get_config;

class Captcha
{
    private $captcha;

    public function __construct($captcha = null)
    {
        switch ($captcha || get_config('captcha_type')) {
            case 'recaptcha':
                $this->setCaptcha(new Google());
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