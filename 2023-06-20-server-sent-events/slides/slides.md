## Blumilk Internal Meetup #27
Server-sent events
<br>
<img style="height: 4em;" data-src="presentations/2023-06-20-server-sent-events/images/sse.gif">
<br>
20.06.2023
Adrian Gawle

---
### HTTP 1.x
<img style="height: 8em;" data-src="presentations/2023-06-20-server-sent-events/images/http.png">

---
### WebSockets
<img style="height: 8em;" data-src="presentations/2023-06-20-server-sent-events/images/websockets.png">

---
### SSE
<img style="height: 8em;" data-src="presentations/2023-06-20-server-sent-events/images/sse-diagram.png">


---
### Use cases SSE vs WS
<p>As the flow of data is only from server to client, SSE is best used when we just want to recevie some data on client.</p>
<ul>
<li>Live feed</li>
<li>Push notifications</li>
<li>Showing progress</li>
<li>Newsletters</li>
</ul>

---
### Use cases SSE vs WS
<p>WebSockets on the other hand is best, when we are in need of real time, two-way communication.</p>
<ul>
<li>Chatting apps</li>
<li>Multiplayer games</li>
<li>Media players</li>
</ul>

---
### Advantages of SSE
<ul>
<li>Data is sent over HTTP</li>
<li>Compatible with HTTP/2</li>
<li>Easily backported by poly filling it with JavaScript</li>
<li>Automatic reconnections</li>
<li>Firewall friendly</li>
<li>"Faster and more convenient to set up" than WebSockets*</li>
</ul>

<small>*End experience may vary</small>

---
### Drawbacks of SSE
<ul>
<li>Can't handle binary data - that WS can</li>
<li>Maximum number of connections is heavly limited (HTTP/2 kind of fixes that)</li>
<li>One-way communication?</li>
<li>Limited browser support - they say</li>
</ul>

---
### SSE (EventSource) - browser support
<img style="height: 8em;" data-src="presentations/2023-06-20-server-sent-events/images/sse-browser-support.png">

---
### SSE implementation - Mercure
<img style="height: 8em;" data-src="presentations/2023-06-20-server-sent-events/images/mercure.png">

---
"Mercure is a hub where the backend services push the event updates with payload using the HTTP POST request and the connected frontend clients get those updates delivered."

---
### We all love numbers so here are some

- https://github.com/dunglas/mercure
- https://mercure.rocks/
- Stars - 3400
- Last commit - 4 days ago (as last checked)
- Last release - 2023-06-04

---
### Mercure - features
<img style="height: 8em;" data-src="presentations/2023-06-20-server-sent-events/images/mercure-features.png">

---
```yaml
  mercure:
    image: dunglas/mercure
    container_name: toby-mercure-dev
    environment:
      DEBUG: "debug"
      SERVER_NAME: ':80'
      MERCURE_PUBLISHER_JWT_KEY: 'aVerySecretKey'
      MERCURE_SUBSCRIBER_JWT_KEY: 'aVerySecretKey'
      MERCURE_EXTRA_DIRECTIVES: |-
        cors_origins "http://toby.blumilk.localhost"
        anonymous
    ports:
      - "9090:80"
    networks:
      - toby-dev
      - traefik-proxy-blumilk-local
    restart: unless-stopped
```

---
### Laravel Mercure Broadcaster
- https://github.com/mvanduijker/laravel-mercure-broadcaster
- It uses https://github.com/symfony/mercure

---
### Installation
Package supports Laravel 10 and PHP 8.2
```shell
composer require mvanduijker/laravel-mercure-broadcaster
```

---
```php
<?php

return [

    'default' => env('BROADCAST_DRIVER', 'mercure'),

    'connections' => [

        // ...

        'mercure' => [
            'driver' => 'mercure',            
            'url' => env('MERCURE_URL', 'http://toby-mercure-dev/.well-known/mercure'),
            'secret' => env('MERCURE_SECRET', 'aVerySecretKey'),
        ],

    ],

];
```

---
```php
<?php

declare(strict_types=1);

namespace Toby\Domain\Events;

use Duijker\LaravelMercureBroadcaster\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Toby\Eloquent\Models\VacationRequest;

class VacationRequestCreated implements ShouldBroadcast
{
    public function __construct(
        public VacationRequest $vacationRequest,
    ) {}

    public function broadcastOn(): Channel
    {
        return new Channel("vacation-request-created");
    }

    public function broadcastWith(): array
    {
        return [
            "id" => $this->vacationRequest->id,
            "createdBy" => $this->vacationRequest->user->profile->first_name . " " . $this->vacationRequest->user->profile->last_name,
        ];
    }
}
```

---
```js
const urlPublic = new URL(mercureUrl)
urlPublic.searchParams.append('topic', 'vacation-request-created')

const eventSource = new EventSource(urlPublic) //{ withCredentials: true }
eventSource.onmessage = (data) => {
  ...
}
```

---
### EventSource
<p>
An EventSource instance opens a persistent connection to an HTTP server, which sends events in text/event-stream format. The connection remains open until closed by calling EventSource.close().
</p>

---
### Events
<ul>
<li>open</li>
<li>message</li>
<li>error</li>
</ul>

---
### Private channels
<p>Private channels go a bit differently than with broadcasting through sockets. Private channels are baked in Mercure and are secured with a jwt token.</p>

---
### Middleware
```php
<?php

declare(strict_types=1);

namespace Toby\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Toby\Eloquent\Models\VacationRequest;

class MercureBroadcasterAuthorizationCookie
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        /** @var Response $response */
        $response = $next($request);

        if (!method_exists($response, "withCookie") || !$request->user()) {
            return $response;
        }

        return $response->withCookie($this->createCookie($request->user(), $request->secure()));
    }

    private function createCookie($user, bool $secure): \Symfony\Component\HttpFoundation\Cookie
    {
        $subscriptions = [
            "vacation-request-changed/{$user->id}",
        ];

        $jwtConfiguration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText(config("broadcasting.connections.mercure.secret")),
        );

        $token = $jwtConfiguration->builder()
            ->withClaim("mercure", ["subscribe" => $subscriptions])
            ->getToken($jwtConfiguration->signer(), $jwtConfiguration->signingKey())
            ->toString();

        return Cookie::make(
            "mercureAuthorization",
            $token,
            15,
            "/.well-known/mercure",
            parse_url(config("app.url"), PHP_URL_HOST),
            $secure,
            true,
        );
    }
}
```

<p>Because Laravel encrypts and decrypts cookies by default, don't forget to add an exception for our cookie</p>

---
### Little demo

---
### Questions

---
### Thank you
