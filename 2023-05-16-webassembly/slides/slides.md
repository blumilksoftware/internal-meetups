
### Blumilk Internal Meetup #27
<br>
<img src="presentations/2023-05-16-webassembly/imgs/wasm_logo.png" width="600px">
<br>
<p>Jacek Sawowszczuk, 15.05.2023</p>
<br>
---

<section>
<img src="presentations/2023-05-16-webassembly/imgs/wasm_js.png" width="650px">
</section>
<section>

## So what is Wasm?

</section>

<section>

> … a binary instruction format for a stack-based virtual machine …

> … not a programming language that you would write software in, but rather a compilation target: a sort of assembly language, if you will …

</section>


<section>

- unity games 
- google earth 
- google keep (drawing)
- google meet / zoom (filters)
- figma / autocad / sketchup
- adobe products (lightroom, photoshop express, acrobat etc.)
- snapchat / telegram
- flutter
- streaming applications / running on tvs
- …

</section>


<section>

<img src="presentations/2023-05-16-webassembly/imgs/wat.png" width="600px">

</section>


<section>

### Standarized

4th language of the web

<img src="presentations/2023-05-16-webassembly/imgs/langs_logos.jpg" width="500px">
<img src="presentations/2023-05-16-webassembly/imgs/wasm_logo_sm.png" width="130px" style="padding-left: 80px">

since 2019 - https://www.w3.org/TR/wasm-core-1/
</section>

<section>
supported by all major browsers

<img src="presentations/2023-05-16-webassembly/imgs/caniuse.png" width="800px">
</section>

<section>

### Supported by the industry

companies backing WASM: 

- Docker, VMWare
- Intel, ARM
- Microsoft, Google, Mozilla
- Adobe, NGINX, Amazon
- Cisco, Siemens, Fastly
- …

</section>

<section>

### Secure by design

- sandboxed
- no permissions by default
- relying on explicit imports and permissions

</section>

<section>

### Very portable

- arch and OS agnostic
- runs on most CPUs incl. mobile
- no need for separate builds 

</section>

<section>

### Fast

- nearnative speeds (within 10% of native)
- no cold starts

</section>

<section>

### Polyglot

supports +40 languages

- AssemblyScript, Grain, Motoko

- JavaScript, Python, Java, PHP, C# and .NET, 
- C++, TypeScript, Ruby, C, Swift, R, Scala, 
- Go, Kotlin, Rust, Dart, COBOL, Erlang, Haskell, 
- Lisp, Lua, Perl, Zig

https://www.fermyon.com/wasm-languages/webassembly-language-support

</section>


<section>


<section>

<img src="presentations/2023-05-16-webassembly/imgs/rust_cpp_wasm.png" width="700px">

</section>



---

<section>

> Write once, run anywhere

</section>


<section>

<img src="presentations/2023-05-16-webassembly/imgs/wasm_jvm2.png" width="600px">

</section>


<section>

## Wasm vs JVM

- Java tried to be one runtime to rule them all
- was able to run within the browser
- but this did not work out, because:
    - huge language
    - proprietary / closed (Sun/Oracle)
    - needed plugins for browsers
    - Java Applets were heavy and slow
    - bytecode and JVM specifically tailored for Java
    - security nightmare

</section>


<section>

## IoT / microcontrollers

- very fast
- small
- low requirements

</section>


<section>

## Cloud / Edge

- serverless functions
    - super fast cold start
- great from security standpoint 
    - thanks to web heritage
- cloudflare workers / fastly / etc.
- ML models on edge
- Docker runners / Kubernetes
- Fermyon spin

</section>

<section>

<img src="presentations/2023-05-16-webassembly/imgs/wasm_tweet.png" width="600px">

</section>


<section>

## Wasm vs Docker

- can be very inefficient
- security issues 
    - highly compliant envs (uncontrolled networking)
    - running untrusted code
    - need to fallback on OS virtualization
- docker does not run in edge compute
- docker does not run in the browser
</section>


<section>

> Containers are mainly a tool for OPS people in the DevOps world, WebAssembly Components will be a great tool for the DEV people in the DevOps world.

</section>


<section>

## Evolution view - unit of deployment gets smaller

physical hardware <br>⬇<br>
virtual machines <br>⬇<br>
containers <br>⬇<br>
WASM

</section>


<section>

## Will Wasm replace Docker?

</section>


<section>

<img src="presentations/2023-05-16-webassembly/imgs/bugs_no.jpg" width="500px">

</section>


<section>

## Extending code / plugins

- Wasm vs Lua vs binary
- inline data transformations in the database engine 
- MS Flight Simulator - WASM plugins
- Shopify functions - platform extensions
- security policy management in Kubernetes
- NGINX Agent
- Extism

</section>


---


<section>

## Wasm + PHP

- using PHP in other language
- using other language in PHP
- using PHP in a browser
- using PHP in PHP?

</section>


<section>

## using PHP in other languages

vmware-labs/webassembly-language-runtimes

https://github.com/vmware-labs/webassembly-language-runtimes

</section>


<section>

## using other languages in PHP

<img src="presentations/2023-05-16-webassembly/imgs/extism.png" width="500px">

</section>


<section>

## using PHP in a browser

- https://developer.wordpress.org/playground
- https://adamadam.blog/2023/04/12/interactive-intro-to-wordpress-playground-public-api/

</section>

---

<section>

## early days

- memory limited to 4GB per app
- types
- ecosystem is still in young
- no multithreading
- no outbound networking
- gc needs to be completely reimplemented

Roadmap: https://webassembly.org/roadmap/

</section>


<section>

## so what's it actually good at right now?

</section>


<section>

## use cases

</section>

---

<section>

<img src="presentations/2023-05-16-webassembly/imgs/finally_over.jpg" width="500px">

The end

</section>

---

