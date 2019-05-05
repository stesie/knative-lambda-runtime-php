1. Prepare function code (in `function.php`)

```php
<?php

function handler($eventData)
{
    return [
        'statusCode' => 200,
        'body' => \json_encode([
            'blar' => 'foobar',
            'incoming_event' => $eventData,
        ]),
    ];
}
```

2. Deploy the build template

```
$ tm deploy buildtemplate -f https://raw.githubusercontent.com/stesie/knative-lambda-runtime-php/master/7.3-eventing/buildtemplate.yaml
```

3. Deploy the function

```
$ tm deploy service hello-php -f . --build-template knative-php73-eventing --env EVENT=API_GATEWAY --wait
```