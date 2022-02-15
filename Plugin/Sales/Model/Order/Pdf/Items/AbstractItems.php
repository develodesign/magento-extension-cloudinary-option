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

namespace Develo\CloudinaryImageProductOption\Plugin\Sales\Model\Order\Pdf\Items;

/**
 * Fixes print value for invoices and shipment pdfs
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
class AbstractItems
{

    /**
     * Check if option type is cloudinaryimage and adjust print value for pdfs
     *
     * @param \Magento\Sales\Model\Order\Item $subject Item Class
     * @param array                           $result  result
     *
     * @return mixed
     */
    public function afterGetItemOptions(
        \Magento\Sales\Model\Order\Pdf\Items\AbstractItems $subject,
        $result
    ) {
        foreach ($result as &$options) {
            if (isset($options['option_type'])
                && $options['option_type'] === 'cloudinaryimage'
            ) {
                $options['print_value'] = $options['value'];
            }
        }
        return $result;
    }
}
