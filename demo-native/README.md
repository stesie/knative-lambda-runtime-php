1. Prepare function code (in index.php)

```php
Hello World! You've reached <?php print($_SERVER['REQUEST_URI']); ?>
```

2. Deploy the build template

```
$ tm deploy buildtemplate -f https://raw.githubusercontent.com/stesie/knative-lambda-runtime-php/master/7.3-native/buildtemplate.yaml
```

3. Deploy function (aka service)

```
$ tm deploy service hello-php -f . --build-template knative-php73-native --wait
```
