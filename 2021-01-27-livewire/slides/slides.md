## Blumilk Internal Meetup #2

<q>Laravel Livewire</q>
\
<img width="500" data-src="presentations/2021-01-27-livewire/images/logo.png">
\
\
\
Mateusz Lencki <del>20.01.2021</del> 27.01.2021

---

## What is this?
<br/>
<q>Livewire is a full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the
comfort of Laravel.</q>
<br/><br/>

---

## Installation
<br/><br/>
Install The Package with Composer
<section>
  <pre><code data-trim>
composer require livewire/livewire
  </code></pre>
</section>
---

Include Livewire Assets in your Layout file
<pre><code data-line-numbers="4,8">&lt;html&gt;
    &lt;head&gt;
        ...
        @livewireStyles
    &lt;/head&gt;
    &lt;body&gt;
        ...
        @livewireScripts
    &lt;/body&gt;
&lt;/html&gt;
</code></pre>
---
## Components

<img width="600" data-src="presentations/2021-01-27-livewire/images/components.png">

---
<section style="height:83%">
  <pre style="height:100%"><code data-trim data-noescape data-line-numbers="1|3|5|7-10|12-15|17-20">
class UserList extends Component 
{
    use AuthenticatedUser;
    </br>
    public Collection $users;
    </br>
    public function render(Factory $viewFactory): View
    {
        return $viewFactory->make('settings.users.list');
    }
    </br>
    public function mount(): void
    {
        $this->users = User::query()->get();
    }
    </br>
    public function delete(int $id): void
    {
        User::query()->findOrFail($id)->delete();
    }
}
  </code></pre>
</section>

---
#### Making components
<section>
  <pre><code data-trim>
php artisan make:livewire ShowPosts
  </code></pre>
</section>

---
#### Rendering components
<section>
  <pre><code data-trim data-noescape data-line-numbers="2">
&lt;div&gt;
    &lt;livewire:show-posts /&gt;
&lt;/div&gt;
  </code></pre>
</section>
<section>
  <pre><code data-trim data-noescape data-line-numbers="2">
&lt;div&gt;
    @livewire('show-posts')
&lt;/div&gt;
  </code></pre>
</section>

---
#### Passing Parameters
<section>
  <pre><code data-trim data-noescape data-line-numbers="2">
&lt;div&gt;
    &lt;livewire:show-posts :post="$post" /&gt;
&lt;/div&gt;
  </code></pre>
</section>
<section>
  <pre><code data-trim data-noescape data-line-numbers="2">
&lt;div&gt;
    @livewire('show-posts', ['post' => $post])
&lt;/div&gt;
  </code></pre>
</section>

---
#### Properties

<section>
  <pre><code data-trim data-noescape data-line-numbers="3">
class HelloWorld extends Component
{
    public $message = 'Hello World!';
    ...
  </code></pre>
</section>

<section>
  <pre><code data-trim data-noescape data-line-numbers="2">
&lt;div&gt;
    &lt;h1&gt;{{ $message }}&lt;/h1&gt;
&lt;/div&gt;
</code></pre>
</section>

<section>
!!!

Property names can't conflict with property names reserved for Livewire (e.g. rules or messages)

!!!
</section>

<section>
!!!

Data stored in public properties is made visible to the front-end JavaScript. Therefore, you SHOULD NOT store sensitive data in them.

!!!
</section>

<section>
!!!

Public properties can ONLY be either JavaScript-friendly data types (string, int, array, boolean), OR one of the following PHP types: Stringable, Collection, DateTime, Model, EloquentCollection.

!!!
</section>

<section>
!!!

protected and private properties DO NOT persist between Livewire updates. In general, you should avoid using them for storing state.

!!!
</section>

---
#### Actions

<section>
  <pre><code data-trim data-noescape data-line-numbers="5-8">
class ShowPost extends Component
{
    public Post $post;
    </br>
    public function like()
    {
        $this->post->addLikeBy(auth()->user());
    }
}
</code></pre>
</section>

<section>
  <pre><code data-trim data-noescape data-line-numbers="2">
&lt;div&gt;
    &lt;button wire:click=&quot;like&quot;&gt;Like Post&lt;/button&gt;
&lt;/div&gt;
</code></pre>
</section>

---
#### Events

<section>
  Livewire components can communicate with each other through a global event system. As long as two Livewire components are living on the same page, they can communicate using events and listeners.
</section>

<section>
Firing event from the template
  <pre><code data-trim data-noescape>
&lt;button wire:click=&quot;$emit('postAdded')&quot;&gt;
</code></pre>
</br>
Firing event from the component
  <pre><code data-trim data-noescape>
$this->emit('postAdded');
</code></pre>
</section>

<section>
Listening to events
  <pre><code data-trim data-noescape data-line-numbers="5|7-10">
class ShowPosts extends Component
{
    public $postCount;
    </br>
    protected $listeners = ['postAdded' => 'incrementPostCount'];
    </br>
    public function incrementPostCount()
    {
        $this->postCount = Post::count();
    }
}
</code></pre>
</section>

---
#### Scoping events

<section>
to parents:
  <pre><code data-trim data-noescape data-line-numbers="5|7-10">
$this->emitUp('postAdded');
</code></pre>
</section>

<section>
to component:
  <pre><code data-trim data-noescape data-line-numbers="5|7-10">
$this->emitTo('counter', 'postAdded');
</code></pre>
</section>

<section>
to self:
  <pre><code data-trim data-noescape data-line-numbers="5|7-10">
$this->emitSelf('postAdded');
</code></pre>
</section>

---
#### Lifecycle hooks
<section>
	<table>
    	<thead><tr>
            <th>Hook</th>
            <th>Description</th>
        </tr></thead>
        <tbody><tr>
            <td>mount</td>
            <td>Runs once, immediately after the component is instantiated, but before render() is called</td>
        </tr>
        <tr>
            <td>hydrate</td>
            <td>Runs on every request, after the component is hydrated, but before an action is performed, or render() is called</td>
        </tr>
        <tr>
            <td>hydrateFoo</td>
            <td>Runs before a property called $foo is hydrated</td>
        </tr>
    </tbody>
    </table>
</section>

<section>
	<table>
    	<thead><tr>
            <th>Hook</th>
            <th>Description</th>
        </tr></thead>
        <tbody><tr>
            <td>dehydrate</td>
            <td>Runs on every request, before the component is dehydrated, but after render() is called</td>
        </tr>
        <tr>
            <td>dehydrateFoo</td>
            <td>Runs before a property called $foo is dehydrated</td>
        </tr>
        <tr>
            <td>updating</td>
            <td>Runs before any update to the Livewire component's data (Using wire:model, not directly inside PHP)</td>
        </tr>
    </tbody>
    </table>
</section>

<section>
	<table>
    	<thead><tr>
            <th>Hook</th>
            <th>Description</th>
        </tr></thead>
        <tbody><tr>
            <td>updated</td>
            <td>Runs after any update to the Livewire component's data (Using wire:model, not directly inside PHP)</td>
        </tr>
        <tr>
            <td>updatingFoo</td>
            <td>Runs before a property called $foo is updated</td>
        </tr>
        <tr>
            <td>updatedFoo</td>
            <td>Runs after a property called $foo is updated</td>
        </tr>
    </tbody>
    </table>
</section>

---
#### Nesting components

<section>
  <pre><code data-trim data-noescape data-line-numbers="6">
&lt;div&gt;
    Name: {{ $user-&gt;name }}
    Email: {{ $user-&gt;email }}
<br>
    &lt;div&gt;
       @livewire('add-user-note', ['user' =&gt; $user])
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>
</section>

<section>
Keeping Track Of Components In A Loop
  <pre><code data-trim data-noescape data-line-numbers="3">
&lt;div&gt;
    @foreach ($users as $user)
        @livewire('user-profile', ..., key($user-&gt;id))
    @endforeach
&lt;/div&gt;
</code></pre>
</section>

---
#### Validation

---
#### File uploads

---
#### Authorization

---
#### Loading states

<section>
  <pre><code data-trim data-noescape data-line-numbers="4|8">
&lt;div&gt;
    &lt;button wire:click=&quot;checkout&quot;&gt;Checkout&lt;/button&gt;
</br>
    &lt;div wire:loading&gt;
        Processing Payment...
    &lt;/div&gt;
</br>
    &lt;div wire:loading.remove&gt;
        Processing Payment...
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>
</section>

---
#### Polling

<section>
  <pre><code data-trim data-noescape data-line-numbers="1">
&lt;div wire:poll.750ms&gt;
    Current time: {{ now() }}
&lt;/div&gt;
</code></pre>
</section>

---
#### JS integrations

<img data-src="presentations/2021-01-27-livewire/images/meme.jpg">

---
#### AlpineJS

<a href="https://github.com/alpinejs/alpine">https://github.com/alpinejs/alpine</a>

---
#### Inline scripts

<section style="height:62%">
  <pre style="height:100%"><code data-trim data-noescape data-line-numbers="2|3-4,6-7,9-10,12-13">
&lt;script&gt;
    document.addEventListener('livewire:load', function () {
        // Get the value of the &quot;count&quot; property
        var someValue = @this.count
        <br>
        // Set the value of the &quot;count&quot; property
        @this.count = 5
        <br>
        // Call the increment component action
        @this.increment()
        <br>
        // Run a callback when an event (&quot;foo&quot;) is emitted from this component
        @this.on('foo', () =&gt; {})
    })
&lt;/script&gt;
</code></pre>
</section>

---
#### Testing

---
#### The End