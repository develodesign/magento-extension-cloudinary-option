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

namespace Develo\CloudinaryImageProductOption\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions as CustomOptionsModifier;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Adds cloudinary image to the custom options with fields like Text group
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
class CustomOptions extends AbstractModifier
{

    /**
     * Meta array
     *
     * @var array
     */
    protected $meta = [];

    /**
     * Constructor
     *
     * @param UrlInterface          $urlBuilder   Magento Url Interface
     * @param LocatorInterface      $locator      Magento Locator Interface
     * @param StoreManagerInterface $storeManager Magento Store Manager Interface
     */
    public function __construct(
        UrlInterface $urlBuilder,
        LocatorInterface $locator,
        StoreManagerInterface $storeManager
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->locator = $locator;
        $this->storeManager = $storeManager;
    }

    /**
     * Returns Data
     *
     * @param array $data Data array
     *
     * @return array
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * Returns meta
     *
     * @param array $meta Meta array
     *
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;

        $this->addCustomOptionsFields();

        return $this->meta;
    }

    /**
     * Adds cloudinaryimage option to returned array of options
     *
     * @return void
     */
    protected function addCustomOptionsFields()
    {
        $groupCustomOptionsName = CustomOptionsModifier::GROUP_CUSTOM_OPTIONS_NAME;
        $optionContainerName = CustomOptionsModifier::CONTAINER_OPTION;
        $commonOptionContainerName = CustomOptionsModifier::CONTAINER_COMMON_NAME;
        $fieldTypeName = CustomOptionsModifier::FIELD_TYPE_NAME;

        // Add new option type to select
        $this->meta[$groupCustomOptionsName]['children']['options']['children']['record']['children']
        [$optionContainerName]['children']
        [$commonOptionContainerName]['children']
        [$fieldTypeName]['arguments']['data']['config']['groupsConfig']['text'] = $this->_addCloudinaryimageField();
    }


    /**
     * Returns array with Text type options with cloudinaryimage added to it
     *
     * @return array
     */
    private function _addCloudinaryimageField()
    {
        return [
            'values' => [
                'field',
                'area',
                'cloudinaryimage'
            ],
            'indexes' => [
                CustomOptionsModifier::CONTAINER_TYPE_STATIC_NAME,
                CustomOptionsModifier::FIELD_PRICE_NAME,
                CustomOptionsModifier::FIELD_PRICE_TYPE_NAME,
                CustomOptionsModifier::FIELD_SKU_NAME,
                CustomOptionsModifier::FIELD_MAX_CHARACTERS_NAME
            ],
        ];
    }
}
