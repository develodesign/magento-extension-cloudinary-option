# Magento 2 Module : Cloudinary Image Product Option

    ``develodesign/module-cloudinaryimageproductoption``
    
## Demo Video
 
[![Magento Cloudinary Product option](https://img.youtube.com/vi/zU9KM5e8rxY/0.jpg)](https://youtu.be/zU9KM5e8rxY)


- [Main Functionalities](#markdown-header-main-functionalities)
- [Installation](#markdown-header-installation)
- [Configuration](#markdown-header-configuration)
- [Links](#markdown-header-links)

## Main Functionalities

Adds new product option that uses Cloudinary to upload image.

## Installation

- in production please use the `--keep-generated` option

### Composer

* Place an order for the module through Develo Design Magento Marketplace.
* Open a terminal and run the following command in your Magento directory
```
composer require develodesign/module-cloudinaryimageproductoption
```
* Set up the module by running the following commands
```
php bin/magento module:enable Develo_CloudinaryImageProductOption
php bin/magento setup:upgrade
php bin/magento cache:flush
```
* If you are running Magento in production mode, you will also have to compile and deploy static content with
```
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```

### Uninstalling

To uninstall the module run the following commands in terminal in your Magento directory
```
php bin/magento module:disable Develo_CloudinaryImageProductOption
composer remove develodesign/module-cloudinaryimageproductoption
rm -rf app/code/Develo/CloudinaryImageProductOption
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

## Configuration

To set system config variables go to Stores -> Configuration -> Develo -> Cloudinary Image

### Backend Configuration
There are three variables necessary for the configuration. To get your cloudName, apiKey and upload preset log in to the Cloudinary’s dashboard. The cloud name and api key are visible in Account Details after you log in. To get your upload preset go to Settings -> Upload -> Upload preset and Add new upload preset where you can make some basic configuration.

### Frontend Configuration
- Show Advanced Options - enable/disable Advanced options for users in Cloudinary widget.
- Allow Cropping - enable/disable cropping of uploaded images.
- Styles - you can customize the feel and look of the widget by editing this JSON setting. For examples of the styles see https://demo.cloudinary.com/uw/#/ , but use the provided template.
- Sources - select sources available to your customers. Hold ‘ctrl’ to select multiple sources.

### Sources API Keys
- dropboxAppKey - Your DropBox App key. Required if adding the dropbox source.
- facebookAppId - The App ID of your own Facebook application. Defaults to using the Cloudinary Media Upload app to access their Facebook accounts if not provided.
- googleApiKey - Your API key needed to access Google APIs. Required if adding the image_search source.
- instagramClientId - The App ID of your own Instagram application for accessing your users Instagram accounts. Defaults to using the Cloudinary Media Upload app to access their Instagram accounts if not provided.
- instagramClientId - The Client ID of your own Google Drive application for accessing your users Google Drive accounts. Defaults to using the Cloudinary Google Drive app to access their accounts if not provided.

## Links

- [Magento Marketplace Listing](https://marketplace.magento.com/develodesign-module-cloudinaryimageproductoption.html).


[Developed by Develo](https://www.develodesign.co.uk).





