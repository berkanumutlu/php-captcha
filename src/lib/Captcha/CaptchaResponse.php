<?php

namespace App\Library\Captcha;

class CaptchaResponse
{
    /**
     * @var mixed|null
     */
    private $response;
    /**
     * @var boolean|null
     */
    private $status = false;

    /**
     * @return mixed|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param  mixed|null  $response
     * @return CaptchaResponse
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param  bool|null  $status
     * @return CaptchaResponse
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}