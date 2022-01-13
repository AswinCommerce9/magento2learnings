<?php
namespace Commerce9\CustomerCoupon\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\SalesRule\Model\CouponGenerator;

class Index extends Action
{
    protected $_pageFactory;
    public $couponGenerator;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        couponGenerator $couponGenerator
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->couponGenerator =$couponGenerator;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = [
            'rule_id' => 1,
            'qty' => '1',
            'length' => '6',
            'format' => 'alphanum'
        ];

        $code = $this->couponGenerator->generateCodes($data);

        print_r($code[0]);
    }
}
