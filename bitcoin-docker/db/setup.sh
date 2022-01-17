#!/bin/bash
OPTIONS="-u root --password=$MYSQL_ROOT_PASSWORD"

mysql "${OPTIONS}" -e "CREATE DATABASE bitcoin"
mysql "${OPTIONS}" bitcoin < /tmp/bitcoin.sql