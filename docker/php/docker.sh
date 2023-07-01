#!/bin/bash

# wait for the database service to be up and running
while ! ping -c 1 database >/dev/null 2>&1; do
    sleep 1
done

# Database migrations
symfony console d:m:m --no-interaction

# JWT keys generation and server start
if [ $? -eq 0 ]; then
    symfony console lexik:jwt:generate-keypair --overwrite
    symfony server:start --no-tls
fi
