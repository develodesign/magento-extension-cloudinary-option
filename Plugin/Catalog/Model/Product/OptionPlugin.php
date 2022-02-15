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
namespace Develo\CloudinaryImageProductOption\Plugin\Catalog\Model\Product;

use Magento\Catalog\Model\Product\Option;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\StringUtils;

/**
 * Plugin around Magento Product Option fixes group by type issue
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
class OptionPlugin
{

    /**
     * Product option factory
     *
     * @var \Magento\Catalog\Model\Product\Option\Type\Factory
     */
    protected $optionTypeFactory;

    /**
     * Magento String Utils
     *
     * @var \Magento\Framework\Stdlib\StringUtils
     */
    protected $string;


    /**
     * Constructor
     *
     * @param Option\Type\Factory $optionFactory Magento OptionFactory
     * @param StringUtils         $string        String
     */
    public function __construct(
        \Magento\Catalog\Model\Product\Option\Type\Factory $optionFactory,
        StringUtils $string
    ) {
        $this->optionTypeFactory = $optionFactory;
        $this->string = $string;
    }

    /**
     * Group model factory
     *
     * @param Option    $subject Option class
     * @param \Clousure $proceed clousure
     * @param string    $type    string
     *
     * @return \Magento\Catalog\Model\Product\Option\Type\DefaultType
     * @throws LocalizedException
     */
    public function aroundGroupFactory(Option $subject,
        \Closure $proceed,
        $type = null
    ) {
        try {
            $result =  $proceed($type);
            return $result;
        } catch (LocalizedException $ex) {
            $group = $this->_getGroupByType($type);
            if (!empty($group)) {
                return $this->optionTypeFactory->create(
                    'Develo\CloudinaryImageProductOption\Model\Product\Option\Type\CloudinaryImage'
                );
            }
            throw new LocalizedException(
                __('The option type to get group instance is incorrect.')
            );
        }
    }

    /**
     * Returns a string where option cloudinaryimage is assigned to group cloudinaryimage
     *
     * @param $type string
     *
     * @return mixed|string
     */
    private function _getGroupByType($type = null)
    {
         $optionGroupsToTypes = [
            \Develo\CloudinaryImageProductOption\Model\Product\Option::OPTION_TYPE_CLOUDINARYIMAGE =>
                \Develo\CloudinaryImageProductOption\Model\Product\Option::OPTION_GROUP_DEVELO,
                    ];

         return isset($optionGroupsToTypes[$type]) ? $optionGroupsToTypes[$type] : '';
    }
}
