## Blumilk Internal Meetup #4

\
<img width="400" data-src="presentations/2021-03-19-rubixml/images/logo.png">
\
\
\
Magdalena Bukowska 19.03.2021

---

## Machine Learning

\
<img width="450" data-src="presentations/2021-03-19-rubixml/images/artificial-inteligence.png">

---

## RubixML

\
A high-level machine learning and deep learning library for PHP.

---

## Why was it created?

<q>Because, Machine Learning is arguably the most important technology of our present time. The ability to program with
data has changed the way applications are built and I don't want PHP engineers to be left behind.</q>
\
*- Andrew DalPino*

---

## Installation

<br/><br/>
Install The Package with Composer
<section>
  <pre><code data-trim>
composer require rubix/ml
  </code></pre>
</section>

---

## System architecture

\
<img width="600" data-src="presentations/2021-03-19-rubixml/images/architecture.png">

---

## Representing data

<br/>
A dataset is made up of a matrix of samples comprised of features which are usually scalar values.
<br/>
<section>
  <pre><code data-trim>
    $samples = [
        [0.1,  21.5, 'furry'],
        [2.0,    -5, 'rough'],
        [0.001, -10, 'rough'],
    ];
  </code></pre>
</section>

---

## Dataset object

<br/><br/>
<section>
  <pre><code data-trim data-noescape data-line-numbers="1-6|8-9">
    use Rubix\ML\Datasets\Labeled;
</br>
    $samples = [
        [0.1, 20, 'furry'],
        [2.0, -5, 'rough'],
    ];
</br>
    $labels = ['not monster', 'monster'];
    $dataset = new Labeled($samples, $labels);
  </code></pre>
</section>

---

## Estimator

<section>
  <pre><code data-trim>
    $predictions = $estimator->predict($dataset);
  </code></pre>
</section>
---

## Supervised learning

\
\
<img width="600" data-src="presentations/2021-03-19-rubixml/images/estimator-supervised.png">

---

## Unsupervised learning

\
\
<img width="600" data-src="presentations/2021-03-19-rubixml/images/estimator-unsupervised.png">

---

## Training

<section>
  <pre><code data-trim>
    $estimator->train($dataset);
  </code></pre>
</section>

---

## Model evaluation

<br/><br/>
<section>
  <pre><code data-trim data-noescape data-line-numbers="1-6|8-9">
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
</br>
$dataset = new Labeled($samples, $labels);
</br>
$score = $validator->test($estimator, $dataset, new Accuracy());
</code></pre>
</section>
---

## Advantages

- Developer-friendly
- 40+ Learning algorithms
- Open source

---

## Ecosystem

- Tensor
- Server
- Extras - experimental libraries

---

## Sentiment

<img width="400" data-src="presentations/2021-03-19-rubixml/images/sentiment.png">

---

## Sentiment training...

<img width="800" data-src="presentations/2021-03-19-rubixml/images/train.png">

---

## Other projects

https://github.com/RubixML

---

## PHP vs Python

---

## RubixML vs PHP-ML

\
https://arkadiuszkondas.com/dmca-php-ml-and-copyright-boundaries/
---

## Summary

---

# The End

