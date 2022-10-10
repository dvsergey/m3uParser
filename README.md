<div align="center">
    <h1>m3u Content Parser</h1>
    <h5>Minimalistic, easy to use, object orientated m3u playlist parser</h5>
</div>

### Example usage

```php

use dsv\m3u8Parser\M3uParser;

$parser = \dsv\m3u8Parser\M3uParser::init();
$parser->setM3uFile('https://iptv-org.github.io/iptv/countries/ru.m3u');
$data = $parser->parse();

var_dump($data);

```

### Installation

`composer require dvsergey/m3u-parser:@dev`

### Tests

`vendor/bin/phpunit`

#### Questions?

For all questions and suggestions - welcome to Issues
