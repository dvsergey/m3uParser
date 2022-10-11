<div align="center">
    <h1>m3u Content Parser</h1>
    <h5>Minimalistic, easy to use, object orientated m3u playlist parser</h5>
</div>

### Example usage

```php

use dsv\m3u8Parser\M3uParser;

$parser = \dsv\m3u8Parser\M3uParser::init();
$parser->setM3uFile('https://iptv-org.github.io/iptv/countries/ru.m3u');
$parser->parse();

/** @var M3uItem $m3uItem */
foreach ($parser->items as $m3uItem) {
    var_dump($m3uItem);
}
```

### Installation

`composer require dvsergey/m3u-parser:@dev`

### Tests

`vendor/bin/phpstan`
`vendor/bin/phpunit`

#### Questions?

For all questions and suggestions - welcome to Issues
