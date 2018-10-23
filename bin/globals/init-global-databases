#!/usr/bin/env bash

set -e

readonly PARENT_DIR=$(cd $(dirname "${BASH_SOURCE[0]}") && pwd -P)
readonly LOCALENV_DIR=$(cd $(dirname $(dirname "$PARENT_DIR")) && pwd -P)

readonly BIN_DIR=$LOCALENV_DIR/bin
readonly CONFIGS_DIR=$LOCALENV_DIR/configs

source $BIN_DIR/utils/shell-helpers.sh

# Main function
main() {
  echo_yellow "Initializing global databases..."

  docker-compose -f $CONFIGS_DIR/global-databases-compose.yml build
  docker-compose -f $CONFIGS_DIR/global-databases-compose.yml up -d

  # Allow DB to spin up
  echo_yellow "Allowing DBs a chance to start up...\n"
  sleep 10

  echo_green "Global databases initialized!\n"
}

main
