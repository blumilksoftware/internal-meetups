## Blumilk Internal Meetup #27
Blumilk environment for local development
<img data-src="presentations/2023-04-27-blumilk-environment-traefik/images/dev-env-docker-traefik.png">
<br>
27.04.2023
Marcin Tracz

---
### Why we need it?
\
<img data-src="presentations/2023-04-27-blumilk-environment-traefik/images/docker-everywhere.png">
<br>
<br>

---
### Meanwhile
<img height="500px" data-src="presentations/2023-04-27-blumilk-environment-traefik/images/docker-mac.png">
---
### Details
<br>

- created 20 Feb 2023

- public repo (https://github.com/blumilksoftware/environment)

- Traefik docs (https://doc.traefik.io/traefik/)

- README (https://github.com/blumilksoftware/environment/blob/main/readme.md)

- How to add new app (linked in readme above) (https://github.com/blumilksoftware/environment/blob/main/how%20to%20add%20new%20app.md)

<br><br><br><br><br><br>
---
### What we want to achieve?
<br><br>
- easy local development with multiple dockerized projects **without ports collisions** 

- easy(it's not) HTTPS in local environment

- easy configuration for new projects

<br><br><br><br>
---
### local development with docker and ports collisions?
_**failing because "port is already allocated"**_
<img data-src="presentations/2023-04-27-blumilk-environment-traefik/images/fck-docker.png">

---
### local development with docker and ports collisions?
<br>
This will end with a lot of projects on different ports, which are hard to remember.

- localhost:777
- localhost:2137
- localhost:8888
- localhost:WHAT-THE-HELL-NUMBER-IT-WAS

<br><br><br><br>
---
### How we solved it?
- There is only one server (Traefik) which publish ports (80, 443) in host network.
- Traefik is a proxy and routes traffic to our apps in containers.
- All others dockerized apps **must not** publish theirs ports, to avoid collisions. Should only expose ports.
- Traefik and other dockerized apps are in the same docker network (traefik-proxy-blumilk-local).
- Apps are "added" to the Traefik via docker labels.
---
### Traefik architecture
<img data-src="presentations/2023-04-27-blumilk-environment-traefik/images/traefik-architecture.JPG">
---
### Traefik entrypoints
<img data-src="presentations/2023-04-27-blumilk-environment-traefik/images/traefik-entrypoints.JPG">
---
### Traefik static config
```yaml
# traefik static config
entryPoints:
    web:
        address: ":80"

    websecure:
        address: ":443"

providers:
  docker:
    network: "traefik-proxy-blumilk-local"
    exposedByDefault: false
    constraints: "Label(`traefik.blumilk.environment`,`true`)"
```
---
### Traefik docker compose config
```yaml
# docker-compose.yml
networks:
  traefik-proxy-blumilk-local:
    external: true

services:
  traefik-proxy-blumilk-local-service:
    image: traefik:v2.9.8
    networks:
      - traefik-proxy-blumilk-local
    ports:
      # web entrypoint
      - ${TRAEFIK_WEB_ENTRYPOINT_HOST_PORT}:80
      # websecure entrypoint
      - ${TRAEFIK_WEBSECURE_ENTRYPOINT_HOST_PORT}:443
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock:ro
```
---
### How to start?

- download repo
- follow readme\
https://github.com/blumilksoftware/environment/blob/main/readme.md

<br><br>
In short:
- generate certs
- copy generated certs into traefik /certs dir 
- run traefik container
---
### helpful aliases
```
# <HOME DIR>/.bash_aliases

alias blumilk-env-run='cd /home/marcin/PHPStorm_projects/blumilksoftware/environment/traefik && make run'
alias blumilk-env-stop='cd /home/marcin/PHPStorm_projects/blumilksoftware/environment/traefik && make stop'
```
---
### our app base config
```yaml
# docker-compose.yml
networks:
  traefik-proxy-blumilk-local:
    external: true

services:
  whoami:
    image: traefik/whoami
    container_name: traefik-whoami-container
    labels:
      - "traefik.enable=true"
      - "traefik.blumilk.environment=true"
      # HTTP
      - "traefik.http.routers.whoami-http-router.rule=Host(`whoami.blumilk.localhost`)"
      - "traefik.http.routers.whoami-http-router.entrypoints=web"
    networks:
      - traefik-proxy-blumilk-local
```
---
### HTTPS in local environment. Why?
Using HTTP for local development is fine most of the time, except in some special cases.
<br><br>
HTTPS for local development:

- Setting Secure cookies in a consistent way across browsers
- Debugging mixed-content issues
- Using HTTP/2 and later
- Using third-party libraries or APIs that require HTTPS

---
### Why your development site should has HTTPS?
To avoid running into unexpected issues,\
you want your local development site to **behave as much as possible like your production website**. 

<br>
So, if your production website uses HTTPS, you want your local development site to behave like an HTTPS site.
---
### TODO
<br><br>
- be able to connect to the databases/redis via domain name
<br><br><br><br>
---
### Live presentation / use cases

---
### Questions
<br>
<img data-src="presentations/2022-01-19-portainer/images/questions.png">

---
### Thank you
