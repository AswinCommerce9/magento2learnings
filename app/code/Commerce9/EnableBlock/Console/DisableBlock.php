<?php
namespace Commerce9\EnableBlock\Console;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\App\State;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class DisableBlock extends Command
{
    const NAME = 'name';

    protected $blockRepositoryInterfaceFactory;
    protected $appState;

    public function __construct(
        State $appState,
        BlockRepositoryInterface $blockRepository,
        string $name = null
    ) {
        $this->appState = $appState;
        $this->blockRepositoryInterfaceFactory = $blockRepository;
        parent::__construct($name);
    }

    protected function configure()
    {

        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];

        $this->setName('c9:disableblock')
            ->setDescription('Static Block Disable')
            ->setDefinition($options);

        parent::configure();
    }

    public function getBlockcollection()
    {
         $block =$this->blockRepositoryInterfaceFactory->getById("1");
         $block->setIsActive(0);
         $block->save();

    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Static Block Disabled Successfully <3");
        $this->getBlockcollection();
        $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);
    }
}
