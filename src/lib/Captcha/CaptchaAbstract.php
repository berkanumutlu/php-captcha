<?php

namespace App\Library\Captcha;

abstract class CaptchaAbstract
{
    private $api_url;
    private $script_file_url;
    private $site_key;
    private $secret_key;

    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * @param  mixed  $api_url
     */
    public function setApiUrl($api_url)
    {
        $this->api_url = $api_url;
    }

    /**
     * @return mixed
     */
    public function getScriptFileUrl()
    {
        return $this->script_file_url;
    }

    /**
     * @param  mixed  $script_file_url
     */
    public function setScriptFileUrl($script_file_url)
    {
        $this->script_file_url = $script_file_url;
    }

    /**
     * @return mixed
     */
    public function getSiteKey()
    {
        return $this->site_key;
    }

    /**
     * @param  mixed  $site_key
     */
    public function setSiteKey($site_key)
    {
        $this->site_key = $site_key;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * @param  mixed  $secret_key
     */
    public function setSecretKey($secret_key)
    {
        $this->secret_key = $secret_key;
    }

    /**
     * @return string
     */
    abstract protected function get_script_file($parameters = null);

    /**
     * @return string
     */
    abstract public function get_script_file_url();

    /**
     * @return string
     */
    abstract public function get_html_element();

    /**
     * @param  array|null  $action
     */
    abstract public function validate(array $action = null);
}