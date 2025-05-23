FROM node:24-bullseye AS node
FROM composer:2.8 AS composer

FROM dunglas/frankenphp:php8.4

WORKDIR /app

# 環境変数
## タイムゾーン
ENV TZ Asia/Tokyo

# composerコマンドをcomposerのDockerイメージからコピー
COPY --from=composer /usr/bin/composer /usr/bin/composer

# nodeコマンドをnodeのDockerイメージからコピー＆リンク
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/lib/node_modules/ /usr/local/lib/node_modules/
RUN ln -s /usr/local/bin/node /usr/local/bin/nodejs \
    && ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

# aptパッケージをインストール
RUN mkdir /etc/gcrypt && echo all > /etc/gcrypt/hwf.deny
RUN apt-get update && \
    apt-get install -y --no-install-recommends --fix-missing \
    git libicu-dev libonig-dev libzip-dev unzip locales libaio1 libnss3-tools && \
    apt-get clean

# php拡張をインストール
RUN install-php-extensions pcntl && \
    docker-php-ext-install pcntl
