FROM alpine:latest as fetcher
RUN apk --no-cache add curl \
    && API_VERSION=$(curl -sI https://github.com/triggermesh/aws-custom-runtime/releases/latest | grep "Location:" | awk -F "/" '{print $NF}' | tr -d "\r") \
    && curl -sL https://github.com/triggermesh/aws-custom-runtime/releases/download/${API_VERSION}/aws-custom-runtime > aws-custom-runtime \
    && chmod +x aws-custom-runtime

FROM php:7.3-alpine
WORKDIR /var/task
ENV LAMBDA_TASK_ROOT "/var/task"
RUN /usr/local/bin/docker-php-ext-install pcntl
ENV EVENT "API_GATEWAY"

COPY --from=fetcher aws-custom-runtime .
ENTRYPOINT ["/var/task/aws-custom-runtime"]

ADD bootstrap /var/task
