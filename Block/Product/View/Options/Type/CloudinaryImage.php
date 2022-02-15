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
namespace Develo\CloudinaryImageProductOption\Block\Product\View\Options\Type;

use Magento\Catalog\Pricing\Price\CalculateCustomOptionCatalogRule;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Pricing\Adjustment\CalculatorInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Framework\Registry;

/**
 * Cloudinary Image Product Option type block
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
class CloudinaryImage extends \Magento\Catalog\Block\Product\View\Options\AbstractOptions
{

    /**
     * Magento registry
     *
     * @var Registry
     */
    private Registry $_registry;

    /**
     * Magento Scope Config Interface
     *
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;


    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context       Magento Context
     * @param \Magento\Framework\Pricing\Helper\Data           $pricingHelper Magento Pricing Helper
     * @param \Magento\Catalog\Helper\Data                     $catalogData   Magento Data Helper
     * @param Registry                                         $registry      Magento Registry
     * @param ScopeConfigInterface                             $scopeConfig   MAgento Scope Config Interface
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Pricing\Helper\Data $pricingHelper,
        \Magento\Catalog\Helper\Data $catalogData,
        Registry $registry,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context, $pricingHelper, $catalogData);
        $this->_registry = $registry;
        $this->scopeConfig = $scopeConfig;
    }


    /**
     * Returns default value to show in text input
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->getProduct()->getPreconfiguredValues()->getData(
            'options/' . $this->getOption()->getId()
        );
    }


    /**
     * Setting cloudinary_script variable in registry
     *
     * @return void
     */
    public function setCloudinaryScriptAdded()
    {
        $this->_registry->register('cloudinary_script', '1');
    }

    /**
     * Retrieving cloudinary_script variable from registry
     *
     * @return string
     */
    public function getCloudinaryScriptAdded()
    {
        return $this->_registry->registry('cloudinary_script');
    }


    /**
     * Retrieving config settings and formats them into JSON string
     *
     * @return string
     * @throws \JsonException
     */
    public function getCloudinarySettings()
    {
        $cloudName = $this->scopeConfig->getValue(
            'cloudinary_image/backend_configuration/cloud_name',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $apiKey = $this->scopeConfig->getValue(
            'cloudinary_image/backend_configuration/api_key',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $uploadPreset = $this->scopeConfig->getValue(
            'cloudinary_image/backend_configuration/upload_preset',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $showAdvancedOptions = $this->scopeConfig->getValue(
            'cloudinary_image/frontend_configuration/show_advanced_options',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $cropping = $this->scopeConfig->getValue(
            'cloudinary_image/frontend_configuration/cropping',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $styles = $this->scopeConfig->getValue(
            'cloudinary_image/frontend_configuration/styles',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $sources = $this->scopeConfig->getValue(
            'cloudinary_image/frontend_configuration/sources',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $dropboxAppKey = $this->scopeConfig->getValue(
            'cloudinary_image/sources_api_keys/dropbox_app_key',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $facebookAppId = $this->scopeConfig->getValue(
            'cloudinary_image/sources_api_keys/facebook_app_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $googleApiKey = $this->scopeConfig->getValue(
            'cloudinary_image/sources_api_keys/google_api_key',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $instagramClientId = $this->scopeConfig->getValue(
            'cloudinary_image/sources_api_keys/instagram_client_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $googleDriveClientId = $this->scopeConfig->getValue(
            'cloudinary_image/sources_api_keys/google_drive_client_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );


        $styles = \Safe\json_decode(preg_replace('/\s+/', '', (string)$styles));

        $result = [
            "cloudName" => $cloudName,
            "apiKey" => $apiKey,
            "uploadPreset" => $uploadPreset,
            "showAdvancedOptions" => (boolean)$showAdvancedOptions,
            "cropping" => (boolean)$cropping,
            "multiple" => false,
            "defaultSource" => "local",
            "styles" => $styles,
            "sources" =>explode(",", $sources),
            "dropboxAppKey" => $dropboxAppKey,
            "facebookAppId" => $facebookAppId,
            "googleApiKey" => $googleApiKey,
            "instagramClientId" => $instagramClientId,
            "googleDriveClientId" => $googleDriveClientId
        ];

        return str_replace("\\", "", json_encode($result, JSON_THROW_ON_ERROR));
    }
}
