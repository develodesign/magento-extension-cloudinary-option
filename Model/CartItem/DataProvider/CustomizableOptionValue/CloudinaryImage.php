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

namespace Develo\CloudinaryImageProductOption\Model\CartItem\DataProvider\CustomizableOptionValue;

use Magento\Catalog\Model\Product\Configuration\Item\ItemInterface;
use Magento\Catalog\Model\Product\Option;
use Magento\Catalog\Model\Product\Option\Type\Text as TextOptionType;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\GraphQl\Query\Uid;
use Magento\Quote\Model\Quote\Item as QuoteItem;
use Magento\Quote\Model\Quote\Item\Option as SelectedOption;
use Magento\QuoteGraphQl\Model\CartItem\DataProvider\CustomizableOptionValue\PriceUnitLabel;
use Magento\QuoteGraphQl\Model\CartItem\DataProvider\CustomizableOptionValueInterface;

/**
 * New cart item data provider model for Cloudinary Image Option Type
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
class CloudinaryImage implements CustomizableOptionValueInterface
{
    /**
     * Option type name
     */
    private const OPTION_TYPE = 'cloudinaryimage';

    /**
     * Magento Price Unit Label
     *
     * @var PriceUnitLabel
     */
    private $_priceUnitLabel;

    /**
     * Magento Uid Encoder
     *
     * @var Uid
     */
    private $_uidEncoder;

    /**
     * Constructor
     *
     * @param PriceUnitLabel $priceUnitLabel Magento price unit label
     * @param Uid|null       $uidEncoder     Magento Uis encoder
     */
    public function __construct(
        PriceUnitLabel $priceUnitLabel,
        Uid $uidEncoder = null
    ) {
        $this->_priceUnitLabel = $priceUnitLabel;
        $this->_uidEncoder = $uidEncoder ?: ObjectManager::getInstance()
            ->get(Uid::class);
    }

    /**
     * Retrieves product configuration options
     *
     * @param QuoteItem      $cartItem       Magento quote item
     * @param Option         $option         Magento option
     * @param SelectedOption $selectedOption Magento selected option
     *
     * @return array
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getData(
        QuoteItem $cartItem,
        Option $option,
        SelectedOption $selectedOption
    ): array {
        /**
         * Magento text option type
         *
 * @var TextOptionType $optionTypeRenderer
*/
        $optionTypeRenderer = $option->groupFactory($option->getType());
        $optionTypeRenderer->setOption($option);
        $priceValueUnits = $this->_priceUnitLabel->getData($option->getPriceType());

        $selectedOptionValueData = [
            'id' => $selectedOption->getId(),
            'customizable_option_value_uid' => $this->_uidEncoder->encode(
                self::OPTION_TYPE . '/' . $option->getOptionId()
            ),
            'label' => '',
            'value' => $optionTypeRenderer->getFormattedOptionValue(
                $selectedOption->getValue()
            ),
            'price' => [
                'type' => strtoupper($option->getPriceType()),
                'units' => $priceValueUnits,
                'value' => $option->getPrice(),
            ],
        ];
        return [$selectedOptionValueData];
    }
}
