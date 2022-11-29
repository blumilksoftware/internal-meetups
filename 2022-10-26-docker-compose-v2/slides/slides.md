<h3> Docker Compose v2 </h3>
<img src="presentations/2022-10-26-docker-compose-v2/images/docker-compose.png" width="200px" alt="Logo">
<br>
<p>Dawid Rudnik 26.10.2022</p>

---

<section>
    <h3>Why I decided to update docker compose?</h3>
</section>

---

<p>Watch - 701</p>
<p>Forks - 4.6k</p>
<p>Stars - 27.5k</p>
<p>Issues - 380</p>
<p>Pull requests - 21</p>
<p>Last commit - 21 October 2022</p>
<p>First release - v2.0.0 - 28 September 2021</p>
<p>Last release - v2.12.2 - 21 October 2022</p>

---

<section>
    <h3>Docker Desktop on Linux</h3>
</section>
<section>
    <img src="presentations/2022-10-26-docker-compose-v2/images/docker-compose-desktop-dashboard.png" width="700px" alt="docker-compose-desktop-dashboard">
</section>

---

<h3>What are the benefits of Compose V2?</h3>

---

<section>
    <h3>Design</h3>
</section>
<section>
    <img src="presentations/2022-10-26-docker-compose-v2/images/docker-compose-v2.png" alt="docker-compose-v2">
</section>

---

<section>
    <h3>GPU support in Compose</h3>
</section>
<section>
    <pre><code>
    services:
      test:
        image: nvidia/cuda:10.2-base
        command: nvidia-smi
        deploy:
          resources:
            reservations:
              devices:
                - driver: nvidia
                  count: 1
                  capabilities: [gpu]
    </code></pre>
</section>
<section>
    <img src="presentations/2022-10-26-docker-compose-v2/images/docker-compose-gpu.png" alt="docker-compose-gpu">
</section>

---

<section>
    <h3>Using service profiles</h3>
</section>
<section>
    <p>Assigning profiles to services</p>
    <pre><code data-trim data-noescape>
    version: "3.9"
        services:
            frontend:
                image: frontend
                profiles: ["frontend", "dev"]
                //or
                profiles:
                    - frontend
                    - dev
    </code></pre>
</section>
<section>
    <p>Enabling profiles</p>
    <pre><code data-trim data-noescape>
    docker compose --profile frontend --profile dev up
    COMPOSE_PROFILES=frontend,dev
    </code></pre>
</section>
<section>
    <p>Auto-enabling profiles and dependency resolution</p>
    <pre><code data-trim data-noescape>
    version: "3.9"
        services:
            web:
                image: web
            &nbsp
            mock-backend:
                image: backend
                profiles: ["dev"]
                depends_on:
                    - db
            &nbsp
            db:
                image: mysql
                profiles: ["dev"]
            &nbsp
            phpmyadmin:
                image: phpmyadmin
                profiles: ["debug"]
                depends_on:
                    - db
    </code></pre>
</section>
<section>
    <pre><code data-trim data-noescape>
    # will only start "web"
    docker compose up -d
    &nbsp
    # this will start mock-backend (and - if necessary - db)
    # by implicitly enabling profile `dev`
    docker compose up -d mock-backend
    &nbsp
    # this will fail because profile "dev" is disabled
    docker compose up phpmyadmin
    </code></pre>
</section>
<section>
    <pre><code data-trim data-noescape>
    docker compose --profile dev up phpmyadmin
    COMPOSE_PROFILES=dev docker compose up phpmyadmin
    </code></pre>
</section>

---

<section>
    <h3>docker compose ls</h3>
</section>
<section>
    <p>Full list of your Compose apps.</p>
    <pre><code data-trim data-noescape>
    docker compose ls
    docker compose ls --all --format json
    </code></pre>
    <img src="presentations/2022-10-26-docker-compose-v2/images/docker-compose-ls.png" alt="docker-compose-ls">
</section>

---

<section>
    <h3>docker compose cp</h3>
</section>
<section>
    <p>Copy files and folders between your service container and your local filesystem</p>
    <pre><code data-trim data-noescape>
    docker compose cp my-service:~/path/to/myfile ~/local/path/to/copied/file
    docker compose cp --all ~/local/path/to/source/file my-service:~/path/to/copied/file
    </code></pre>
</section>

---

<section>
    <h3>docker compose config</h3>
</section>
<section>
    <img src="presentations/2022-10-26-docker-compose-v2/images/docker-compose-config.png" alt="docker-compose-config">
</section>

---

<section>
    <h3>Run commands outside of directory containing the project compose file</h3>
</section>
<section>
    <pre><code data-trim data-noescape>
    docker compose --project-name myproject down
    docker compose -p myproject down
    docker compose -p myproject restart my-service
    </code></pre>
</section>

---

<h3>Disadvantages of docker compose v2</h3>

---

<section>
    <h3>Flags that will not be implemented</h3>
</section>
<section>
    <pre><code data-trim data-noescape>
    compose ps --filter KEY-VALUE
    compose rm --all
    compose scale (use compose up --scale instead)
    </code></pre>
</section>

---

<section>
    <h3>Installation and setup</h3>
</section>
<section>
    <pre><code data-trim data-noescape>
    sudo apt-get update && apt-get install \
        ca-certificates \
        curl \
        gnupg \
        lsb-release
    &nbsp
    sudo mkdir -p /etc/apt/keyrings
    &nbsp
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
    echo \
    "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
    $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
    </code></pre>
</section>
<section>
    <pre><code data-trim data-noescape>
    sudo apt-get update
    &nbsp
    sudo chmod a+r /etc/apt/keyrings/docker.gpg
    &nbsp
    sudo apt-get update
    &nbsp
    sudo apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin
    </code></pre>
</section>
<section>
    <pre><code data-trim data-noescape>
    sudo curl -L "https://github.com/docker/compose/releases/download/v2.12.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    &nbsp    
    sudo chmod +x /usr/local/bin/docker-compose
    &nbsp
    sudo groupadd docker
    &nbsp
    sudo gpasswd -a $USER docker
    </code></pre>
</section>
<section>
    <pre><code data-trim data-noescape>
    curl -fL https://github.com/docker/compose-switch/releases/latest/download/docker-compose-linux-amd64 -o /usr/local/bin/compose-switch
    &nbsp
    chmod +x /usr/local/bin/compose-switch
    &nbsp
    mv /usr/local/bin/docker-compose /usr/local/bin/docker-compose-v1
    &nbsp
    update-alternatives --install /usr/local/bin/docker-compose docker-compose /usr/local/bin/docker-compose-v1 1
    &nbsp
    update-alternatives --install /usr/local/bin/docker-compose docker-compose /usr/local/bin/compose-switch 99
    </code></pre>
</section>
<section>
    <pre><code data-trim data-noescape>
    sudo chmod 750 /usr/local/bin/docker-compose-v1
    sudo chmod 750 /usr/local/bin/docker-compose
    sudo chmod 750 /usr/local/bin/compose-switch
    </code></pre>
</section>

---

<section>
    <h3>How to use?</h3>
</section>
<section>
    <pre><code data-trim data-noescape>
    docker compose ...
    or
    docker-compose ...
    </code></pre>
</section>

---

<section>
    <h3>Compatibility with phpStorm</h3>
</section>
<section>
    <img src="presentations/2022-10-26-docker-compose-v2/images/phpStorm.png" width="700px" alt="phpStorm">
</section>
<section>
    <img src="presentations/2022-10-26-docker-compose-v2/images/jetbrains-support.png" alt="jetbrains-support">
</section>

---

<h3>Do we need an update?</h3>

---

<h3>Sources:</h3>
<p>https://docs.docker.com/compose</p>
<p>https://www.docker.com/blog/announcing-compose-v2-general-availability</p>
<p>https://github.com/docker/compose</p>

---

<h2>Thank you!</h2>
