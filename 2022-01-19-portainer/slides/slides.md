## Blumilk Internal Meetup #14
\
\
<img data-src="presentations/2022-01-19-portainer/images/portainer-logo.png">
\
\
19.01.2022\
Marcin Tracz
---
Why Portainer?

<img data-src="presentations/2022-01-19-portainer/images/docker container ls.png">

---

### About Portainer
<br><br>
A centralized service delivery platform for containerized apps.
<br><br>
Just simple web GUI for containers.
<br>
All platforms (Linux, Windows, Mac)

---
### Portainer history
<br><br>
- Portainer was born in 2017 from founders Neil Cresswell and Anthony Lapenna
- The result was Portainer's open source software project
- In August 2020, the project was expanded to include support for Kubernetes and Azure ACI as well as retaining full support for Docker & Docker Swarm.

---
### Details
<br><br>
- last release v2.11.0 (08 Dec 2021)
- GitHub (https://github.com/portainer/portainer)
- site (https://www.portainer.io/)
- docs (https://docs.portainer.io/)
- slack (https://join.slack.com/t/portainer/shared_invite/zt-txh3ljab-52QHTyjCqbe5RibC2lcjKA)
---
### Pricing
<img data-src="presentations/2022-01-19-portainer/images/products1.JPG">

---
<img data-src="presentations/2022-01-19-portainer/images/products.JPG">

---
#### Take5 - get Portainer Business Edition for free
<img data-src="presentations/2022-01-19-portainer/images/faq prices1.JPG">

---
<img data-src="presentations/2022-01-19-portainer/images/faq prices2.JPG">

---
### Blog
<br>

https://www.portainer.io/blog

---
### Overview of Portainer architecture
Portainer consists of two elements: the Portainer Server and the Portainer Agent. Both run as lightweight containers on your existing containerized infrastructure. The Portainer Agent should be deployed to each node in your cluster and configured to report back to the Portainer Server container.
<br><br>
A single Portainer Server will accept connections from any number of Portainer Agents.

---
<img data-src="presentations/2022-01-19-portainer/images/architecture.png">

---
### Demo dashboard
<br>

http://demo.portainer.io

- user: admin
- pass: tryportainer

<br>

_NOTE In every 15 minutes the demo account will be reset._

---
### Quick setup (Docker standalone)
<br>

```shell
docker volume create portainer_data
```
```shell
docker run -d -p 8000:8000 -p 9443:9443 --name portainer \
    --restart=always \
    -v /var/run/docker.sock:/var/run/docker.sock \
    -v portainer_data:/data \
    portainer/portainer-ce:2.11.0
```
```shell
http://localhost:9443
```
---
### Live presentation / use cases

---

### Alternatives

1. DockStation Docker GUI (https://dockstation.io/)
[GitHub](https://github.com/DockStation/dockstation)

Cons: 
- desktop app
- last release 1.5.1 (April 2019)

Pros:
- free
- open source
- cross-platform (Linux, Mac, Windows)
---
#### DockStation
<img data-src="presentations/2022-01-19-portainer/images/dockerstation.png">

---

2. Docker Dashboard (https://docs.docker.com/desktop/dashboard/)

Cons:
- desktop app
- only windows and mac

Pros:
- free
- out of the box in Docker Desktop

---
#### Docker Dashboard
<img data-src="presentations/2022-01-19-portainer/images/docker dashboard.png">

---

3. LazyDocker (terminal docker UI)\
[GitHub](https://github.com/jesseduffield/lazydocker)

Cons:
- still in console
- less features
- only for local env

Pros:
- free
- open source
- cross-platform
---
#### LazyDocker
<img data-src="presentations/2022-01-19-portainer/images/lazydocker.png">

---
### Questions
<br>
<img data-src="presentations/2022-01-19-portainer/images/questions.png">

---
### Thank you
<br><br><br><br>
sources:
- https://www.portainer.io/
- own elaboration
---