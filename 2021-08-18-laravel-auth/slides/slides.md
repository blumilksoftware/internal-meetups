## Blumilk Internal Meetup #9


\
\
<img src="presentations/2021-08-18-kamil/images/logo.png" width="100px">
\
Laravel Authentication Packages

\
\
\
Kamil Piech 18.08.2021

---

<img width="1000" data-src="presentations/2021-08-18-kamil/images/start.webp">

---

### #Laravel Fortify

---

```php
composer require laravel/fortify

php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
php artisan migrate
```

---

FortifyServiceProvider.php

    public function boot()
    {
        ...

        Fortify::loginView(
            function () {
                return view('auth.login');
            }
        );
    }


---

A gdzie widoki?

---

```html
https://github.com/laravel/ui
```

---

Authentication <span style="color:red">|</span> 
Password Reset <span style="color:blue">|</span> 
Two Factor Authentication <span style="color:green">|</span> 
Registration <span style="color:violet">|</span> 
Password Reset <span style="color:yellow">|</span>
Email Verification <span style="color:pink">|</span> 
Password Confirmation 

---

### #Laravel Sanctum

---

<img width="600" data-src="presentations/2021-08-18-kamil/images/sanctum.jpg">

---

```php
composer require laravel/sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

---

Bearer authentication

---

API Token Authentication <span style="color:red">|</span> 
SPA Authentication <span style="color:blue">|</span> 
Mobile Application Authentication

---

```php
public function __construct(protected Hasher $hash) {}

public function login(Request $request): string
    {
        $user = User::query()->where("email", $request->get("email"))->first();

        if ($user === null || !$this->hash->check($request->get("password"), $user->password)) 
        {
            throw new AuthenticationException();
        }

        return $user->createToken($user->email)->plainTextToken;
    }
```

---

```php
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
```

---

### #Laravel Breeze

---
```php
composer require laravel/breeze --dev

php artisan breeze:install
npm install
npm run dev
php artisan migrate
```

---

<img width="1000" data-src="presentations/2021-08-18-kamil/images/login.png">

---

<img width="1000" data-src="presentations/2021-08-18-kamil/images/dash.png">

---

```php
app
    Http
        Controllers
            Auth
                AuthenticatedSessionController
                ConfirmablePasswordController
                EmailVerificationNotificationController
                EmailVerificationPromptController
                NewPasswordController
                PasswordResetLinkController
                RegisteredUserController
                VerifyEmailController
```

---

### Login Request

```php
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }
```

---

```php
app
    routes
        auth
---

```php
Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

```

---

```php
resources
    views
        auth
            confirm-password.blade
            forgot-password.blade
            login.blade.php
            register.blade.php
            reset-password.blade.php
            verify-email.blade.php
```
---

### #Laravel Jetstream

---

<img width="600" data-src="presentations/2021-08-18-kamil/images/meme2.jpg">

---

```php
composer require laravel/jetstream
```

---

### Opcje instalacji (2)

---

### Livewire 

```php
php artisan jetstream:install livewire
php artisan jetstream:install livewire --teams
```

---

### Inertia 

```php
php artisan jetstream:install inertia
php artisan jetstream:install inertia --teams
```

---

```
npm install
npm run dev
php artisan migrate
```

---

<img width="1000" data-src="presentations/2021-08-18-kamil/images/livewire-login.png">


---

<img width="1000" data-src="presentations/2021-08-18-kamil/images/profile01.png">


---

<img width="1000" data-src="presentations/2021-08-18-kamil/images/profile02.png">

---

### Podsumowanie

---

<table style="width:100%">
    	<thead>
            <tr style="text-align:center">
                <th>#</th>
                <th>Sanctum</th>
                <th>Fortify</th>
                <th>Breeze</th>
                <th>Jetstream</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">Views</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Tailwind</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">API</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">TFA</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Published tests</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Profile mng.</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
            </tr>
        </tbody>
    </table>

---

# The End


---

<img width="1000" data-src="presentations/2021-08-18-kamil/images/end.jpg">

---