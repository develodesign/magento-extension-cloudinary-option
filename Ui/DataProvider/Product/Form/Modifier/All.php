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

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

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
class All extends AbstractModifier implements ModifierInterface
{

    /**
     * Magento Pool Interface
     *
     * @var PoolInterface
     */
    protected $pool;

    /**
     * Meta Array
     *
     * @var array
     */
    protected $meta = [];

    /**
     * Constructor
     *
     * @param PoolInterface $pool Pool
     */
    public function __construct(
        PoolInterface $pool
    ) {
        $this->pool = $pool;
    }

    /**
     * Modifies data accordingly
     *
     * @param array $data Data array
     *
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function modifyData(array $data)
    {
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $data = $modifier->modifyData($data);
        }

        return $data;
    }

    /**
     * Modifies meta accordingly
     *
     * @param array $meta Meta array
     *
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;

        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $this->meta = $modifier->modifyMeta($this->meta);
        }

        return $this->meta;
    }
}
