# Laravel Nova
#### Beautifully designed administration panel for Laravel
\
\
\
Created by Ewelina Lasowy
---
## About me ;)

---
## About Laravel Nova
\
Laravel Nova is an automatically generated administration panel that is an addition to the Laravel framework.
---

# Pros

---
## Code Driven Configuration

---
## Pure application

---
## Writing custom components

---
## Resource management

---
## Actions

---
## Filters

---
## Lenses

---
## Metrics

---
## Custom Tools

---
## Authorization

---
## Custom Fields

---
## Scout Search Integration

---

# Cons

---
## Not free
<img data-src="presentations/2021-02-24-laravel-nova/images/pricing.png">

---
## Lack of CRUD generator in panel

---
## No export function

---

## Meme
<img data-src="presentations/2021-02-24-laravel-nova/images/cat-meme.jpg">

---
# Examples

---

## Default View
<img data-src="presentations/2021-02-24-laravel-nova/images/default-view.png">

---
## Create a resource
```php
php artisan nova:resource ResourceName
```
---

### List of posts 
<img data-src="presentations/2021-02-24-laravel-nova/images/list-of-posts.png">

---

### Fields method for Post model
<img data-src="presentations/2021-02-24-laravel-nova/images/fields-method.png">

---
### Create a post - view
<img data-src="presentations/2021-02-24-laravel-nova/images/create-post.png">

---
### Single post - view
<img data-src="presentations/2021-02-24-laravel-nova/images/single-post-view.png">

---

## Add Laravel Scout and Algolia
```php
composer require laravel/scout
php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
composer require algolia/algoliasearch-client-php
php artisan scout:import "App\Post"
```
---
### Global search
<img data-src="presentations/2021-02-24-laravel-nova/images/global-search.png">

---
### Title and subtitle methods
<img data-src="presentations/2021-02-24-laravel-nova/images/title-and-subtitle-method.png">

---
### Resource search
<img data-src="presentations/2021-02-24-laravel-nova/images/resource-search.png">

---

### Pagination options
<img data-src="presentations/2021-02-24-laravel-nova/images/links.png">
<img data-src="presentations/2021-02-24-laravel-nova/images/load-more.png">

---
##  Create a filter
```php
php artisan nova:filter FilterName
```
---
### PostCategories filter
<img data-src="presentations/2021-02-24-laravel-nova/images/post-categories-filter.png">

---
### Filters
<img data-src="presentations/2021-02-24-laravel-nova/images/filters.png">

---
## Create lens
```php
php artisan nova:lens LensName
```
---
### MostTags Lens
<img data-src="presentations/2021-02-24-laravel-nova/images/most-tags-lens.png">

---
### Lenses
<img data-src="presentations/2021-02-24-laravel-nova/images/lens.png">

---
### Lens - view
<img data-src="presentations/2021-02-24-laravel-nova/images/lens-view.png">

---
## Create an action
```php
php artisan nova:actions ActionName
```
---
### PublishPost Action
<img data-src="presentations/2021-02-24-laravel-nova/images/publish-post-action.png">

---
### Actions method in Post model
<img data-src="presentations/2021-02-24-laravel-nova/images/actions-method.png">

---
## Create metrics
```php
php artisan nova:value MetricName
```
```php
php artisan nova:trend MetricName
```
```php
php artisan nova:partition MetricName
```

---
### Average number of posts
<img data-src="presentations/2021-02-24-laravel-nova/images/post-average-metric.png">

---
### Posts per category
<img data-src="presentations/2021-02-24-laravel-nova/images/posts-per-category.png">

---

### Metrics - view
<img data-src="presentations/2021-02-24-laravel-nova/images/metrics-view.png">

---

## Nova Packages
<img data-src="presentations/2021-02-24-laravel-nova/images/nova-packages.png">

---
## Summary

---
# The End

