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

namespace Develo\CloudinaryImageProductOption\Model\Config\Source;

/**
 * Source for System Config sources
 *
 * @category  Magento
 * @package   Develo_CloudinaryImageProductOption
 * @author    Develo Design <info@develodesign.co.uk>
 * @copyright 2022 Develo Design
 * @license   https://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      www.develodesign.co.uk
 */
class Sources implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * Returns array of values with labels translatable
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
                    ['value' => 'local', 'label' => __('Local')],
                    ['value' => 'url', 'label' => __('Url')],
                    ['value' => 'camera', 'label' => __('Camera')],
                    ['value' => 'image_search', 'label' => __('Image Search')],
                    ['value' => 'google_drive', 'label' => __('Google Drive')],
                    ['value' => 'facebook', 'label' => __('Facebook')],
                    ['value' => 'dropbox', 'label' => __('Dropbox')],
                    ['value' => 'instagram', 'label' => __('Instagram')],
                    ['value' => 'shutterstock', 'label' => __('Shutterstock')],
                    ['value' => 'getty', 'label' => __('Getty')],
                    ['value' => 'istock', 'label' => __('Istock')],
                    ['value' => 'unsplash', 'label' => __('Unsplash')]
                ];
    }

    /**
     * Returns array of options with translations
     *
     * @return array
     */
    public function toArray()
    {
        return [
                'local' => __('local'),
                'url' => __('url'),
                'camera' => __('camera'),
                'image_search' => __('image search'),
                'google_drive' => __('google drive'),
                'facebook' => __('facebook'),
                'dropbox' => __('dropbox'),
                'instagram' => __('instagram'),
                'shutterstock' => __('shutterstock'),
                'getty' => __('getty'),
                'istock' => __('istock'),
                'unsplash' => __('unsplash'),
            ];
    }
}
