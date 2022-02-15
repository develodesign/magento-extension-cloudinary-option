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

namespace Develo\CloudinaryImageProductOption\Plugin\Sales\Model\Order;

/**
 * Magento Item plugin fixes the way option value is displayed in sales reports
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
class Item
{

    /**
     * Check if option type is cloudinaryimage and adjust value for sales reports
     *
     * @param \Magento\Sales\Model\Order\Item $subject Item Class
     * @param array                           $result  result
     *
     * @return mixed
     */
    public function afterGetProductOptions(
        \Magento\Sales\Model\Order\Item $subject,
        $result
    ) {
        foreach ($result as &$options) {
            if (is_array($options)) {
                foreach ($options as &$option) {
                    if (isset($option['option_type'])
                        && $option['option_type'] == 'cloudinaryimage'
                    ) {
                        $cloudinaryData = json_decode(
                            html_entity_decode($option['value'])
                        );
                        if (is_object($cloudinaryData)) {
                            $option['value'] = $cloudinaryData->secure_url;
                        }

                    }
                }
            }
        }
        return $result;
    }

}
