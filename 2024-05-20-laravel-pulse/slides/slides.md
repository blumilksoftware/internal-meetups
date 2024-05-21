## Blumilk Internal Meetup #33?
\
\
\
Adrian Hopek, 20.05.2024

---

<img src="presentations/2024-05-20-laravel-pulse/images/pulse.png">

“Pulse delivers at-a-glance insights into your application's performance and usage. 
Track down bottlenecks like slow jobs and endpoints, find your most active users, and more.”

---

<img src="presentations/2024-05-20-laravel-pulse/images/demo.png">

---

First release: v1.0.0 (30.04.2024)

Actual release: v1.1.0 (07.05.2024)

GitHub stars: 1.3k

Installs: 1 220 748

---

### Local, staging, production?

<img src="presentations/2024-05-20-laravel-pulse/images/local-staging-prod.png">

---

### Laravel Pulse vs Laravel Telescope

<img src="presentations/2024-05-20-laravel-pulse/images/horizon.png">

---

### Installation & Configuration

```php
composer require laravel/pulse

php artisan vendor:publish --provider="Laravel\Pulse\PulseServiceProvider"

php artisan vendor:publish --tag=pulse-config

php artisan vendor:publish --tag=pulse-dashboard

php artisan migrate
```

---

### Recorders & Cards

---

### Cache Interactions

<img src="presentations/2024-05-20-laravel-pulse/images/cache.png">

---

### Exceptions

<img src="presentations/2024-05-20-laravel-pulse/images/exceptions.png">

---

### Queues

<img src="presentations/2024-05-20-laravel-pulse/images/queues.png">

---

### Slow Jobs

<img src="presentations/2024-05-20-laravel-pulse/images/jobs.png">

---

### Slow Outgoing Requests

<img src="presentations/2024-05-20-laravel-pulse/images/outgoing_requests.png">

---

### Slow Queries

<img src="presentations/2024-05-20-laravel-pulse/images/queries.png">

---

### Slow Requests

<img src="presentations/2024-05-20-laravel-pulse/images/requests.png">

---

### Servers

<img src="presentations/2024-05-20-laravel-pulse/images/servers.png">

---

### Application Usage

<img src="presentations/2024-05-20-laravel-pulse/images/app_usage.png">

---

### Custom Recorders & Cards

---

### Capturing entries

<img src="presentations/2024-05-20-laravel-pulse/images/entry.png">

---

### Retrieving Aggregate Data

<img src="presentations/2024-05-20-laravel-pulse/images/card.png">

---

### Dashboard & Cards

<img src="presentations/2024-05-20-laravel-pulse/images/dashboard.png">

---

### Pulse User Provider

<img src="presentations/2024-05-20-laravel-pulse/images/user.png">

---

### Example #1

<img src="presentations/2024-05-20-laravel-pulse/images/last_active.png">

---

### Example #2

<img src="presentations/2024-05-20-laravel-pulse/images/sent_messages.png">

---

### Example #3

<img src="presentations/2024-05-20-laravel-pulse/images/ping.png">

---

### Example #4 & #5

<img src="presentations/2024-05-20-laravel-pulse/images/reverb.png">

---

### Performance

---

### Using a Different Database

---

### Trimming

---

### Sampling

<img src="presentations/2024-05-20-laravel-pulse/images/sampling.png">

---

### Redis Ingest

```php
PULSE_INGEST_DRIVER=redis

PULSE_REDIS_CONNECTION=pulse

php artisan pulse:work
```

---

### Demo

---

### Thank You!