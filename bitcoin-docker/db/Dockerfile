# Use the following if using an M1 Mac/Arm platform
#FROM --platform=linux/arm64/v8 mariadb
FROM mariadb
COPY mysql.cnf /etc/mysql/conf.d/
COPY bitcoin.sql /tmp/
COPY setup.sh /docker-entrypoint-initdb.d/