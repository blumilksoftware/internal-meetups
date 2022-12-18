<style>
.text-small { font-size: .8em; }
</style>

### Blumilk Internal meetup XXIV
<br>
<strong>Scrapowanie internetu (ale sensownie)</strong>
<small><br>Krzysztof Rewak, 19 grudnia 2022</small>
<br>
<img src="presentations/2022-12-19-webscrapping/images/blumilk.jpg" width="120px" alt="[logo Blumilk]">

---
<img src="presentations/2022-12-19-webscrapping/images/bdd0kylwwsk81.webp">

---

<section>
To może najpierw: co byłoby niesensownym scrapowaniem?
</section>

<section>
<img src="presentations/2022-12-19-webscrapping/images/jp2.png">
</section>

<section>
Dzisiaj chciałem opowiedzieć o czymś bardziej:

<li class="fragment">przewidywalnym</li>
<li class="fragment">powtarzalnym</li>
<li class="fragment">testowalnym</li>
<li class="fragment">naprawialnym</li>
</section>

---

<section>

## Co będziemy w takim razie scrapować?

</section>

<section>

<img src="presentations/2022-12-19-webscrapping/images/historiapojazdu.png">

</section>

<section>

## Potrzebne biblioteki

<small>Istnieją takie rozwiązania jak Goutte, ale dzisiaj chciałbym opowiedzieć o czymś ekstremalnie prostym:</small>

    "require": {
        "php": "^8.1",
        "ext-dom": "*",
        "behat/behat": "^3.10",
        "guzzlehttp/guzzle": "^7.4.2",
        "laravel/framework": "^9.10.0",
        "symfony/dom-crawler": "^6.0"
    },

</section>

<section class="text-small">

## Kod

    class VehicleHistoryController extends Controller
    {
        public function __invoke(
            VehicleHistoryRequest $request,
            VehicleHistoryRetriever $vehicleHistoryRetriever,
            ResponseFactory $responseFactory
        ): JsonResponse
        {
            $vehicleHistory = $vehicleHistoryRetriever->retrieve(
                $request->get("requestId"),
                $request->vin,
                $request->registrationNumber,
                $request->firstRegistrationDate,
            );
        
            return $responseFactory->json($vehicleHistory);
        }
    }

</section>

<section>

### I to w zasadzie tyle
#### do pokazania w prezentacji <!-- .element: class="fragment" -->

</section>

---

## live coding!

---

# Dziękuję

I zapraszam na losowanie! <!-- .element: class="fragment" -->