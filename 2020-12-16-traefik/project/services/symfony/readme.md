### Composer

linux
```
docker run --rm -it -v $PWD:/app -u $(id -u):$(id -g) composer install
```
windows
```
docker run --rm -it -v %cd%:/app composer install
```
---
### Docker-compose

nginx + fom\
`
docker-compose up -d --build
`

apache + mod php\
`
docker-compose -f docker-compose-apache.yml up -d --build
`

apache + fpm\
`
docker-compose -f docker-compose-apache-fpm.yml up -d --build
`
---
### HOSTS
```
127.0.0.1 symfony-nginx
127.0.0.1 symfony-apache
127.0.0.1 symfony-apache-fpm
```