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
namespace Develo\CloudinaryImageProductOption\Plugin\Catalog\Block\Adminhtml\Product\Composite\Fieldset;

use Develo\CloudinaryImageProductOption\Model\Product\Option;
use Magento\Framework\View\LayoutFactory;

/**
 * Magento Option plugin fixes backend rendering
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
class Options
{
    /**
     * Plugin sets childblock cloudinaryimage
     * for couldinaryimage type option renderer
     *
     * @param \Magento\Catalog\Block\Adminhtml\Product\Composite\Fieldset\Options $subject Options class
     * @param \Closure                                                            $proceed Closure
     * @param \Magento\Catalog\Model\Product\Option                               $option  Option class
     *
     * @return mixed
     */
    public function aroundGetOptionHtml(
        \Magento\Catalog\Block\Adminhtml\Product\Composite\Fieldset\Options $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Product\Option                               $option
    ) {

        if (Option::OPTION_TYPE_CLOUDINARYIMAGE === $option->getType()) {
            $renderer = $subject->getChildBlock('cloudinaryimage');
            $renderer->setSkipJsReloadPrice(1)
                ->setProduct($subject->getProduct())
                ->setOption($option);
        }
        $result = $proceed($option);
        return $result;
    }

}
