## Blumilk Internal Meetup #11


\
\
<img src="presentations/2021-10-20-pest/images/logo.png" width="300px">
\
\
\
Kamil Piech 20.10.2021

---

<img width="1000" data-src="presentations/2021-10-20-pest/images/testing_meme3.png">

---

### INSTALLATION

---

```php
composer require pestphp/pest-plugin-laravel --dev
php artisan pest:install
```

---
```php
tests
    - Unit/ComponentTest.php <--
    - Feature/HomeTest.php <--
phpunit.xml
```
---
```php
<?php

test('has home', function () {
    // ..
});
 
// or

it('has home', function () {
    // ..
});
```
---

```php
<?php

test('asserts true is true', function () {
    $this->assertTrue(true);
 
    expect(true)->toBeTrue();
});
```
---

```php
./vendor/bin/pest
```
---

```php
✓ asserts true is true

✓ it asserts true is true
```

---

```php
<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

beforeEach(fn () => User::factory()->create());

it('has users')->assertDatabaseHas('users', [
    'id' => 1,
]);
```
---

### uses()

---

```php
<?php
 
use Illuminate\Foundation\Testing\RefreshDatabase;
 
// Uses the given trait in the current file
uses(RefreshDatabase::class);
```

---

```php
<?php
 
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
 
// Uses the given test case in the "Feature" folder recursively
uses(TestCase::class)->in('Feature');
 
// Uses the given trait in the "Unit" folder recursively
uses(RefreshDatabase::class)->in('Unit');
```
---
```php
tests
    - Unit/ComponentTest.php
    - Feature/HomeTest.php
    - Pest.php <--
phpunit.xml
```
---
### Expectations
---
```php
expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});
```
```php
it('is one', function () {
    $this->expect(1)->toBeOne();
});
```
---

### FUNCTIONS

---

```php
function something()
{
    // ..
}
```

---
### setup/teardown functions
---
- beforeEach()
- afterEach()
- beforeAll()
- afterAll()

---
```php
// Pest.php

uses()
    ->beforeEach(fn () => $this->actingAs(User::first()))
    ->in('Feature/Dashboard');
```
---
### GROUPS
---
```php
it('has home', function () {
    // ..
})->group('integration', 'browser');
```
```php
./vendor/bin/pest --group=integration,browser
```
---
livewire()
---
```php
composer require pestphp/pest-plugin-livewire --dev
```
```php
<?php

use function Pest\Livewire\livewire;
 
it('can be incremented', function () {
    livewire(Counter::class)
        ->call('increment')
        ->assertSee(1);
 
    // Same as:
    $this->livewire(Counter::class)
        ->call('increment')
        ->assertSee(1);
});
```
---

Laravel Dusk

---
```php
<?php

use Tests\DuskTestCase;
 
uses(DuskTestCase::class)->in('Browser');
```
```php
<?php
 
use Laravel\Dusk\Browser;
 
it('has homepage', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->assertSee('Pest');
    });
});
```
---

# The End

---

<img width="590" data-src="presentations/2021-10-20-pest/images/lets-test-in.jpg">

---