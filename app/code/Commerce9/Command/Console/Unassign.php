<?php

namespace Commerce9\Command\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Unassign extends Command
{

    const NAME = 'name';

    public $_productCollectionFactory;

    protected $categoryLinkManagement;

    protected $categoryLinkRepository;

    private $state;


    public function __construct(
        CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagementInterface,
        \Magento\Framework\App\State $state,
        \Magento\Catalog\Model\CategoryLinkRepository $categoryLinkRepository,
        array $data = []
    )
    {
        $this->_productCollectionFactory= $productCollectionFactory;
        $this->categoryLinkManagement = $categoryLinkManagementInterface;
        $this->state = $state;
        $this->categoryLinkRepository = $categoryLinkRepository;
        parent::__construct($name = null);
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

        $this->setName('example:unassign')
            ->setDescription('Unassign Product to category')
            ->setDefinition($options);

        parent::configure();
    }

    public function getProductCollection()
    {
        $collection =$this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(100);
        return $collection;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("start unassigning please wait....");
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_GLOBAL);

        $collection =$this->getProductCollection();

        foreach ($collection as $product){
//            $pdtcategory = $product->getCategoryIds();
//
//            $categoryIds = [
//                9
//            ];
////            $categoryIds = array_unique(
////                array_merge(
////                    $product->getCategoryIds(),
////                    $categoryIds
////                )
////            );
//            $this->categoryLinkManagement->assignProductToCategories(
//                $product->getSku(),
//                $categoryIds
//            );
            $this->categoryLinkRepository->deleteByIds(9,$product->getSku());
            $output->writeln("unassigned product id -".$product->getId());
        }
        $output->writeln("finish Unassigning");
    }
}
