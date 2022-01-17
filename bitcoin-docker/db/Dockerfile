FROM mysql:5.7.24
COPY mysql.cnf /etc/mysql/conf.d/
COPY bitcoin.sql bitcoin.sql /tmp/
COPY setup.sh /docker-entrypoint-initdb.d/