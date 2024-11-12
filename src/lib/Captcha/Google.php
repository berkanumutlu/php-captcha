<?php

namespace App\Library\Captcha;

use function App\Library\Functions\get_config;
use function App\Library\Functions\get_ip_address;

class Google extends CaptchaAbstract
{
    public function __construct()
    {
        $config = get_config('recaptcha');
        if (!empty($config)) {
            $this->setApiUrl($config['api_url']);
            $this->setScriptFileUrl($config['script_file_url']);
            $this->setSiteKey($config['site_key']);
            $this->setSecretKey($config['secret_key']);
        }
    }

    /**
     * @param $parameters
     * @return string
     */
    protected function get_script_file($parameters = null)
    {
        return '<script src="'.$this->getScriptFileUrl().'" async defer></script>';
    }

    /**
     * @return mixed|string
     */
    public function get_script_file_url()
    {
        return $this->getScriptFileUrl();
    }

    /**
     * @return string
     */
    public function get_html_element()
    {
        return '<div class="g-recaptcha" data-sitekey="'.$this->getSiteKey().'"></div>';
    }

    /**
     * @param  array|null  $action
     * @return CaptchaResponse
     */
    public function validate(array $action = null)
    {
        $response = new CaptchaResponse();
        if (!empty($action['g-recaptcha-response'])) {
            $data = [
                'secret'   => $this->getSecretKey(),
                'response' => $action['g-recaptcha-response'],
                'remoteip' => get_ip_address()
            ];
            $curl_client = curl_init();
            curl_setopt($curl_client, CURLOPT_URL, $this->getApiUrl());
            curl_setopt($curl_client, CURLOPT_POST, true);
            curl_setopt($curl_client, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl_client, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($curl_client);
            curl_close($curl_client);
            $response_data = json_decode($response_json);
            $response->setResponse($response_data)->setStatus($response_data->success);
        }
        return $response;
    }
}