<?php

namespace Commerce9\OrderSuccess\Observer;

use Magento\Framework\Event\Observer;
use Magento\Checkout\Controller\Onepage\Success;
use Magento\Framework\Event\ObserverInterface;

class OrderSuccess implements ObserverInterface
{

    public $Success;

    public function __construct
    (

    )
    {

    }

    public function execute(Observer $observer)
    {
           // TODO: Implement execute() method.
    }
}
