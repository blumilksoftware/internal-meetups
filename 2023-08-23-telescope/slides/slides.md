
---
## Blumilk Internal Meetup #31

\
\
<img src="presentations/2023-08-23-telescope/images/logo.svg" width="300px">
\
\
\
Kamil Piech 23.08.2023


---

Laravel **Telescope** makes a wonderful companion to your local Laravel development environment.

---

First release date: **29.10.2018**

Actual release: **v4.16.1** (11.08.2023)

GitHub stars: **4.6k** (23.08.2023)

Installs: **23 490 225** (23.08.2023)

---
### INSTALLATION

---

Requirements

- php: ^8.0 
- ext-json: *
- laravel/framework: ^8.37|^9.0|^10.0 
- symfony/var-dumper: ^5.0|^6.0 
---

```php
composer require laravel/telescope

php artisan telescope:install
 
php artisan migrate
```

---

```php
composer require laravel/telescope --dev

php artisan telescope:install
 
php artisan migrate
```

---

### CONFIGURATION

---

<section>

Configuration is available in **config/telescope.php**

```php
return [
    "domain" => env("TELESCOPE_DOMAIN", null),
    "path" => env("TELESCOPE_PATH", "telescope"),
    "driver" => env("TELESCOPE_DRIVER", "database"),
    "storage" => [
        "database" => [
            "connection" => env("DB_CONNECTION", "mysql"),
            "chunk" => 1000,
        ],
    ],
    "enabled" => env("TELESCOPE_ENABLED", true),
```
</section>
<section>

```php
    "middleware" => [
        "web",
        Authorize::class,
    ],
    "only_paths" => [
        // 'api/*'
    ],
    "ignore_paths" => [
        "nova-api*",
    ],
    "ignore_commands" => [
    ],
```

</section>
<section>

```php
    'watchers' => [
        Watchers\BatchWatcher::class => env("TELESCOPE_BATCH_WATCHER", true),
        Watchers\MailWatcher::class => env("TELESCOPE_MAIL_WATCHER", true),
        Watchers\JobWatcher::class => env("TELESCOPE_JOB_WATCHER", true),
        Watchers\LogWatcher::class => env("TELESCOPE_LOG_WATCHER", true),
        ...
    ],
```

</section>
---
<section>

### WATCHERS

</section>

<section>

- Batch Watcher
- Cache Watcher
- Command Watcher
- Dump Watcher
- Event Watcher
- Exception Watcher
- Gate Watcher
- HTTP Client Watcher
- Job Watcher
- Log Watcher
- Mail Watcher
- Model Watcher
- Notification Watcher
</section>

<section>

- Query Watcher
- Redis Watcher
- Request Watcher
- Schedule Watcher
- View Watcher
</section>


---
<section>

Rest configuration is available in **app\Providers\TelescopeServiceProvider.php**

```php
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
 
/**
 * Register any application services.
 */
public function register(): void
{
    $this->hideSensitiveRequestDetails();
 
    Telescope::filter(function (IncomingEntry $entry) {
        if ($this->app->environment('local')) {
            return true;
        }
 
        return $entry->isReportableException() ||
            $entry->isFailedJob() ||
            $entry->isScheduledTask() ||
            $entry->isSlowQuery() ||
            $entry->hasMonitoredTag();
    });
}
```
</section>
<section>

```php
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment("local")) {
            return;
        }

        Telescope::hideRequestParameters(["_token"]);
        Telescope::hideRequestHeaders([
            "cookie",
            "x-csrf-token",
            "x-xsrf-token",
        ]);
    }

```
</section>
---
Dashboard Authorization

```php
protected function gate(): void
{
    Gate::define('viewTelescope', function (User $user) {
        return in_array($user->email, [
            'taylor@laravel.com',
        ]);
    });
}
```
---

# LIVE

(dashboard demonstration)

---

<img src="presentations/2023-08-23-telescope/images/meme.jpeg" width="600px">

---

# The End
