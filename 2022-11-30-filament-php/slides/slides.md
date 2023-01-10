<img src="presentations/2022-11-30-filament-php/images/filament.png">
<br>
<p>Adrian Hopek, 30.11.2022</p>
---

<h4>"Admin panel, form builder and table builder for Laravel. Built with the TALL stack. Designed for humans."</h4>

---

<h3>Tall Stack</h3>
<img src="presentations/2022-11-30-filament-php/images/tall-stack.png" height="150px">

---

<h3>Livewire</h3>

---

```php
class Login extends Component
{
    public string $email = "";
    public string $password = "";
    public bool $remember = false;

    protected array $rules = [
        "email" => ["required", "email"],
        "password" => ["required"],
    ];

    public function getOrganizationProperty(CurrentOrganizationRetriever $organizationRetriever): Organization
    {
        return $organizationRetriever->get();
    }

    public function authenticate(AuthFactory $auth, Translator $translator, Dispatcher $dispatcher): void
    {
        $this->validate();
        
        /* ... */
        
        $this->redirectRoute("organization.home");
    }

    public function render(ViewFactory $view): View
    {
        return $view->make("organization.livewire.auth.login")
            ->layout("components.layouts.guest");
    }
}
```
---

<p>Watch - 84</p>
<p>Forks - 743</p>
<p>Stars - 5.1k</p>
<p>Issues - 815</p>
<p>Releases - 334</p>
<p>First release - v1.0.4 - 2 March 2021</p>
<p>Last release - v2.16.52 - 22 November 2022</p>

---

<img src="presentations/2022-11-30-filament-php/images/dashboard.png">

---

<h3>Packages</h3>
<ul style="text-align: left;">
    <li>Admin Panel - A fully-featured Laravel admin panel</li>
    <li>Form Builder - An intuitive Laravel form builder</li>
    <li>Table Builder - An interactive Laravel table builder</li>
    <li>Notifications - Powerful Laravel notifications</li>
<br>
    <li>Media Library, Settings, Tags, Translatable from Spatie</li>
</ul>

---

<h3>Resources</h3>

---

<h4>Creating a resource</h4>

```shell
php artisan make:filament-resource Customer
```

---

<pre>.
+-- CustomerResource.php
+-- CustomerResource
|   +-- Pages
|   |   +-- CreateCustomer.php
|   |   +-- EditCustomer.php
|   |   +-- ListCustomers.php</pre>

---

<p>Simple (modal) resource</p>

```shell
php artisan make:filament-resource Customer --simple
```

---

<p>Automatically generating forms and tables</p>

```shell
php artisan make:filament-resource Customer --generate
```

---

<p>Handling soft deletes</p>

```shell
php artisan make:filament-resource Customer --soft-deletes
```

---

<p>Generating a View page</p>
<pre><code>php artisan make:filament-resource Customer --view</code></pre>

---

<h3>Forms</h3>

---

<img src="presentations/2022-11-30-filament-php/images/forms.png">

---

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('name')
                ->required(),
            TextInput::make('email')
                ->email()
                ->required(),
            Select::make('author_id')
                ->relationship('author', 'name')
                ->preload()
            // ...
        ]);
}
```

---

```php
Select::make('authorId')
    ->relationship('author', 'name')
    ->createOptionForm([
        Forms\Components\TextInput::make('name')
            ->required(),
        Forms\Components\TextInput::make('email')
            ->required()
            ->email(),
    ]),
```

---

<h3>Fields</h3>
<ui style="text-align: left;">
<li>Text Input</li>
<li>Select</li>
<li>Checkbox</li>
<li>Toggle</li>
<li>Repeater</li>
<li>Rich Editor</li>
<li>Tags input</li>
<li>File upload</li>
<li>...</li>
<li>Custom field</li>
</ui>

---

<h3>Validation</h3>

---


<h4>Built in rules</h4>

```php
Field::make('email')->unique(ignoreRecord: true)
```

---

<h4>Laravel rules</h4>

```php
TextInput::make('slug')->rules(['alpha_dash'])
```

---

<h4>Custom rules</h4>

```php
TextInput::make('slug')->rules([new Uppercase()])
```

```php
TextInput::make('slug')->rules([
    function () {
        return function (string $attribute, $value, Closure $fail) {
            if ($value === 'foo') {
                $fail("The {$attribute} is invalid.");
            }
        };
    },
])```
 
---

<h3>Layouts</h3>
<ui style="text-align: left;">
<li>Stack</li>
<li>Grid</li>
<li>Fieldset</li>
<li>Tabs</li>
<li>Wizard (steps)</li>
<li>Section</li>
<li>Placeholder</li>
<li>Card</li>
<li>...</li>
<li>Custom layout</li>
</ui>

---

```php
return $form
    ->schema([
        Card::make()
            ->schema([
                TextInput::make('name')
                    ->maxValue(50)
                    ->required(),
                // ...
                DatePicker::make('birthday')
                    ->maxDate('today'),
            ])
            ->columns(2)
```

---

<h3>Tables</h3>

---

<img src="presentations/2022-11-30-filament-php/images/tables.png">

---

```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name'),
            TextColumn::make('email'),
            // ...
        ])
        ->filters([
            VerifiedFilter::make()
        ])
        ->actions([
            EditAction::make(),
        ])
        ->bulkActions([
            DeleteBulkAction::make(),
        ]);
}
```

---

<h3>Columns</h3>
<ul style="text-align: left;">
    <li>Text Column</li>
    <li>Icon Column</li>
    <li>Image Column</li>
    <li>Badge Column</li>
    <li>Select Column</li>
    <li>Toggle Column</li>
    <li>...</li>
    <li>Custom column</li>
</ul>

---

<h3>Column relationships</h3>

```php
TextColumn::make('author.name')
```

---

<h3>Layouts</h3>

---

<img src="presentations/2022-11-30-filament-php/images/layouts-1.png">

---

```php
Split::make([
    ImageColumn::make('avatar'),
    TextColumn::make('name'),
    Stack::make([
        TextColumn::make('email'),
        TextColumn::make('phone'),
    ])->alignment('right'),
])
```

---

<img src="presentations/2022-11-30-filament-php/images/layouts-2.png">

---

```php
[
    Split::make([
        ImageColumn::make('avatar'),
        TextColumn::make('name'),
    ]),
    Panel::make([
        Stack::make([
            TextColumn::make('email'),
            TextColumn::make('phone'),
        ]),
    ])->collapsible(),
]
```

---

<img src="presentations/2022-11-30-filament-php/images/layouts-3.png">

---

```php
$table->contentGrid([
    'md' => 2,
    'xl' => 3,
]);
```

---

<h3>Filters</h3>


---

<img src="presentations/2022-11-30-filament-php/images/filters.png">

---

```php
TernaryFilter::make('deleted')
    ->placeholder('Without deleted records')
    ->trueLabel('With deleted records')
    ->falseLabel('Only deleted records')
    ->queries(
        true: fn (Builder $query) => $query->withTrashed(),
        false: fn (Builder $query) => $query->onlyTrashed(),
        blank: fn (Builder $query) => $query->withoutTrashed(),
    )
```

---

```php
Filter::make('created_at')
    ->form([
        Forms\Components\DatePicker::make('created_from'),
        Forms\Components\DatePicker::make('created_until'),
    ])
    ->query(/**...**/)

```

---

<h3>Pages</h3>

---

<img src="presentations/2022-11-30-filament-php/images/page.png">

---

<ul style="text-align: left;">
    <li>CreateRecord</li>
    <li>EditRecord</li>
    <li>ListRecords</li>
    <li>ManageRecords</li>
    <li>ViewRecord</li>
    <li>...</li>
    <li>Base Page</li>
    <li>Dashboard</li>
</ul>

---

```php
class Login extends BaseLogin
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'admin@filamentphp.com',
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
```

---

```php
class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }
}
```

---

<h3>Actions</h3>

---

<img src="presentations/2022-11-30-filament-php/images/actions.png">

---

```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            // ...
        ])
        ->actions([
            // ...
            Tables\Actions\Action::make('activate')
                ->action(fn (Post $record) => $record->activate())
                ->requiresConfirmation()
                ->color('success'),
        ]);
}
```

---

<h3>Bulk actions</h3>

---

<img src="presentations/2022-11-30-filament-php/images/actions.png">

---

```php
$table->bulkActions([
    Tables\Actions\DeleteBulkAction::make()
        ->action(function () {
            Notification::make()
                ->title(/* */)
                ->warning()
                ->send();
        }),
]);
```

---

<h3>Widgets</h3>

---

<img src="presentations/2022-11-30-filament-php/images/widgets.png">

---

```php
class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getCards(): array
    {
        return [
            Card::make('Revenue', '$192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Card::make('New customers', '1340')
                ->description('3% decrease')
                ->descriptionIcon('heroicon-s-trending-down')
                ->chart([17, 16, 14, 15, 14, 13, 12])
                ->color('danger'),
            Card::make('New orders', '3543')
                ->description('7% increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('success'),
        ];
    }
}
```

---

```php
class OrdersChart extends LineChartWidget
{
    protected static ?string $heading = 'Orders per month';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => [2433, 3454, 4566, 2342, 5545, 5765, 6787, 8767, 7565, 8576, 9686, 8996],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
```

---

```php
class LatestOrders extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected function getTableQuery(): Builder
    {
        return OrderResource::getEloquentQuery();
    }

    protected function getTableColumns(): array
    {
        return [/*  */];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('open')
                ->url(fn (Order $record): string => OrderResource::getUrl('edit', ['record' => $record])),
        ];
    }
}
```

---

<h3>Testing</h3>

---

```php 
it('can create', function () {
    $newData = Post::factory()->make();
 
    livewire(PostResource\Pages\CreatePost::class)
        ->fillForm([
            'author_id' => $newData->author->getKey(),
            'content' => $newData->content,
            'tags' => $newData->tags,
            'title' => $newData->title,
        ])
        ->call('create')
        ->assertHasNoFormErrors();
 
    $this->assertDatabaseHas(Post::class, [
        'author_id' => $newData->author->getKey(),
        'content' => $newData->content,
        'tags' => json_encode($newData->tags),
        'title' => $newData->title,
    ]);
});
```

---

```php
it('can list posts', function () {
    $category = Category::factory()
        ->has(Post::factory()->count(10))
        ->create();
 
    livewire(CategoryResource\RelationManagers\PostsRelationManager::class, [
        'ownerRecord' => $category,
    ])
        ->assertCanSeeTableRecords($category->posts);
});
```

---

```php
it('can delete', function () {
    $post = Post::factory()->create();
 
    livewire(PostResource\Pages\EditPost::class, [
        'record' => $post->getKey(),
    ])
        ->callPageAction(DeleteAction::class);
 
    $this->assertModelMissing($post);
});
```

---

<h3>Plugin development</h3>

---

<img src="presentations/2022-11-30-filament-php/images/plugins.png">


---

<h3>Other features</h3>
<ul style="text-align: left;">
    <li>Validation</li>
    <li>Modals</li>
    <li>Authorization</li>
    <li>Appearance</li>
    <li>Notifications</li>
    <li>Navigation</li>
    <li>Polling</li>
    <li>Global search</li>
    <li>Relation managers</li>
    <li>...</li>
</ul>

---

<h2>Thank you!</h2>
