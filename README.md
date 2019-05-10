# knative-lambda-runtime-php

This work is based on [TriggerMesh's KLR](https://github.com/triggermesh/knative-lambda-runtime).

It currently provides two different PHP 7.3 custom runtime environments on Knative/TriggerMesh.
Support for further PHP versions will be added as deemed fit.

Currently there are two distinct event/call models: *native* and *eventing*.

## native call model

The *native* call approach is geared towards PHP's normal (and compared to other languages)
special call model, i.e. the shared-nothing approach. The incoming invocation is mapped to
a normal PHP invocation, so request data can be read from the usual variables like `$_GET`
and `$_SERVER['REQUEST_URI']`.

This also means that PHP frameworks should be able to create `Request` models from those
global variables as usual.

This implementation for Knative is mostly based on
[Stackery's php-lambda-layer](https://github.com/stackery/php-lambda-layer), targeting AWS itself.

## eventing call model

The *eventing* call approach mimics FaaS call behaviour of other languages like
JavaScript/Node. Your FaaS code is supposed to provide a function, which a event object
as passed to, and it is expected that you return the result/response model from this
particular function. Furthermore it breaks with PHP's shared-nothing paradigm, i.e.
multiple events are subsequently passed to the same function instance without resetting
PHP's execution state.

This means you may (but likely still shouldn't) share (function local) state over
multiple invocations.

This implementation for Knative is mostly based on
[Parikshit Agnihotry's PHP-Lambda-Runtime](https://github.com/pagnihotry/PHP-Lambda-Runtime/).

## Using it

... see examples in the corresponding demo sub-folders: demo-native and demo-eventing.
