#!/usr/bin/env bash

set -e

readonly PARENT_DIR=$(cd $(dirname "${BASH_SOURCE[0]}") && pwd -P)
readonly LOCALENV_DIR=$(cd $(dirname $(dirname "$PARENT_DIR")) && pwd -P)

readonly BIN_DIR=$LOCALENV_DIR/bin
readonly CONFIGS_DIR=$LOCALENV_DIR/configs

source $BIN_DIR/utils/shell-helpers.sh

# Main function
main() {
  echo_yellow "Initializing global caches..."

  docker-compose -f $CONFIGS_DIR/global-cache-compose.yml build
  docker-compose -f $CONFIGS_DIR/global-cache-compose.yml up -d

  echo_green "Global caches initialized!\n"
}

main
