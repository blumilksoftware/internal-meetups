## Blumilk Internal Meetup #18

\
\
<img src="presentations/2022-06-08-laravel-authorization/images/laravel-logo.png" width="100px">
\
Laravel Authorization Packages

\
\
\
Magdalena Bukowska 08.06.2022

---

<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/auth.png">

---

#### Are authorization packages needed?

---

#### What can Laravel provide out-of-the-box?

- Gates
- Policies
- <b>$this->authorize()</b> method
- <b>@can</b> and <b>@cannot</b> Blade commands

---

Gates

<section>
<pre><code data-trim data-noescape data-line-numbers="7,8,9">
class AuthServiceProvider
<br/>
public function boot()
{
    $this->registerPolicies();
<br/>
    Gate::define('update-post', function (User $user, Post $post) {
        return $user->id === $post->user_id;
    });
}</code></pre>
</section>
<br/>

<section>
<pre><code data-trim data-noescape data-line-numbers="1,3">
if (Gate::forUser($user)->allows('update-post', $post)) {
    // Post can be updated...
}</code></pre>
<br/>

- allows
- denies
- any
- none

</section>

<section>
<pre><code data-trim data-noescape data-line-numbers="1">
Gate::authorize('update-post', $post);
// The action is authorized...</code></pre>
</section>

<section>
<pre><code data-trim data-noescape data-line-numbers="1:5">
$gate->before(function ($user, $ability) {
    if ($user->isSuperAdmin()) {
        return true;
    }
});</code></pre>
</section>

---

Policies

<section>

```html
php artisan make:policy PostPolicy --model=Post
```

</section>

<section>
<pre><code data-trim data-noescape data-line-numbers="">
public function update(User $user, Post $post)
{
    return $user->id === $post->user_id
                ? Response::allow()
                : Response::deny('You do not own this post.');
}</code></pre>
</section>

<section>
<pre><code data-trim data-noescape data-line-numbers="">
// class PostController
    public function update(Request $request, Post $post)
    {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }
    }</code></pre>
</section>

---

Authorization via Middleware

<pre><code data-trim data-noescape data-line-numbers="">
Route::put('/post/{post}', function (Post $post) {
    // The current user may update the post...
})->middleware('can:update,post');</code></pre>
<br/>
<pre><code data-trim data-noescape data-line-numbers="">
Route::put('/post/{post}', function (Post $post) {
    // The current user may update the post...
})->can('update', 'post');</code></pre>

---

Authorization via Blade Templates

<pre><code data-trim data-noescape data-line-numbers="">
@can('update', $post)
    //The current user can update the post...
@elsecan('create', App\Models\Post::class)
    //The current user can create posts...
@endcan</code></pre>
<br/>

- @can @elsecan
- @cannot @elsecannot
- @canany @elsecanany

---

<section>
<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/bouncer-logo.jpg">
</section>
<section>
<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/bouncer-translation.png">
</section>
<section>
<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/bouncer-stats.png">
</section>

---

<section>

```php
composer require silber/bouncer

php artisan vendor:publish --tag="bouncer.migrations"
php artisan migrate
```

</section>

<section>
<img width="500" data-src="presentations/2022-06-08-laravel-authorization/images/bouncer-database.png">
</section>

<section>
<pre><code data-trim data-noescape data-line-numbers="">
use Silber\Bouncer\Database\HasRolesAndAbilities;
<br/>
class User extends Model
{
    use HasRolesAndAbilities;
    //...
}</code></pre>
</section>

---

<section>
<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/spatie-logo.png">
</section>

<section>
<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/spatie-stats.png">
</section>

---

<section>

```php
composer require spatie/laravel-permission

php artisan vendor:publish --provider="Spatie Laravel-permission\Permission\PermissionServiceProvider"
php artisan migrate
```

</section>

<section>
<img width="800" data-src="presentations/2022-06-08-laravel-authorization/images/spatie-database.png">
</section>

<section>
<pre><code data-trim data-noescape data-line-numbers="">
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie Laravel-permission\Permission\Traits\HasRoles;
<br/>
class User extends Authenticatable
{
    use HasRoles;
    //...
}</code></pre>
</section>

---

<section>
<img width="200" data-src="presentations/2022-06-08-laravel-authorization/images/laratrust-logo.png">
</section>

<section>
<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/laratrust-stats.png">
</section>

---

<section>

```php
composer require santigarcor/laratrust

php artisan vendor:publish --tag="laratrust"
php artisan laratrust:setup
php artisan migrate
```

</section>

<section>
<img width="800" data-src="presentations/2022-06-08-laravel-authorization/images/spatie-database.png">
</section>

<section>
<pre><code data-trim data-noescape data-line-numbers="">
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
<br/>
class User extends Model
{
    use LaratrustUserTrait;
    //...
}</code></pre>
</section>

---

#### What do these packages do?

---

#### Role & Permission creation

Bouncer

```php
Bouncer::allow('admin')->to('ban-users');
```
<br/>
Spatie Laravel-permission & Laratrust

```php
Role::create(['name' => 'writer']);
Permission::create(['name' => 'edit articles']);
```

---

#### User roles assignment
<br/>
<section>

```php
// Bouncer
$user->assign('admin');
$user->assign(['writer', 'admin']);
```
<br/>

```php
// Spatie Laravel-permission
$user->assignRole('writer');
$user->assignRole(['writer', 'admin']);
```
<br/>

```php
// Laratrust
$user->attachRole($admin); 
// param: Role object, array, id or the role string name
$user->attachRoles([$admin, $owner]);
```
</section>
<section>

```php
// Bouncer
$user->retract('admin');
```
<br/>

```php
// Spatie Laravel-permission
$user->removeRole('writer');
```
<br/>

```php
// Laratrust
$user->detachRole($admin);
```
</section>
<section>

```php
// Bouncer
Bouncer::sync($user)->roles($roles);
Bouncer::sync($user)->abilities($roles);
```
<br/>

```php
// Spatie Laravel-permission
$user->syncRoles(['writer', 'admin']);
```
<br/>

```php
// Laratrust
$user->syncRoles([$admin->id, $owner->id]);
$user->syncRolesWithoutDetaching([$admin->id, $owner->id]);
```
</section>

---

#### Role check
<br/>
<section>

```php
// Bouncer
$user->isAn('admin');
$user->isA('subscriber', 'writer');
$user->isAll('editor', 'moderator');
$user->isNot('subscriber', 'moderator');
```

```php
// Spatie Laravel-permission
$user->hasRole('writer');
$user->hasAnyRole(Role::all());
$user->hasAllRoles(Role::all());
```

```php
// Laratrust
$user->hasRole('owner');
$user->hasRole(['owner', 'admin']);
// Alternatively: 
$user->isA('writer');
$user->isAn('owner');
```
</section>

---

#### User permissions assignment
<br/>
<section>

```php
// Bouncer
$user->allow('ban-users');
$user->allow(['ban-users', 'edit-articles']);
Bouncer::allow($user)->to('edit', Post::class);
```
<br/>

```php
// Spatie Laravel-permission
$user->givePermissionTo('edit articles');
$user->givePermissionTo('edit articles', 'delete articles');
```
<br/>

```php
// Laratrust
$user->attachPermission($editUser);
// param: Permission object, array, id or string permission name
$user->attachPermissions([$editUser, $createPost]);
```
</section>

---

#### Permission check
<br/>
<section>

```php
// Bouncer
Bouncer::allows('edit articles')
```
<br/>

```php
// Spatie Laravel-permission
$user->can('edit articles');
$role->hasPermissionTo('edit articles');
```
<br/>

```php
// Laratrust
$user->isAbleTo('edit-user');
$user->isAbleTo(['edit-user', 'create-post']);
$user->isAbleTo('edit-user|create-post');
```
</section>

---

#### Blade Commands
<br/>
<section>
Spatie Laravel-permission

```php
@role('writer')
    // I'm a writer!
@else
    // I'm not a writer...
@endrole
```
<br/>

```php
@hasanyrole('writer|admin')
    // I have one or more of these roles!
@else
    // I have none of these roles...
@endhasanyrole
```

</section>
<section>
Laratrust

```php
@role('admin')
    // ...
@endrole

@permission('manage-admins')
    // ...
@endpermission

@isAbleToAndOwns('edit-post', $post)
    // ...
@endOwns

@hasRoleAndOwns('admin', $post)
    // ...
@endOwns

```

</section>

---

### Roles or Permissions?

---

### Cache

Bouncer
```php
Bouncer::refresh();
```
```php
Bouncer::refreshFor($user);
```
<br/>

Spatie Laravel-permission
```php
php artisan permission:cache-reset
```

---

### Teams

Spatie Laravel-permission

```php
Role::create(['name' => 'reader', 'team_id' => 1]);
```

<br/>

Laratrust

```php
$user->attachRole($admin, $team);

$user->attachPermission($editUser, $team);
```

---

### What about UI?

<section>
Laratrust

<br/>

```php
// config/laratrust.php
'panel' => [
    'register' => true,
]
```

<br/>

```php
php artisan vendor:publish --tag=laratrust-assets --force
```
</section>

<section>

<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/ui-user-edit.png">

</section>

<section>

<img width="600" data-src="presentations/2022-06-08-laravel-authorization/images/ui-role-edit.png">

</section>

---

### Summary

---

<table style="width:100%">
    	<thead>
            <tr style="text-align:center">
                <th></th>
                <th>Bouncer</th>
                <th>Spatie</th>
                <th>Laratrust</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center">Gates & Policies support</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Migrations</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">UI</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Object ownership</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Blade directives</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Teams</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">+</td>
            </tr>
            <tr>
                <td style="text-align:center">Multi-tenancy</td>
                <td style="text-align:center">+</td>
                <td style="text-align:center">-</td>
                <td style="text-align:center">-</td>
            </tr>
        </tbody>
    </table>

---

# The End
