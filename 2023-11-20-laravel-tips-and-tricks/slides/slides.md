
<div style="display: flex; justify-content: center; align-items: center; font-weight: bold">
<img style="height: 1.5em; margin-right: 0.3em" data-src="presentations/2023-11-20-laravel-tips-and-tricks/images/blumilk-logo.png">
<p style="padding-top: 0.5em; font-size: 0.7em;">Blumilk Internal Meetup #33</p>
</div>

<br>

<h1>Laravel <br> tips & tricks</h1>
<br><br>

<small>Jakub Wójcik <br> 20 listopada 2023</small>

<br>

---

### Tworzenie modelu

    php artisan make:model post

    php artisan make:model post -c //controller
    php artisan make:model post -m //migration
    php artisan make:model post -f //factory
    php artisan make:model post -R //form request
    php artisan make:model post -s //seeder
    php artisan make:model post --policy //policy

    php artisan make:model post -a //migration, seeder, factory, policy, resource controller, form request

---
### Maintenance mode

<br>
Krótka wersja:

```bash
php artisan down
```
```bash
php artisan up
```

<br>
Rozbudowana wersja:

```bash
php artisan down --redirect="/" --render="errors::503" --secret="1630542a-246b-4b66-2137-dd72a4c43515" --retry=60
```

---
### Nie pakuj

```php
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
```
---
### Uniknij n+1 zapytań

    class EmployeeResource extends JsonResource
    {
        public function toArray($request): array
        {
            return [
            'id' => $this->uuid,
            'fullName' => $this->full_name,
            'email' => $this->email,
            'jobTitle' => $this->job_title,
            'department' => DepartmentResource::make($this->whenLoaded('department')),
            ];
        }
    }

---
### Policz

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'posts_count' => $this->whenCounted('posts'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

---
### Oddaj ostatnie

Zamiast:

    User::orderBy('created_at', 'desc')->get();

Można to zrobić tak:

    User::latest()->get();

I tak:

    $lastUpdatedUser = User::latest('updated_at')->first();

Również:

    User::oldest()->get();

---
### Pozmieniaj

    class Role extends Model
    {
        const CREATED_AT = 'create_time';
        const UPDATED_AT = 'update_time';
    }

---

### Wyczyść mi to

Zamiast:

    php artisan cache:clear
    php artisan route:clear
    php artisan config:clear

Użyj:

    php artisan optimize:clear
---
### Wygeneruj obraz

    $factory->define(User::class, function (Faker $faker) {
        return [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'avatar' => $faker->image(storage_path('images'), 50, 50)
        ];
    });

---
### Zmierz czas

    class OrderController
    {
        public function index()
        {
            return Benchmark::measure(fn () => Order::all()),
        }
    }
---

### Gdzie?

Zamiast:

    User::where('company', 'Blumilk')
        ->where('job_type', 'full time')
        ->get();

Użyj:
    
    User::where([
            'company' => 'Blumilk', 
            'job_type' => 'full time'])
        ->get();

---
### Przerwa na mema
<img style="height: 12em;" data-src="presentations/2023-11-20-laravel-tips-and-tricks/images/meme.webp">

---
### dd()
Zamiast

    $users = User::where('name', 'Taylor')->get();

    dd($users);
Użyj

    $users = User::where('name', 'Taylor')->get()->dd();

---
### Co się kryje pod spodem?

    $invoices = Invoice::where('client', 'Juan Pablo')->toSql();
    dd($invoices)
    
    // select * from `invoices` where `client` = ?

---
### Grupuj

<section class="text-small">

Zamiast:

    Route::get("/sections", [SectionController::class, "show"])->name("sections.show");
    Route::post("/sections", [SectionController::class, "store"])->name("sections.store");
    Route::patch("/sections/{section}", [SectionController::class, "update"])->name("sections.update");
    Route::delete("/sections/{section}", [SectionController::class, "destroy]")->name("sections.destroy");

Użyj:

    Route::controller(SectionController::class)->group(function (): void {
        Route::get("/sections", "show")->name("sections.show");
        Route::post("/sections", "store")->name("sections.store");
        Route::patch("/sections/{section}", "update")->name("sections.update");
        Route::delete("/sections/{section}", "destroy")->name("sections.destroy");
    });
</section>


---
### Przekieruj
<br><br>
Zamiast:

    return redirect()->route('home');

Użyj:

    return to_route('home');

---
### Zrób

    return redirect()->action([SomeController::class, 'method'], ['param' => $value]);
---

### Dostosuj paginację
Standardowa paginacja:

    $users = User::paginate(10);

Tylko "previous" i "next":

    $users = User::simplePaginate(10);
---
### Pytania

---
### Dziękuję

