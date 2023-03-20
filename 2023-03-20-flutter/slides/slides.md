
### Blumilk Internal Meetup #26
<br>
<img data-src="presentations/2023-03-20-flutter/images/logo.png" width="500px">
<br>
<br>
<p>Mateusz Lencki, 20.02.2023</p>

---

<section>

## What's this?

<q>
    Flutter is an open source framework by Google for building beautiful, <strong>natively compiled</strong>, <strong>multi-platform</strong> applications from a <strong>single codebase</strong>.
</q>

</section>

<section>

#### Multi-platform applications

<img style="height: 11em" data-src="presentations/2023-03-20-flutter/images/multiplatform.webp">

<section>

---

<section>

<img style="height: 5em" data-src="presentations/2023-03-20-flutter/images/dart.png">

</section>


<section>

<q>
    Dart is a client-optimized language for developing fast apps on any platform. Its goal is to offer the most productive programming language for multi-platform development, paired with a flexible execution runtime platform for app frameworks.
</q>

</section>

<section>

#### Brief history

- Developed by Google
- First appeared in 2011
- Dart 1.0 released in 2013
- Dart 2.0 released in 2018
- Intended to be a Javascript alternative for web
- Gained popularity with Flutter
- Developed in <a href="https://github.com/dart-lang">open-source</a>

</section>

<section>

Multi-platform

<img style="height: 11em" data-src="presentations/2023-03-20-flutter/images/platforms.svg">

</section>


<section>

Just-In-Time compiled

<img style="height: 11em" data-src="presentations/2023-03-20-flutter/images/jit.gif">

</section>

<section>

Type safe

</section>

<section>

Explicit type

<img style="height: 7em" data-src="presentations/2023-03-20-flutter/images/explicit-type.png">

</section>

<section>

Inferred type

<img style="height: 7em" data-src="presentations/2023-03-20-flutter/images/inferred-type.png">

</section>

<section>

Flexible type

<img style="height: 7em" data-src="presentations/2023-03-20-flutter/images/flexible-type.png">

</section>

<section>

Null safety

<img style="height: 7em" data-src="presentations/2023-03-20-flutter/images/null-safety.png">

</section>

<section>

<img style="height: 11em" data-src="presentations/2023-03-20-flutter/images/meme-1.png">

</section>

<section>

Every program starts with main() function

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/main.png">

</section>

<section>

Everything is object...

<img style="height:10em" data-src="presentations/2023-03-20-flutter/images/everything-is-object.png">

</section>

<section>

...almost everything

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/null.png">

</section>

<section>

Multi-Paradigm

</section>

<section>

Functions are objects

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/callback.png">

</section>

<section>

Objects are objects

<img style="height:12em" data-src="presentations/2023-03-20-flutter/images/class.png">

</section>

<section>

Implicit interfaces

<img style="height:12em" data-src="presentations/2023-03-20-flutter/images/interfaces.png">

</section>

<section>

Access Modifiers

<img style="height:12em" data-src="presentations/2023-03-20-flutter/images/access-modifiers.png">

</section>

<section>

Asynchronous programming

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/async.png">

</section>
---

<section>

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/back-to-the-flutter.png">

</section>

---

<section>

Project structure

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/project-structure.png">

</section>

<section>

<strong>lib</strong> - contains .dart files with application code 

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/project-structure-2.png">

</section>

<section>

<strong>android</strong> - platform-specific folder, contains an Android project which builds and runs the project

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/project-structure-3.png">

</section>

<section>

<strong>ios</strong> - platform-specific folder, contains an IOS project which builds and runs the project

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/project-structure-4.png">

</section>

<section>

<strong>pubspec.yaml & pubspec.lock</strong> - contains project's settings and dependencies

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/project-structure-5.png">

</section>

<section>

pubspec.yaml

<img style="height:12em" data-src="presentations/2023-03-20-flutter/images/pubspec.png">

</section>

<section>

<a href="https://pub.dev/">pub.dev</a>

</section>

<section>

<strong>analysis-options.yaml</strong> - contains project's settings and dependencies

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/project-structure-6.png">

</section>

<section>

analysis-options.yaml

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/analysis-options.png">

</section>

<section>

<a href="https://dart.dev/tools/linter-rules">Linter rules</a>

</section>
---

<section>

Widget tree

<img style="height:10em" data-src="presentations/2023-03-20-flutter/images/widget-tree.gif">

</section>

<section>

#### Everything is a widget
<img style="height:11em" data-src="presentations/2023-03-20-flutter/images/widget-catalog.png">
<br>
<a href="https://docs.flutter.dev/development/ui/widgets">Widget catalog</a>
<br>
<br>
</section>

<section>
 A little bit of live coding

<img style="height:11em" data-src="presentations/2023-03-20-flutter/images/rezus-live-coding.gif">

<section>

---

<section>

Navigator

</section>

<section>

Navigation stack

<img style="height:12em" data-src="presentations/2023-03-20-flutter/images/navigation-stack.png">

</section>

<section>

Push

<img style="height:9em" data-src="presentations/2023-03-20-flutter/images/navigation-push.png">

</section>

<section>

Pop

<img style="height:9em" data-src="presentations/2023-03-20-flutter/images/navigation-pop.png">

</section>

<section>

Push replacement

<img style="height:9em" data-src="presentations/2023-03-20-flutter/images/navigation-push-replacement.png">

</section>

<section>

Routes

<img style="height:9em" data-src="presentations/2023-03-20-flutter/images/navigation-routes.png">

</section>

<section>

Push named

<img style="height:9em" data-src="presentations/2023-03-20-flutter/images/navigation-push-named.png">

</section>

---

<section>

Cool packages

<img style="height:9em" data-src="presentations/2023-03-20-flutter/images/packages.png">

</section>

<section>

<a href="https://pub.dev/packages/go_router">go_router</a>

A declarative routing package for Flutter

</section>

<section>

Parsing path and query parameters using a template syntax (for example, "user/:id')

</section>

<section>

Displaying multiple screens for a destination (sub-routes)

</section>

<section>

Redirection support - you can re-route the user to a different URL based on application state, for example to a sign-in when the user is not authenticated

</section>

<section>

Support for multiple Navigators via ShellRoute - you can display an inner Navigator that displays its own pages based on the matched route. For example, to display a BottomNavigationBar that stays visible at the bottom of the screen

</section>

<section>

<img style="height:14em" data-src="presentations/2023-03-20-flutter/images/go-router.png">

</section>

<section>

<img style="height:4em" data-src="presentations/2023-03-20-flutter/images/go-router-go.png">

</section>

<section>

<a href="https://pub.dev/packages/get_it">get_it</a>

Simple Service Locator for Dart and Flutter projects

</section>

<section>

<img style="height:5em" data-src="presentations/2023-03-20-flutter/images/get-it.png">

</section>

<section>

<a href="https://pub.dev/packages/provider">provider</a>

</section>

<section>

<a href="https://www.patterns.dev/posts/provider-pattern">Provider pattern</a>

</section>

<section>

Define provider model

<img style="height:12em" data-src="presentations/2023-03-20-flutter/images/provider-1.png">

</section>

<section>

Register provider within the widget tree

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/provider-2.png">

</section>

<section>

Use provider in widget

<img style="height:8em" data-src="presentations/2023-03-20-flutter/images/provider-3.png">

</section>

<section>

The end

</section>

---




