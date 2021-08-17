## Blumilk Internal Meetup #8
\
<img width="500" data-src="presentations/2021-08-03-inertia/images/start.png">
\
Adrian Hopek <del>21.07.2021</del> <del>28.07.2021</del> <del>29.07.2021</del> <del>30.07.2021</del> <del>02.08.2021</del> 03.08.2021

---
## Inertia.js

<q>Inertia allows you to create fully client-side rendered, single-page apps, without much of the complexity that comes with modern SPAs. It does this by leveraging existing server-side frameworks.</q>

---
## Who is it for?

---
## How it works?

---

<section style="height:55%; overflow: hidden;">
  <pre style="height:100%"><code data-trim data-noescape data-line-numbers="1-13">
public function index()
{
    $organizations = Auth::user()->account->organizations();
    <br>
    return Inertia::render('Organizations/Index', [
        'filters' => Request::all('search', 'trashed'),
        'organizations' => $organizations
            ->orderBy('name')
            ->filter(Request::only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString()
    ]);
}
  </code></pre>
</section>

---
## Installation - server-side
<section>
  <pre><code data-trim>
composer require inertiajs/inertia-laravel
  </code></pre>
  <pre><code data-trim>
php artisan inertia:middleware
  </code></pre>
<pre><code data-trim data-line-numbers="1-11|9">
<script type="text/template">
    <html>
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <script src="{{ mix('/js/app.js') }}" defer />
      </head>
      <body>
        @inertia
      </body>
    </html>
</script>
</code></pre>
</section>

---
## Installation - client-side
<pre><code data-trim>
npm install @inertiajs/inertia @inertiajs/inertia-vue
</code></pre>

<pre><code data-trim data-line-numbers="1-11|5">
import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props }) {
    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})
</code></pre>
---
## Responses - backend
<pre><code data-trim data-line-numbers="1-11|7|8">
use Inertia\Inertia;

class UsersController extends Controller
{
    public function welcome()
    {
        return Inertia::render('User/Welcome', [
            'user' => Auth::user(),
        ]);
    }
}
</code></pre>

---
## Pages - frontend
<pre><code data-trim data-line-numbers="1-7|9-21">
<script type="text/template">
<template>
  <Layout>
    <Head title="Welcome" />
    <H1>Welcome</H1>
    <p>Hello {{ user.name }}, welcome to your first Inertia app!</p>
  </Layout>
</template>

<script>
  import Layout from './Layout'
  import { Head } from '@inertiajs/inertia-vue'

  export default {
    components: {
      Head,
      Layout,
    },
    props: {
      user: Object,
    },
  }
</script>
</script>

</code></pre>
---
## Layouts
<pre><code data-trim data-line-numbers="1-12|14-21">
<script type="text/template">
<template>
  <main>
    <header>
      <Link href="/">Home</Link>
      <Link href="/about">About</Link>
      <Link href="/contact">Contact</Link>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
  components: {
    Link,
  }
}
</script>
</script>
</code></pre>
---
## Persistent layouts
<pre><code data-trim data-line-numbers="1-6|9-22">
<script type="text/template">
<template>
  <div>
    <H1>Welcome</H1>
    <p>Hello {{ user.name }}, welcome to your first Inertia app!</p>
  </div>
</template>

<script>
import Layout from './Layout'

export default {
    // Using a render function
    layout: (h, page) => h(Layout, [page]),
    
    // Using the shorthand
    layout: Layout,
    
    props: {
      user: Object,
    },
}
</script>
</script>
</code></pre>
---
## Shared data
App\Http\Middleware\HandleInertiaRequests
<pre><code data-trim data-line-numbers="1-16">
public function share(Request $request)
{
    return array_merge(parent::share($request), [
        'auth' => function () use ($request) {
            return [
                'user' => $request->user(),
            ];
        },
        'flash' => function () use ($request) {
            return [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ];
        },
    ]);
}
</code></pre>
---
## Accessing shared data
<pre><code data-trim data-line-numbers="1-10|12-19">
<script type="text/template">
<template>
  <main>
    <header>
      You are logged in as: {{ user.name }}
    </header>
    <content>
      <slot />
    </content>
  </main>
</template>

<script>
export default {
  computed: {
    user() {
      return this.$page.props.auth.user
    }
  }
}
</script>
</script>
</code></pre>
---
## Routing
<pre><code data-trim data-line-numbers="1-15">
Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');
</code></pre>
---
## Generating URLs
<pre><code data-trim>
'create_url' => URL::route('users.create')
</code></pre>

<pre><code data-trim>
let routes = {{ json_encode($routes) }}
</code></pre>

<pre><code data-trim>
<script type="text/template">
Vue.prototype.$route = route; // Ziggy
<Link :href="$route('users.create')">Create User</Link>
</script>
</code></pre>
---
## Links
<pre><code data-trim data-line-numbers="1|3-4|6-7|9-10">
import { Link } from '@inertiajs/inertia-vue'

// GET
<Link href="/">Home</Link>

// POST + button
<Link href="/logout" method="post" as="button" type="button">Logout</Link>

// POST + data
<Link href="/endpoint" method="post" :data="{ foo: bar }">Save</Link>

</code></pre>
---
## Manual Visits
<pre><code data-trim data-line-numbers="1-7">
this.$inertia.get(url, data, options)
this.$inertia.post(url, data, options)
this.$inertia.put(url, data, options)
this.$inertia.patch(url, data, options)
this.$inertia.delete(url, options)
this.$inertia.replace(url, options)
this.$inertia.reload(options)
</code></pre>
---
## Redirects
<pre><code data-trim data-line-numbers="1-8|10-21">
class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::all(),
        ]);
    }

    public function store()
    {
        User::create(
            Request::validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'max:50', 'email'],
            ])
        );

        return Redirect::route('users.index');
    }
}
</code></pre>
---
## Head component
<pre><code data-trim data-line-numbers="1-6">
<script type="text/template">
import { Head } from '@inertiajs/inertia-vue'

<Head>
  <title>Your page title</title>
  <meta name="description" content="Your page description">
</Head>
</script>
</code></pre>
---
## Forms
<pre><code data-trim data-line-numbers="1-11|14-28">
<script type="text/template">
<template>
  <form @submit.prevent="submit">
    <label for="first_name">First name:</label>
    <input id="first_name" v-model="form.first_name" />
    <label for="last_name">Last name:</label>
    <input id="last_name" v-model="form.last_name" />
    <label for="email">Email:</label>
    <input id="email" v-model="form.email" />
    <button type="submit">Submit</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {
        first_name: null,
        last_name: null,
        email: null,
      },
    }
  },
  methods: {
    submit() {
      this.$inertia.post('/users', this.form)
    },
  },
}
</script>
</script>
</code></pre>

---
## Validation errors
<pre><code data-trim data-line-numbers="1-14|17-33">
<script type="text/template">
<template>
  <form @submit.prevent="submit">
    <label for="first_name">First name:</label>
    <input id="first_name" v-model="form.first_name" />
    <div v-if="errors.first_name">{{ errors.first_name }}</div>
    <label for="last_name">Last name:</label>
    <input id="last_name" v-model="form.last_name" />
    <div v-if="errors.last_name">{{ errors.last_name }}</div>
    <label for="email">Email:</label>
    <input id="email" v-model="form.email" />
    <div v-if="errors.email">{{ errors.email }}</div>
    <button type="submit">Submit</button>
  </form>
</template>

<script>
export default {
  props: {
    errors: Object,
  },
  data() {
    return {
      form: {
        first_name: null,
        last_name: null,
        email: null,
      },
    }
  },
  methods: {
    submit() {
      this.$inertia.post('/users', this.form)
    },
  },
}
</script>
</script>

---
## Form helper
<pre><code data-trim data-line-numbers="1-10|13-23">
<script type="text/template">
<template>
  <form @submit.prevent="form.post('/login')">
    <input type="text" v-model="form.email">
    <div v-if="form.errors.email">{{ form.errors.email }}</div>
    <input type="password" v-model="form.password">
    <div v-if="form.errors.password">{{ form.errors.password }}</div>
    <input type="checkbox" v-model="form.remember"> Remember Me
    <button type="submit" :disabled="form.processing">Login</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        email: null,
        password: null,
        remember: false,
      }),
    }
  },
}
</script>
</script>

---
## Authentication

---
## Authorization
<pre><code data-trim data-line-numbers="1-6|2-4">
return Inertia::render('Users/Index', [
    'can' => [
        'create_user' => Auth::user()->can('users.create'),
    ],
    'users' => User::all(),
]);
</code></pre>

---
## Hooks
<pre><code data-trim data-line-numbers="1-9|3-6|7-9">
import { Inertia } from '@inertiajs/inertia'

// create the listener
let eventListener = Inertia.on('start', (event) => {
    // do something
});

// Remove the listener
eventListener();
</code></pre>
---
## Testing
<section> 
    <pre><code data-trim data-line-numbers="1-15|5-13">
    public function test_can_view_organizations()
    {
        $this->actingAs($this->user)
            ->get('/organizations')
            ->assertInertia(fn ($assert) => $assert
                ->component('Organizations/Index')
                ->has('organizations.data.0', fn ($assert) => $assert
                    ->where('id', 1)
                    ->where('name', 'Apple')
                    ->where('phone', '647-943-4400')
                    ->where('city', 'Toronto')
                    ->where('deleted_at', null)
                )
            );
    }
    </code></pre>
</section>

---
## Server-side rendering

---
## Other features

* Partial reloads
* Scroll management
* CSRF protection
* Asset versioning
* Progress Indicators
* Remembering states
* And more...

---
## The protocol

---
## HTML Response
<pre><code data-trim data-line-numbers="1-3|5-7|8-19">
<script type="text/template">
REQUEST
GET: http://example.com/events/80
Accept: text/html, application/xhtml+xml

RESPONSE
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8
<html>
<head>
    <title>My app</title>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/app.js" defer />
</head>
<body>

<div id="app" data-page='{"component":"Event","props":{"event":{"id":80,"title":"Birthday party","start_date":"2019-06-02","description":"Come out and celebrate Jonathan&apos;s 36th birthday party!"}},"url":"/events/80","version":"c32b8e4965f418ad16eaebba1d4e960f"}'></div>

</body>
</html>
</script>
</code></pre>

---
## Inertia Response
<pre><code data-trim data-line-numbers="1-6|8-12|13-25">
<script type="text/template">
REQUEST
GET: http://example.com/events/80
Accept: text/html, application/xhtml+xml
X-Requested-With: XMLHttpRequest
X-Inertia: true
X-Inertia-Version: 6b16b94d7c51cbe5b1fa42aac98241d5

RESPONSE
HTTP/1.1 200 OK
Content-Type: application/json
Vary: Accept
X-Inertia: true
{
  "component": "Event",
  "props": {
    "event": {
      "id": 80,
      "title": "Birthday party",
      "start_date": "2019-06-02",
      "description": "Come out and celebrate Jonathan's 36th birthday party!"
    }
  },
  "url": "/events/80",
  "version": "c32b8e4965f418ad16eaebba1d4e960f"
}
</script>
</code></pre>

---
## The end

