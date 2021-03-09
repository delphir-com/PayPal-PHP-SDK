<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Validation\UrlValidator;

/**
 * Class ApplicationContext
 *
 * A resource representing an agreement.
 *
 * @package PayPal\Api
 *
 * @property string cancel_url
 * @property string return_url
 */

class ApplicationContext extends PayPalResourceModel
{

    /**
     * Redirect URL on cancellation of agreement request. 1000 characters max.
     *
     * @param string $cancel_url
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setCancelUrl($cancel_url)
    {
        UrlValidator::validate($cancel_url, "CancelUrl");
        $this->cancel_url = $cancel_url;
        return $this;
    }

    /**
     * Redirect URL on cancellation of agreement request. 1000 characters max.
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->cancel_url;
    }


    /**
     * Redirect URL on creation of agreement request. 1000 characters max.
     *
     * @param string $return_url
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setReturnUrl($return_url)
    {
        UrlValidator::validate($return_url, "ReturnUrl");
        $this->return_url = $return_url;
        return $this;
    }

    /**
     * Redirect URL on creation of agreement request. 1000 characters max.
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }
}