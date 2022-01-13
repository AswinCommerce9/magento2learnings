<?php
/**
 * Umc_Base extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Umc
 * @package   Umc_Base
 * @copyright Marius Strajeru
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @author    Marius Strajeru <ultimate.module.creator@gmail.com>
 */
namespace Umc\Base\Downloader;

class Module implements DownloaderInterface
{
    /**
     * get relative path to the file
     *
     * @param string $file
     * @return string
     */
    public function getRelativePath($file)
    {
        return $file. '.tar.gz';
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Download Module Archive');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getErrorLabel()
    {
        return __('Module archive is not available');
    }
}
