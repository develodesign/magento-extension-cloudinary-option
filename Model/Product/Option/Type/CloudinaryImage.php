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

namespace Develo\CloudinaryImageProductOption\Model\Product\Option\Type;

use Magento\Framework\Exception\LocalizedException;

/**
 * Extends Magento's Product Option DefaultType
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
class CloudinaryImage extends \Magento\Catalog\Model\Product\Option\Type\DefaultType
{
    /**
     * Magento string lib
     *
     * @var \Magento\Framework\Stdlib\StringUtils
     */
    protected $string;

    /**
     * Magento Escaper
     *
     * @var \Magento\Framework\Escaper
     */
    protected $escaper = null;

    /**
     * Constructor
     *
     * @param \Magento\Checkout\Model\Session                    $checkoutSession Magento Session
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig     Magento ScopeConfigInterface
     * @param \Magento\Framework\Escaper                         $escaper         Magento Escaper
     * @param \Magento\Framework\Stdlib\StringUtils              $string          Magento String utils
     * @param array                                              $data            an array
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\Stdlib\StringUtils $string,
        array $data = []
    ) {
        $this->escaper = $escaper;
        $this->string = $string;
        parent::__construct($checkoutSession, $scopeConfig, $data);
    }

    /**
     * Validate user input for option
     *
     * @param array $values All product option values,
     *                      i.e. array (option_id => mixed, option_id => mixed...)
     *
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function validateUserValue($values)
    {
        parent::validateUserValue($values);

        $option = $this->getOption();
        $value = trim($this->getUserValue());

        // Check requires option to have some value
        if (strlen($value) == 0
            && $option->getIsRequire()
            && !$this->getSkipCheckRequiredOption()
        ) {

            $this->setIsValid(false);
            throw new LocalizedException(
                __("The product's required option(s) weren't entered. Make sure the options are entered and try again.")
            );

        }

        // Check maximal length limit
        $maxCharacters = $option->getMaxCharacters();
        $value = $this->_normalizeNewLineSymbols($value);
        if ($maxCharacters > 0 && $this->string->strlen($value) > $maxCharacters) {
            $this->setIsValid(false);
            throw new LocalizedException(
                __('The text is too long. Shorten the text and try again.')
            );
        }

        $this->setUserValue($value);
        return $this;
    }

    /**
     * Prepare option value for cart
     *
     * @return string|null Prepared option value
     */
    public function prepareForCart()
    {
        if ($this->getIsValid() && ($this->getUserValue() !== '')) {
            return $this->getUserValue();
        } else {
            return null;
        }
    }

    /**
     * Return formatted option value for quote option
     *
     * @param string $value Prepared for cart option value
     *
     * @return string
     */
    public function getFormattedOptionValue($value)
    {
        return $this->escaper->escapeHtml($value);
    }

    /**
     * Normalize newline symbols
     *
     * @param string $value a string
     *
     * @return string
     */
    private function _normalizeNewLineSymbols(string $value)
    {
        return str_replace(["\r\n", "\n\r", "\r"], "\n", $value);
    }
}
