#!/bin/sh
# https://stackoverflow.com/q/42567475/633864
seconds=1
until docker container exec -it contacts-database-1 mariadb-admin -h 127.0.0.1 ping -P 3306 | grep "mysqld is alive" ; do
  >&2 echo "MariaDB is unavailable - waiting for it... 😴 ($seconds)"
  sleep 1
  seconds=$(expr $seconds + 1)
done
sleep 1

