<?php

namespace Checkout\Payments\Request\Source\Apm;

use Checkout\Common\PaymentSourceType;
use Checkout\Payments\Request\Source\AbstractRequestSource;

class RequestSofortSource extends AbstractRequestSource
{
    public function __construct()
    {
        parent::__construct(PaymentSourceType::$sofort);
    }
}
