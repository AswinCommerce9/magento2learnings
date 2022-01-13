<?php

namespace Com9\ConsoleModule\Console;

//use Magento\Catalog\Api\Data\ProductInterfaceFactory;
//use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
//use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Enableproduct extends Command
{
    const NAME = 'name';

    protected $ProductInterfaceFactory;
    protected $ProductInterface;
    protected $productRepository;
    protected $_productCollectionFactory;
    protected $appState;
    protected $StoreManagerInterface;

    public function __construct(
//        StoreManagerInterface $StoreManagerInterface,
//        ProductInterfaceFactory $ProductInterfaceFactory,
//        ProductInterface $ProductInterface,
        ProductRepositoryInterface $productRepository,
        CollectionFactory $_productCollectionFactory,
        State $appState,
        string $name = null
    ) {
//        $this->ProductInterfaceFactory = $ProductInterfaceFactory;
//        $this->ProductInterface = $ProductInterface;
        $this->productRepository =$productRepository;
        $this->_productCollectionFactory = $_productCollectionFactory;
//        $this->StoreManagerInterface =$StoreManagerInterface;
        $this->appState = $appState;
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

        $this->setName('p:productenable')
             ->setDescription('Enable Product')
             ->setDefinition($options);
        parent::configure();
    }

    public function getProductCollection()
    {
//        $this->StoreManagerInterface->getStore()->getId();

        $repo = $this->productRepository->getById(1);
        $repo->setStatus(1);

        $this->productRepository->save($repo);
//        $collection = $this->_productCollectionFactory->create();
//        foreach ($collection as $product) {
//            $productId =$product->getId();
//            $product->load($productId);
//            $product->setStatus(1);
//            $product->save();
//        }
//        return $collection;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->appState->setAreaCode(Area::AREA_GLOBAL);
        $output->writeln("Product enabled successfully");
        $this->getProductCollection();
    }
}
