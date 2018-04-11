**Deprecated**

![Resty - Logger](https://mostofreddy.github.io/resty_logger/images/resty_logger.png)

Logger simple y liviano, PSR-3 compatible y agnostico a cualquier Framework

[![Build Status](https://travis-ci.org/mostofreddy/resty_logger.svg?branch=master)](https://travis-ci.org/mostofreddy/resty_logger)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mostofreddy/resty_logger/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mostofreddy/resty_logger/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/mostofreddy/resty_logger/badge.svg?branch=master)](https://coveralls.io/github/mostofreddy/resty_logger?branch=master)

## Versión


__1.0.0__

## Requerimientos

* PHP 7.1+

## Documentación

Ver [Wiki](https://github.com/mostofreddy/resty_logger/wiki)

## License

The MIT License (MIT). Ver el archivo [LICENSE](LICENSE.md) para más información


## Instalación

```
{
    "require": {
        "restyphp/logger": "1.0.*"
    }
}
```

## Ejemplo

```php
use Resty\Logger\LogLevel;
use Resty\Logger\Handler\File;
use Resty\Logger\Handler\Dummy;
use Resty\Logger\Logger;

$fileHandler = (new File())
    ->config([
        'logLevel' => LogLevel::ALERT,
        'output' => '/tmp',
        'channel' => 'default'
    ]);

$fileHandler2 = (new File())
    ->config([
        'logLevel' => LogLevel::DEBUG,
        'output' => '/tmp',
        'channel' => 'db'
    ]);

$dummyHandler = new Dummy();

$logger = (new Logger())
    ->append($fileHandler)
    ->append($fileHandler2)
    ->append($dummyHandler);

$logger->alert("Este es un mensaje", []);
$logger->debug("Este es otro mensaje!", []);


// archivo: /tmp/log_20180102.log

[2018-01-02T20:53:51+00:00] alert 7177fb4c1d3506cf67d5dd5aab34d969 @default - Este es un mensaje - []
[2018-01-02T20:53:51+00:00] alert 7177fb4c1d3506cf67d5dd5aab34d969 @db - Este es un mensaje - []
[2018-01-02T20:53:51+00:00] debug 7177fb4c1d3506cf67d5dd5aab34d969 @db - Este es otro mensaje! - []

```
