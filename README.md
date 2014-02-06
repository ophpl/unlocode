# UN/LOCODE PHP API #

## Description ##

This package provides an API for UN/LOCODE - United Nations Code for Trade and Transport Locations

## Installation ##

### Define Your Dependencies ###

We recommend installing this package with [Composer](http://getcomposer.org/).
To do this, add `ophpl/unlocode` to your `composer.json` file.

```json
{
    "require": {
        "ophpl/unlocode": "dev-master"
    }
}
```

### Install Composer ###

Run in your project root:

```
curl -s http://getcomposer.org/installer | php
```

### Install Dependencies ###

Run in your project root:

```
php composer.phar install
```

### Build ###

Code list is available out of the box, but in case you want to update the data, you will need to rebuild the list:

```
php composer.phar install --dev
php console build
```