## docker: Docker Composeファイルとコマンドを定義します。
COMPOSE_FILE := ./.local-dev/docker-compose.yml
DOCKER_COMPOSE := docker compose -f $(COMPOSE_FILE)

### build: キャッシュを使用せずにDockerコンテナイメージをビルドします
.PHONY: build
build:
	@$(DOCKER_COMPOSE) build --no-cache

### install: プロジェクト内のパッケージをインストールします
.PHONY: install
install:
	@$(DOCKER_COMPOSE) run --rm --entrypoint "composer install" laravel-playground && \
	$(DOCKER_COMPOSE) run --rm --entrypoint "npm i" laravel-playground

### up: Dockerコンテナイメージをデタッチモードで開始します
.PHONY: up
up:
	@$(DOCKER_COMPOSE) up -d

### down: コンテナとネットワークを停止して削除します
.PHONY: down
down:
	@$(DOCKER_COMPOSE) down
