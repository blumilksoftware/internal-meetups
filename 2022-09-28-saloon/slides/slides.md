## Blumilk Internal Meetup #21

<h3>Saloon</h2>

<img style="height: 8em" alt="Saloon logo" data-src="presentations/2022-09-28-saloon/images/saloon_logo.jpg">

<p>Michał Myśków 28.09.2022</p>

---

## What is this?

<br/>
<q>Saloon is a Laravel/PHP package for interacting with third-party APIs or building SDKs.</q>
<br/><br/>

---

## Why saloon?

<q>Building an API integration can be time-consuming.
We’ve standardised the way we talk to APIs with <strong>PSR-7</strong> and <strong>PSR-18</strong>, but we haven’t got a
standard structure to build API integrations.</q>
<p><strong>Saloon</strong> aims to solve this.</p>


---

### Saloon

- https://github.com/Sammyjo20/Saloon
- Installs - 46 433
- Stars - 757
- Forks - 28
- Last commit - September 18, 2022
- Last release - v1.4.3 - 2022-07-22

---

### Saloon-Laravel

- https://github.com/Sammyjo20/saloon-laravel
- Installs - 38 996
- Stars - 23
- Forks - 2
- Last commit - July 22, 2022
- Last release - v1.5.0 - 2022-07-22

---

## Introduction

<q>Saloon offers a fluent, object-oriented wrapper to build API integration or PHP SDK.
It makes sharing API requests throughout application a breeze.
You don’t have to configure an HTTP client, so you can start sending requests really quickly.</q>
<br/><br/>

---

## Saloon for Laravel

<ul style="font-size: 35px; line-height: 65px;">
    <li>Mocking/asserting requests in tests.</li>
    <li>OAuth2 boilerplate out of the box.</li>
    <li>Caching system.</li>
    <li>Artisan console commands.</li>
</ul>

---

## Features

<ul style="font-size: 32px; line-height: 50px;">
    <li>Simple syntax that standardises the interaction with APIs.</li>
    <li>Abstract API integrations into classes (DRY).</li>
    <li>Fast configuration that can be shared across all requests.</li>
    <li>Built on top of <strong>Guzzle</strong> (the most popular PHP HTTP client).</li>
    <li>Framework agnostic.</li>
    <li>Mocking requests for testing.</li>
    <li>Great for building PHP SDKs.</li>
    <li>Authentication & OAuth2 boilerplate already built-in.</li>
</ul>

---

## Saloon

<img style="height: 11em" alt="Saloon" data-src="presentations/2022-09-28-saloon/images/saloon.jpg">
<p style="font-size: 18px">Making a request, sending it and retrieving the JSON data as an associative array.</p>

---

### Installation

#### Requirements:

<ul>
    <li>PHP 8.0+</li>
    <li>Laravel 8+</li>
</ul>

---

### Installation

```shell
composer require sammyjo20/saloon
```

or

```shell
composer require sammyjo20/saloon-laravel
```

---

### So it begins

<img style="height: 10em" alt="Cat meme" data-src="presentations/2022-09-28-saloon/images/cat_meme.jpg">

---

### Connectors

<p>Connectors are classes that store the requirements of a third-party API integration like:</p>
<ul>
    <li>Base URL</li>
    <li>Default headers</li>
    <li>Default query string</li>
    <li>Default configuration</li>
</ul>


---

### Connectors

<p>Connectors are only defined once and then requests use a connector to know the base requirements of an API.</p>
<p>Saloon is built on top of <strong>Guzzle</strong>, so every config option that <strong>Guzzle</strong> provides is supported.</p>

---

### Basic connector

```php
class ForgeConnector extends SaloonConnector
{
    // Define the base URL.

    public function defineBaseUrl(): string
    {
        return 'https://forge.laravel.com/api/v1';
    }
    
    // Headers that will be used on all requests
    
    public function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
        ];
    }
    
    // Default Guzzle config options
    
    public function defaultConfig(): array
    {
        return [
            'timeout' => 30,
        ];
    }
}
```

---

### Requests

<p>Saloon Requests are reusable classes that define each request of the API.</p>
<p>Every request class contains:</p>
<ul>
    <li>Defined connector to use</li>
    <li>Request's method</li>
    <li>Default headers</li>
    <li>Data that should be used</li>
</ul>

---

### Basic request

```php
class GetForgeServerRequest extends SaloonRequest
{
    protected ?string $connector = ForgeConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct(
        public string $serverId
    ) {}

    public function defineEndpoint(): string
    {
        return '/servers/' . $this->serverId;
    }
    
    public function defaultHeaders(): array
    {
        return [
            'X-Custom-Header' => 'Hello-World',
        ];
    }
    
    public function defaultConfig(): array
    {
        return [
            'allow_redirects' => true,
            // Overwrite the connector's timeout header.
            'timeout' => 10
        ];
    }
}
```

---

### Attaching Data

<p>Most API integrations will often require sending data using a <strong>POST/PUT/PATCH</strong> request.</p>
<p>Saloon provides <strong>traits</strong> that can be added to attach data to requests.</p>
<ul>
    <li>HasJsonBody</li>
    <li>HasFormParams</li>
    <li>HasMultipartBody</li>
</ul>

---

### Trait usage example

```php
class CreateForgeSiteRequest extends SaloonRequest
{
    use HasJsonBody;
    
    //...
    
    public function __construct(
        public string $serverId,
        public string $domain,
    ) {}
    
    public function defaultData(): array
    {
        return [
            'domain' => $this->domain,
            'type' => 'php',
        ];
    }
}
```

---

### Other Form Body Types

```php
class TestRequest extends SaloonRequest
{
    use HasBody;
    use HasXMLBody;

    // ...
    
    public function defineBody(): mixed
    {
        return 'custom-string-response';
    }   
    
    public function defineXmlBody(): string
    {
        return '<?xml version="1.0" encoding="UTF-8"?>';
    }
}
```

---

<img style="height: 10em" alt="Xml meme" data-src="presentations/2022-09-28-saloon/images/xml_meme.jpg">

---

### Query Parameters

<p>In order to add query parameters to a request, Saloon provides a <strong>defaultQuery</strong> method on a connector or request.</p>

---

### Query Parameters

```php
class GetForgeServersRequest extends SaloonRequest
{
    // ...
    
    public function defaultQuery(): array
    {
        return [
            'sort' => 'updated_at',
        ];
    }
}
```

---

### Modifying query parameters

```php
$request = new GetForgeServersRequest();

$request->setQuery(['sort' => $sort]);

$request->mergeQuery(['include' => 'user']);

$request->addQuery('X-Identifier', 'Saloon');

$request->getQuery('X-Identifier'); // Returns "Saloon".
```

---

### Sending requests

---

<p>There are three ways to send requests:</p>

```php
$request = new GetForgeServerRequest(serverId: '123456');
$response = $request->send();
```

<p style="font-size: 27px">Using the request class directly.</p>

```php
$connector = new ForgeConnector();
$request = $connector->request(new GetForgeServerRequest(serverId: '123456'));
$response = $request->send();

// or...

$response = $connector->send(new GetForgeServerRequest(serverId: '123456'));
```

<p style="font-size: 27px">Sending requests through connector.</p>

```php
$request = ForgeConnector::getForgeServerRequest(serverId: '123456');
$response = $request->send();
```

<p style="font-size: 27px">Register requests on connector and use method-style access to send requests.</p>

---

### Responses

<p>Available methods</p>

<div style="display: flex; flex-direction: row;">
<ul style="font-size: 25px; width: 50%;">
    <li>json(): array</li>
    <li>body(): string</li>
    <li>stream(): StreamInterface</li>
    <li>object(): object</li>
    <li>collect(): Collection</li>
    <li>dto(): object</li>
    <li>header($header): string</li>
    <li>headers(): array</li>
    <li>status(): int</li>
    <li>successful(): bool</li>
    <li>ok(): bool</li>
    <li>redirect(): bool</li>
</ul>
<ul style="font-size: 25px;">
    <li>clientError(): bool</li>
    <li>serverError(): bool</li>
    <li>onError(callable $callback)</li>
    <li>toException()</li>
    <li>throw()</li>
    <li>xml()</li>
    <li>getRequestOptions(): array</li>
    <li>getGuzzleException(): ?RequestException</li>
    <li>isCached(): bool</li>
    <li>isMocked(): bool</li>
    <li>toGuzzleResponse(): Response</li>
    <li>toPsrResponse(): Response</li>
</ul>
</div>

---

### Custom responses

<p style="font-size: 28px;">This can be done to add new methods or overwrite Saloon's response methods.</p>

```php
class ForgeConnector extends SaloonConnector
{
    // ...

    protected ?string $response = CustomResponse::class;
    
    // ...
}
```

---

### Handling Failures

```php
$request = new GetForgeServerRequest(serverId: '123456');
$response = $request->send();

$response->throw(); // Will throw SaloonRequestException
                    // if the request fails.

$data = $response->json();
```

---

### Data Transfer Objects

<p>Saloon has a built-in plugin that support casting the received data in an API response to a <strong>data transfer object (DTO)</strong>.</p>

---

### Configuring DTO

<p>Firstly, add the <strong>CastsToDto</strong> trait to your request.</p>

```php
class GetForgeServerRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = Saloon::GET;

    protected ?string $connector = ForgeConnector::class;
    
    // ...
}
```

---

### Configuring DTO

<p style="font-size: 30px;">Add the <strong>castsToDto</strong> method to request. It has one argument which is an instance of SaloonResponse. 
This method is only run after a successful response has been received from the API.</p>

```php
class GetForgeServerRequest extends SaloonRequest
{
    use CastsToDto;
    
    // ...
    
    protected function castToDto(SaloonResponse $response): ServerData
    {
        return ServerData::fromSaloon($response);
    }
}
```

---

### DTO class

```php
class ServerData
{
    public function __construct(
        public string $serverId,
        public string $name,
    ) {}

    public static function fromSaloon(SaloonResponse $response): self
    {
        $data = $response->json();

        return new self($data['id'], $data['name']);
    }
}
```

---

### Retrieving DTO

```php
$request = new GetForgeServerRequest(serverId: '12345');
$response = $request->send();

$server = $response->dto();
```

---

### Retrieved Json

```php
$server = $response->json()
```

```php
^ array:2 [▼
  "id" => "12345"
  "name" => "test"
]
```

<br>

### Retrieved DTO

```php
$server = $response->dto()
```

```php
^ App\Http\Integrations\Forge\DTOs\ServerData {#426 ▼
  +id: "12345"
  +name: "test"
}
```

---

### Caching

<p>Saloon has a first-party package plugin that can be installed to enable this functionality.</p>

```shell
composer require sammyjo20/saloon-cache-plugin
```

---

### Caching configuration

```php
class GetForgeServerRequest extends SaloonRequest
{
    use AlwaysCacheResponses;

    // ...
    
    public function cacheDriver(): DriverInterface
    {
        return new LaravelCacheDriver(Cache::store("redis"));
    }
    
    public function cacheTTLInSeconds(): int
    {
        return 7200;
    }
    
    // Custom cache key
    
    protected function cacheKey(SaloonRequest $request, array $headers): string
    {
        return "custom_cache_key";
    }
}
```

---

### Testing

<p>For testing in Laravel, Saloon gives us a <strong>facade</strong> with <strong>Saloon::fake()</strong> method.</p>
<p>Saloon automatically detect when an <strong>API request</strong> is about to be made and respond with the fake response.</p>

---

### Mock Response class

<p>Create fake responses with <strong>MockResponse</strong> class.</p>

```php
use Sammyjo20\SaloonLaravel\Facades\Saloon;
use Sammyjo20\Saloon\Http\MockResponse;

Saloon::fake([
    MockResponse::make(['name' => 'Sam'], 200, $headers, $config);
]);
```

<p><strong>MockResponse</strong> class can accept:</p>
<ul style="font-size: 35px">
    <li>Data</li>
    <li>Status</li>
    <li>Headers</li>
    <li>Config</li>
</ul>

---

### Basic Usage (Sequence Mocking)

```php
use Sammyjo20\SaloonLaravel\Facades\Saloon;
use Sammyjo20\Saloon\Http\MockResponse;

Saloon::fake([
    MockResponse::make(['name' => 'Sam'], 200),
    MockResponse::make(['error' => 'Server Unavailable'], 500),
]);

// Will return with `['name' => 'Sam']` and status `200`
(new GetForgeServerRequest)->send() 

// Will return with `['error' => 'Server Unavailable']` and status `500`
(new GetForgeServerRequest)->send() 
```

---

### Connector Mocking

```php
Saloon::fake([
    ForgeConnector::class => MockResponse::make(['name' => 'Sam'], 200),
    OtherServiceConnector::class => MockResponse::make(['name' => 'Alex'], 200),
]);

// Will return with `['name' => 'Sam']` and status `200`
(new GetForgeServerRequest)->send()

// Will return with `['name' => 'Alex']` and status `200`
(new OtherServiceRequest)->send()
```

---

### Request Mocking

```php
Saloon::fake([
    GetForgeServerRequest::class => MockResponse::make(['name' => 'Sam'], 200),
    OtherServiceRequest::class => MockResponse::make(['name' => 'Alex'], 200),
]);

// Will return with `['name' => 'Sam']` and status `200`
(new GetForgeServerRequest)->send() 

// Will return with `['name' => 'Alex']` and status `200`
(new OtherServiceRequest)->send() 
```

---

### URL Mocking

```php
Saloon::fake([
    'forge.laravel.com/api/*' => MockResponse::make(['name' => 'Sam'], 200),
    'samcarre.dev/*' => MockResponse::make(['name' => 'Alex'], 200),
    'samcarre.dev/exact' => MockResponse::make(['name' => 'Taylor'], 200), // Exact requests
    '*' => MockResponse::make(['name' => 'Wildcard'], 200), // Any other requests
]);

(new GetForgeServerRequest)->send() // Will return with `['name' => 'Sam']` and status `200`

(new OtherServiceRequest)->send() // Will return with `['name' => 'Alex']` and status `200`

(new ExactRequest)->send() // Will return with `['name' => 'Taylor']` and status `200`

(new WildcardServiceRequest)->send() // Will return with `['name' => 'Wildcard']` and status `200`
```

---

### Adding Expectations

<p>Available Expectations:</p>
<ul style="font-size: 35px">
    <li>AssertSent</li>
    <li>AssertNotSent</li>
    <li>AssertSentJson</li>
    <li>AssertNothingSent</li>
    <li>AssertSentCount</li>
</ul>

```php
$response = (new GetForgeServerRequest(123456))->send();

Saloon::assertSent(GetForgeServerRequest::class);
```

---

### Mocking Exceptions

```php
Saloon::fake([
    MockResponse::make(['name' => 'Sam'], 200)->throw(new MyException('Something bad!'))
]);
```

```php
Saloon::fake([
    MockResponse::make()->throw(fn ($guzzleRequest) => new ConnectException('Unable to connect!', $guzzleRequest))
]);
```

---

### Usage example

---

### Connector

```php
class TMDBConnector extends SaloonConnector
{

    // This plugin adds the Accept: application/json header to requests.
    
    use AcceptsJson;

    protected string $apiBaseUrl = 'https://api.themoviedb.org/3';

    public function __construct(string $token, string $baseUrl = null)
    {
        // Authentication with token ("Authorization": "Bearer my-authentication-token")
        
        $this->withTokenAuth($token);

        if (isset($baseUrl)) {
            $this->apiBaseUrl = $baseUrl;
        }
    }

    public function defineBaseUrl(): string
    {
        return $this->apiBaseUrl;
    }

    public function defaultQuery(): array
    {
        return [
            "language" => app()->getLocale(),
        ];
    }

    public function defaultHeaders(): array
    {
        return [
	        'Content-Type' => 'application/json',
	    ];
    }

    public function defaultConfig(): array
    {
        return [
	        'timeout' => 30,
	    ];
    }
}
```

---

### Request

```php
class GetMovieRequest extends SaloonRequest
{
    use CastsToDto;
    use AlwaysCacheResponses;

    protected ?string $connector = TMDBConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct(
        public int $movieId,
    ) {}

    public function defineEndpoint(): string
    {
        return sprintf("/movie/%s", $this->movieId);
    }

    public function cacheDriver(): LaravelCacheDriver
    {
        return new LaravelCacheDriver(Cache::store("redis"));
    }

    public function cacheTTLInSeconds(): int
    {
        return CacheTTLs::POPULAR->value;
    }

    protected function cacheKey(SaloonRequest $request, array $headers): string
    {
        return CacheKeys::MOVIE->value . app()->getLocale();
    }

    protected function castToDto(SaloonResponse $response): MovieData
    {
        return MovieData::fromSaloon($response);
    }
}
```

---

### DTO

```php
class MovieData
{
    public function __construct(
        public int $id,
        public string $title,
        public string $overview,
        public string $releaseDate,
    ) {}

    public static function fromSaloon(SaloonResponse $response): self
    {
        return new self(
            id: $data["id"],
            title: $data["title"],
            overview: $data["overview"],
            releaseDate: Carbon::parse($data["release_date"])->isoFormat("ll");
        );
    }
}
```

---

### Controller

```php
public function show(int $movieId): Response
{
    $movie = $this->TMDBService->getMovie($movieId);

    return Inertia("Movies/Show", [
        "movie" => $movie,
    ]);
}
```

<br>

### Service

```php
public function getMovie(int $movieId): MovieData
{
    return (new GetMovieRequest($movieId))->send()->dto();
}
```

---

### Retrieved Json

```php
^ array:4 [▼
  "id" => 985939
  "title" => "Fall"
  "overview" => "For best friends Becky and Hunter, life is all about conquering fears and pushing limits. But after they climb 2,000 feet to the top of a remote, abandoned radi ▶"
  "release_date" => "2022-08-11"
]
```

<br>

### Retrieved DTO

```php
^ App\Http\Integrations\TMDB\DTOs\MovieData {#426 ▼
  +id: 985939
  +title: "Fall"
  +overview: "For best friends Becky and Hunter, life is all about conquering fears and pushing limits. But after they climb 2,000 feet to the top of a remote, abandoned radi ▶"
  +releaseDate: "Aug 11, 2022"
}
```

---

### Test

```php
test("get movie", function (): void {
    Saloon::fake([
        MockResponse::make([
            "id" => 985939
            "title" => "Fall"
            "overview" => "For best friends Becky and Hunter, life is all about conquering fears and pushing limits. But after they climb 2,000 feet to the top of a remote, abandoned radi ▶"
            "release_date" => "2022-08-11"
        ], 200),
    ]);

    $response = (new GetMovieRequest(985939))->send();

    Saloon::assertSent(GetMovieRequest::class);
    $this->assertSame("Aug 11, 2022", $response->dto()->releaseDate);
});
```

---

### The end

<br><br><br><br>
Sources:

- https://docs.saloon.dev/
- Own elaboration

---