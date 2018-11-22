
FROM mysql:5.6
COPY *.sql /docker-entrypoint-initdb.d/
COPY healthcheck /usr/local/bin/

FROM mysql:5.6
COPY *.sql /docker-entrypoint-initdb.d/
COPY healthcheck /usr/local/bin/
