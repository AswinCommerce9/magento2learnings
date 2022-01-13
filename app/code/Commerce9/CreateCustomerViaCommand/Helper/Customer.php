<?php

namespace Commerce9\CreateCustomerViaCommand\Helper;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\State;
use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Input\Input;

class Customer extends AbstractHelper
{
    const ARG_COUNT = 'count';
    const ARG_EMAIL = 'email';
    const ARG_FIRSTNAME = 'firstname';
    const ARG_LASTNAME = 'lastname';
    const ARG_PASSWORD = 'password';
    const ARG_WEBSITE = 'website';
    const ARG_SENDEMAIL = 'send-email';

    protected $storeManager;
    protected $state;
    protected $customerFactory;
    protected $data;
    protected $customerId;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        State $state,
        CustomerFactory $customerFactory
    ) {
        $this->storeManager = $storeManager;
        $this->state = $state;
        $this->customerFactory = $customerFactory;

        parent::__construct($context);
    }

    public function setData(Input $input)
    {
        $this->data = $input;
        return $this;
    }

    public function createMultipleCustomerAccount()
    {
        $website = $this->data->getOption(self::ARG_WEBSITE) ? $this->data->getOption(self::ARG_WEBSITE) : 1;
        $count = 100;

        for ($i =1;$i<=$count;$i++) {
            $customer = $this->customerFactory->create();
            $customerEmail = 'Test.User' . $i . '@gmail.com';
            $customerFirstName = "Aswin";
            $customerLastName = "User";
            $customerPassword = "admin@123";

            $customer
                ->setWebsiteId($website)
                ->setEmail($customerEmail)
                ->setFirstname($customerFirstName)
                ->setLastname($customerLastName)
                ->setPassword($customerPassword);
            $customer->save();

            echo $i . ". Account is created for " . $customerEmail . "\n";
        }
    }
    public function execute()
    {
        $this->state->setAreaCode('frontend');
        $this->createMultipleCustomerAccount();

    }

    public function getCustomerId()
    {
        return (int)$this->customerId;
    }
}
