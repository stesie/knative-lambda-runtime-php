FROM alpine:latest as fetcher
RUN apk --no-cache add curl \
    && API_VERSION=$(curl -sI https://github.com/triggermesh/aws-custom-runtime/releases/latest | grep "Location:" | awk -F "/" '{print $NF}' | tr -d "\r") \
    && curl -sL https://github.com/triggermesh/aws-custom-runtime/releases/download/${API_VERSION}/aws-custom-runtime > aws-custom-runtime \
    && chmod +x aws-custom-runtime

FROM php:7.3-alpine
WORKDIR /opt
ENV LAMBDA_TASK_ROOT "/opt"

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && rm -f composer-setup.php \
    && docker-php-ext-install pdo_mysql \
    && mkdir -p /opt/bin \
    && ln -s /usr/local/bin/php /opt/bin/php

COPY --from=fetcher aws-custom-runtime .
ENTRYPOINT ["/opt/aws-custom-runtime"]
