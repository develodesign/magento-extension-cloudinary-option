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
namespace Develo\CloudinaryImageProductOption\Plugin\Catalog\Model\ResourceModel\Product;

/**
 * Plugin for Magento Option class resolving price and price types issue
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
class Option
{

    /**
     * Retrieves name of option group by option type
     *
     * @param \Magento\Catalog\Model\ResourceModel\Product\Option $subject Option class
     * @param mixed                                               $result  The result of plugin
     *
     * @return array
     */
    public function afterGetPriceTypes(
        \Magento\Catalog\Model\ResourceModel\Product\Option $subject,
        $result
    ) {
        //Your plugin code
        return array_merge(
            $result,
            [\Develo\CloudinaryImageProductOption\Api\Data\ProductCustomOptionInterface::OPTION_GROUP_DEVELO]
        );
    }
}
