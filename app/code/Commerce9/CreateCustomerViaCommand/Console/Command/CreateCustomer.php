<?php
namespace Commerce9\CreateCustomerViaCommand\Console\Command;

use Commerce9\CreateCustomerViaCommand\Helper\Customer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerCreateCommand extends Command
{
    protected $customerHelper;

    public function __construct(Customer $customerHelper)
    {
        $this->customerHelper = $customerHelper;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('c9:customers:create')
            ->setDescription('Create new customer')
            ->setDefinition($this->getOptionsList());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Creating new user...</info>');
        $this->customerHelper->setData($input);
        $this->customerHelper->execute();

        $output->writeln('');

        $output->writeln('<info>User created with the following data:</info>');
        $output->writeln('');
        $output->writeln('<comment>Customer ID: ' . $this->customerHelper->getCustomerId());
        $output->writeln('<comment>Customer Website ID ' . $input->getOption(Customer::ARG_WEBSITE));
        $output->writeln('<comment>Customer First Name: ' . $input->getOption(Customer::ARG_FIRSTNAME));
        $output->writeln('<comment>Customer Last Name: ' . $input->getOption(Customer::ARG_LASTNAME));
        $output->writeln('<comment>Customer Email: ' . $input->getOption(Customer::ARG_EMAIL));
        $output->writeln('<comment>Customer Password: ' . $input->getOption(Customer::ARG_PASSWORD));
        $output->writeln('');
    }

    protected function getOptionsList()
    {
        return [
            new InputOption(Customer::ARG_FIRSTNAME, null, InputOption::VALUE_REQUIRED, '(Required) Customer first name'),
            new InputOption(Customer::ARG_LASTNAME, null, InputOption::VALUE_REQUIRED, '(Required) Customer last name'),
            new InputOption(Customer::ARG_EMAIL, null, InputOption::VALUE_REQUIRED, '(Required) Customer email'),
            new InputOption(Customer::ARG_PASSWORD, null, InputOption::VALUE_REQUIRED, '(Required) Customer password'),
            new InputOption(Customer::ARG_WEBSITE, null, InputOption::VALUE_REQUIRED, '(Required) Website ID'),
            new InputOption(Customer::ARG_SENDEMAIL, 0, InputOption::VALUE_OPTIONAL, '(1/0) Send email? (default 0)')
        ];
    }
}
