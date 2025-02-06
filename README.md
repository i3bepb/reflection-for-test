# Reflection for test

[![Latest Stable Version](https://poser.pugx.org/i3bepb/reflection-for-test/v)](https://packagist.org/packages/i3bepb/reflection-for-test)
[![Total Downloads](https://poser.pugx.org/i3bepb/reflection-for-test/downloads)](https://packagist.org/packages/i3bepb/reflection-for-test)

Trait adding access method through reflection for tests

## Install
```
composer require --dev i3bepb/reflection-for-test
```

## How to use
When need call private method and check result in test, you can use trait **AccessToMethod**. Example:

```php
  
use I3bepb\ReflectionForTest\AccessToMethod;
use PHPUnit\Framework\TestCase;

class AnyTest extends TestCase
{
    use AccessToMethod;

    /**
     * Any test.
     *
     * @test
     *
     * @throws \ReflectionException
     */
    public function any_test()
    {
        $object = new ClassWithPrivateMethod();

        // In $resultPrivateMethod result after call private method
        $resultPrivateMethod = $this->privateMethodWithParameters($object, 'privateMethod', ['abc', 123]);
        
        // Any test...
    }


```

## Tests through docker

Download image
```
docker pull php:7.0.33-cli-alpine
```

Run container with volume into
```
docker run --rm -it -v $(pwd):/app -w /app php:7.0.33-cli-alpine sh
```

Into container get composer - https://getcomposer.org/download/
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

Now exist file **composer.phar** and you can download dependencies
```
php composer.phar install
```

Run tests
```
./vendor/bin/phpunit
```