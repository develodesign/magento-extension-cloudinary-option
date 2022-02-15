<?php
/**
 * Cloudinary Image Product Option.
 *
 * PHP version 7.4
 *
 * @category  Magento
 * @package   Develo_CloudinaryImageProductOption
 * @author    Develo Design <info@develodesign.co.uk>
 * @copyright 2022 Develo Design
 * @license   https://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      www.develodesign.co.uk
 */
declare(strict_types=1);

namespace Develo\CloudinaryImageProductOption\Rewrite\Magento\Catalog\Helper\Product;

use Magento\Catalog\Model\Product\Configuration\Item\ItemInterface;
use Magento\Catalog\Model\Product\OptionFactory;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\Filter\FilterManager;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Stdlib\StringUtils;


/**
 * Rewrite of helper for fetching properties by product configurational item
 *
 * @category  Magento
 * @package   Develo_CloudinaryImageProductOption
 * @author    Develo Design <info@develodesign.co.uk>
 * @copyright 2022 Develo Design
 * @license   https://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      www.develodesign.co.uk
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class Configuration extends \Magento\Catalog\Helper\Product\Configuration
{
    /**
     * Filter manager
     *
     * @var FilterManager
     */
    protected $filter;

    /**
     * Product option factory
     *
     * @var OptionFactory
     */
    protected $productOptionFactory;

    /**
     * Magento string lib
     *
     * @var StringUtils
     */
    protected $string;

    /**
     * Magento Serializer
     *
     * @var Json
     */
    private $_serializer;

    /**
     * Magento Escaper
     *
     * @var Escaper
     */
    private $_escaper;



    /**
     * Class contructor
     *
     * @param Context       $context              Magento context
     * @param OptionFactory $productOptionFactory Magento Option Factory
     * @param FilterManager $filter               Magento Filter Maganer
     * @param StringUtils   $string               Magento String lib
     * @param Json          $serializer           Magento Serializer
     * @param Escaper       $escaper              Magento Escaper
     */
    public function __construct(
        Context         $context,
        OptionFactory   $productOptionFactory,
        FilterManager   $filter,
        StringUtils     $string,
        Json            $serializer = null,
        Escaper         $escaper = null
    ) {
        $this->productOptionFactory = $productOptionFactory;
        $this->filter = $filter;
        $this->string = $string;
        $this->_serializer = $serializer ?: ObjectManager::getInstance()
            ->get(Json::class);
        $this->_escaper = $escaper ?: ObjectManager::getInstance()
            ->get(Escaper::class);
        parent::__construct($context, $productOptionFactory, $filter, $string);
    }

    /**
     * Retrieves product configuration options
     *
     * @param ItemInterface $item Magento item interface
     *
     * @return array
     */
    public function getCustomOptions(ItemInterface $item)
    {
        $product = $item->getProduct();
        $options = [];
        $optionIds = $item->getOptionByCode('option_ids');
        if ($optionIds) {
            $options = [];
            foreach (explode(',', $optionIds->getValue()) as $optionId) {
                $option = $product->getOptionById($optionId);
                if ($option) {
                    $itemOption = $item->getOptionByCode('option_'.$option->getId());
                    /**
                     * Default type magento magic
                     *
 * @var $group \Magento\Catalog\Model\Product\Option\Type\DefaultType
*/
                    $group = $option->groupFactory($option->getType())
                        ->setOption($option)
                        ->setConfigurationItem($item)
                        ->setConfigurationItemOption($itemOption);

                    if ('file' == $option->getType()) {
                        $downloadParams = $item->getFileDownloadParams();
                        if ($downloadParams) {
                            $url = $downloadParams->getUrl();
                            if ($url) {
                                $group->setCustomOptionDownloadUrl($url);
                            }
                            $urlParams = $downloadParams->getUrlParams();
                            if ($urlParams) {
                                $group->setCustomOptionUrlParams($urlParams);
                            }
                        }
                    }

                    if ('cloudinaryimage' === $option->getType()) {
                        $cloudinaryValue = \Safe\json_decode(
                            $itemOption->getValue()
                        );
                        $options[] = [
                            'label' => $option->getTitle(),
                            'value' => $this->_getCloudinaryCustomView(
                                $cloudinaryValue->secure_url
                            ),
                            'print_value' => $group->getPrintableOptionValue(
                                $cloudinaryValue->secure_url
                            ),
                            'option_id' => $option->getId(),
                            'option_type' => $option->getType(),
                            'custom_view' => true
                        ];
                    } else {
                        $options[] = [
                            'label' => $option->getTitle(),
                            'value' => $group->getFormattedOptionValue(
                                $itemOption->getValue()
                            ),
                            'print_value' => $group->getPrintableOptionValue(
                                $itemOption->getValue()
                            ),
                            'option_id' => $option->getId(),
                            'option_type' => $option->getType(),
                            'custom_view' => $group->isCustomizedView(),
                        ];
                    }
                }
            }
        }

        $addOptions = $item->getOptionByCode('additional_options');
        if ($addOptions) {
            $options = array_merge(
                $options,
                $this->_serializer->unserialize($addOptions->getValue())
            );
        }

        return $options;
    }


    /**
     * Returns html markup to rended an image
     *
     * @param $link img secure url
     *
     * @return string
     */
    private function _getCloudinaryCustomView($link)
    {

        return "<img style='max-width:150px;max-height:150px;' src='".
            $link.
            "' alt='".
            $link.
            "'>";

    }
}

