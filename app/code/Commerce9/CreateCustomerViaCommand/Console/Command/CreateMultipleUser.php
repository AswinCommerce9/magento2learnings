<?php

namespace Commerce9\CreateCustomerViaCommand\Console\Command;

use Commerce9\CreateCustomerViaCommand\Helper\Customer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateMultipleUser extends Command
{
    protected $customerHelper;

    public function __construct(Customer $customerHelper)
    {
        $this->customerHelper = $customerHelper;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('c9:customers:account:create')
            ->setDescription('Create new customer')
            ->setDefinition($this->getOptionsList());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Creating customers account</info>');
        $this->customerHelper->setData($input);
        $this->customerHelper->createMultipleCustomerAccount();
    }

    protected function getOptionsList()
    {
        return [
            new InputOption(Customer::ARG_COUNT, null, InputOption::VALUE_REQUIRED, '(Required) Count is required'),
            new InputOption(Customer::ARG_WEBSITE, null, InputOption::VALUE_REQUIRED, '(Required) Website ID')
        ];
    }
}
