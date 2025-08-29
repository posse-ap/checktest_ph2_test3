FROM mysql:8.0.35

# Copy custom MySQL config if present
COPY ./etc/my.cnf /etc/mysql/conf.d/my.cnf

# Seed SQL will be mounted via docker-compose to /docker-entrypoint-initdb.d
