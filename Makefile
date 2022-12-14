.PHONY : help start stop cli
help: ## Displays this list of targets with descriptions
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

start: ## Starts docker environment
	docker-compose up -d

stop: ## Stops docker environment
	docker-compose stop

cli: ## Enters the PHP CLI
	docker-compose run --rm php /bin/bash