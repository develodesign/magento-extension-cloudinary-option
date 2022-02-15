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

namespace Develo\CloudinaryImageProductOption\Model\Product;

use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Same as Magento model but adds cloudinaryimage type
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
class Option extends AbstractExtensibleModel
{

    const OPTION_GROUP_DEVELO = 'cloudinaryimage';

    const OPTION_TYPE_CLOUDINARYIMAGE = 'cloudinaryimage';

    /**
     * Constructor
     *
     * @return mixed
     */
    protected function _construct()
    {
        $this->_init(
            'Develo\CloudinaryImageProductOption\Model\ResourceModel\Product\Option'
        );
        parent::_construct();
    }

    /**
     * Retrieves name of option group by option type
     *
     * @param $type Magento option type
     *
     * @return string
     */
    public function getGroupByType($type = null)
    {

        if ($type === null) {
            $type = $this->getType();
        }
        $optionGroupsToTypes = [
            self::OPTION_TYPE_CLOUDINARYIMAGE => self::OPTION_GROUP_DEVELO,
        ];

        return isset($optionGroupsToTypes[$type]) ? $optionGroupsToTypes[$type] : '';
    }


    /**
     * Creates option type
     *
     * @param $type Magento option type
     *
     * @return mixed
     */
    public function groupFactory($type)
    {

        $group = $this->getGroupByType($type);
        if (! empty($group)) {
            return $this->optionTypeFactory->create(
                'Develo\CloudinaryImageProductOption\Model\Product\Option\Type\CloudinaryImage'
            );
        }
        throw new LocalizedException(
            __(
                'The option type to get group instance is incorrect.'
            )
        );
    }

    /**
     * Prepare to save
     *
     * @return mixed
     */
    public function beforeSave()
    {
        parent::beforeSave();
        if ($this->getData('previous_type') != '') {
            $previousType = $this->getData('previous_type');

            if ($this->getGroupByType($previousType) != $this->getGroupByType(
                $this->getData('type')
            )
            ) {
                switch ($this->getGroupByType($previousType))
                {
                case self::OPTION_GROUP_DEVELO:
                    $this->setData('max_characters', 'NULL');
                    break;
                }
            }
        }

        return $this;
    }
}
