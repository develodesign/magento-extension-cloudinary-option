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
namespace Develo\CloudinaryImageProductOption\Block\Adminhtml\Product\Edit\Tab\Options\Type;

/**
 * Cloudinaryimage option type set to render like text
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
class CloudinaryImage extends \Magento\Catalog\Block\Adminhtml\Product\Edit\Tab\Options\Type\AbstractType
{
    /**
     * Saving magento text type template
     *
     * @var string
     */
    protected $_template = 'Magento_Catalog::catalog/product/edit/options/type/text.phtml';
}
