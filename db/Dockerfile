FROM mysql:8.0.26

COPY ./etc/my.cnf /etc/my.cnf

COPY ./import.sql /
COPY ./import.sh /
RUN chmod 755 /import.sh
