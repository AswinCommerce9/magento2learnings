<?php
namespace Commerce9\Example\Block;
class Display extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    public function example()
    {
        return __('Say hello');
    }
}
