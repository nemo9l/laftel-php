<h3 align="center"> <img src="https://asset.laftel.net/static/media/purple.e17b0b50.svg" alt="img" width="30" height=""> Laftel <img src="https://asset.laftel.net/static/media/purple.e17b0b50.svg" alt="img" width="30" height=""> </h3>

<h6 align="center">Unofficial PHP Laftel.net API Wrapper / Original by <a href="https://github.com/331leo/Laftel">331leo/Laftel</a></h6>

<div align="center" id="badges"> <img src="https://img.shields.io/packagist/php-v/nemo9l/laftel?color=816BFF&label=php&style=flat-square"> <img src="https://img.shields.io/packagist/v/nemo9l/laftel?color=816BFF&label=laftel&logo=php&style=flat-square"> <img src="https://img.shields.io/packagist/l/nemo9l/laftel?color=816BFF&logo=gnu&style=flat-square"> <img src="https://img.shields.io/packagist/dm/nemo9l/laftel?color=816BFF&style=flat-square"> </div>

---

## Installation

Requires PHP 7 or upper and composer

```bash
composer require nemo9l/laftel
composer install
```

## Usage

```php
$laftel = new \Nemo9l\Laftel\Laftel();

$result = $laftel->searchAnime('전생슬');
// Output: \Nemo9l\Laftel\Models\SearchResult[]

$info = $laftel->getAnimeInfo($result[0]->id);
// Output: \Nemo9l\Laftel\Models\AnimeInfo
```
