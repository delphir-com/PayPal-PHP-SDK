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
 * @property string brand_name
 * @property string locale
 * @property string shipping_preference
 * @property string cancel_url
 * @property string return_url
 */

class ApplicationContext extends PayPalResourceModel
{
    const SHIPPING_PREF__SET_PROVIDED_ADDRESS = 'SET_PROVIDED_ADDRESS';
    const SHIPPING_PREF__NO_SHIPPING          = 'NO_SHIPPING';

    /**
     * Sets the BrandName
     *
     * @param string $brand_name
     * @return $this
     */
    public function setBrandName($brand_name)
    {
        $this->brand_name = $brand_name;
        return $this;
    }

    /**
     * Get the BrandName
     *
     * @return string
     */
    public function getBrandName()
    {
        return $this->brand_name;
    }

    /**
     * Sets the Locale
     *
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Get the Locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Sets the ShippingPreference
     *
     * @param string $shipping_preference
     * @return $this
     */
    public function setShippingPreference($shipping_preference)
    {
        $this->shipping_preference = $shipping_preference;
        return $this;
    }

    /**
     * Get the ShippingPreference
     *
     * @return string
     */
    public function getShippingPreference()
    {
        return $this->shipping_preference;
    }

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