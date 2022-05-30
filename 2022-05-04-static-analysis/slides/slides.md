<h2>Static Analysis</h2>

<img style="height: 10em" data-src="presentations/2022-05-04-static-analysis/images/watches.jpg">

<p>Jacek Sawoszczuk 04.05.2022</p>

---

## Static Analysis

Static Analysis is the automated analysis of source code without executing the application.

---

<h3>Static <br> vs <br> Dynamic Analysis</h3>

---

## Compiler

1. Tokenizer (tokens)
1. Lexer (tokens+)
1. Parser (AST)
1. Compiler

---

## Tokeniser / Lexer

Source ⇒ Tokens

---

## PARSER

Tokens ⇒ AST

---

## AST

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/AST-1.png">

---

#### Tools

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/tools.jpg">

---

#### Tools

<ol>
<li style="font-size: 60%;">builtin</li>
<li style="font-size: 60%;">Jetbrains</li>
<li style="font-size: 60%;">PHP CS / Code Sniffer</li>
<li style="font-size: 60%;">PHP Depend</li>
<li style="font-size: 60%;">PHP Mess Detector</li>
<li style="font-size: 60%;">PHP Checkstyle</li>
<li style="font-size: 60%;">PHP CS Fixer</li>
<li style="font-size: 60%;">PHP Code Sniffer</li>
<li style="font-size: 60%;">ECS</li>
<li style="font-size: 60%;">Rector</li>
<li style="font-size: 60%;">Psalm</li>
<li style="font-size: 60%;">PHPStan / Larastan</li>
<li style="font-size: 60%;">Enlightn</li>
<li style="font-size: 60%;">PHP Insights</li>
<li style="font-size: 60%;">Deptrac</li>
<li style="font-size: 60%;">PhpAT</li>
<li style="font-size: 60%;">Nocolor</li>
<li style="font-size: 60%;">Sonar</li>
</ol>

---

## Builtin

- `php -l file.php`
- `php --syntax-check file.php`

---

## Jetbrains

- syntax highlighting
- code-completion
- Alt-7 / View:Tool Windows:Structure
- Analyze DataFlow - `$var` → Code:Analyze Code:Data Flow to here/from here
- Settings:Editor:Inspections
- builtin refactoring (variable/method rename)
- RMB on `Models` → Diagrams:Show Diagram

---

## PHP CS / Code Sniffer

- https://github.com/squizlabs/PHP_CodeSniffer
- Stats: 🌟 9,300 / 🍴 1,400 / 🔭 199 / 👶 148,349
- Commits: 09-2006 - 04-2022
- Releases: 09-2013 - 12-2021

---

## PHP Depend

- https://github.com/pdepend/pdepend
- Stats: 🌟 789 / 🍴 127 / 🔭 21 / 👶 17,701
- Commits: 02-2008 - 04-2022
- Releases: 12-2017 - 02-2022

---

## PHP Mess Detector

- https://github.com/phpmd/phpmd
- Stats: 🌟 2,000 / 🍴 345 / 🔭 53 / 👶 -
- Commits: 01-2009 - 04-2022
- Releases: 07-2019 - 03-2022

---

## PHP Checkstyle

- https://github.com/PHPCheckstyle/phpcheckstyle
- Stats: 🌟 153 / 🍴 30 / 🔭 15 / 👶 -
- Commits: 01-2011 - 11-2019
- Releases: 03-2014 - 06-2018

---

## PHP CS Fixer

- https://github.com/FriendsOfPhp/PHP-CS-Fixer
- Stats: 🌟 11,000 / 🍴 1,400 / 🔭 218 / 👶 68,817
- Commits: 05-2012 - 03-2022
- Releases: 05-2015 - 03-2022

---

## ECS

- https://github.com/symplify/easy-coding-standard

---

## Rector

- https://github.com/rectorphp/rector
- Stats: 🌟 5,200 / 🍴 487 / 🔭 66 / 👶 2,800
- Commits: 07-2017 - 05-2022
- Releases: 11-2020 - 05-2022

---

## Psalm

- https://github.com/vimeo/psalm
- Stats: 🌟 4,700 / 🍴 523 / 🔭 65 / 👶 12,141
- Commits: 01-2016 - 04-2022
- Releases: 11-2016 - 05-2022

---

## Taint Analysis

`eval($_GET["code"]);`

---

## PHPStan / Larastan

- https://github.com/phpstan/phpstan
- Stats: 🌟 11,000 / 🍴 781 / 🔭 175 / 👶 39,100
- Commits: 01-2016 - 05-2022
- Releases: 07-2016 - 05-2022

---

## Enlightn

- https://github.com/enlightn/enlightn
- Stats: 🌟 649 / 🍴 39 / 🔭 11 / 👶 224
- Commits: 12-2020 - 04-2022
- Releases: 01-2021 - 02-2022

---

## PHP Insights

- https://github.com/nunomaduro/phpinsights
- Stats: 🌟 4,600 / 🍴 237 / 🔭 73 / 👶 1,513
- Commits: 03-2019 - 05-2022
- Releases: 02-2020 - 05-2022

---

## Architecture testing

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/water-mill.jpg">

---

## Architecture testing

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/arch_layered.png">

---

## Architecture testing

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/arch_mvc.png">

---

## Architecture testing

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/arch_monorepos.png">

---

## Deptrac

- https://github.com/qossmic/deptrac
- Stats: 🌟 1,900 / 🍴 90 / 🔭 43 / 👶 4
- Commits: 04-2016 - 05-2022
- Releases: 03-2018 - 01-2022

---

## PhpAT

- https://github.com/carlosas/phpat
- Stats: 🌟 679 / 🍴 24 / 🔭 18 / 👶 -
- Commits: 07-2019 - 05-2022
- Releases: 09-2019 - 05-2022

---

## Nocolor

- https://github.com/VKCOM/nocolor
- Stats: 🌟 133 / 🍴 2 / 🔭 8 / 👶 -
- Commits: 05-2021 - 08-2022
- Releases: 06-2021 - 08-2022

---

## Sonar

- SonarQube
- SonarLint

---

DIY

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/circular-bike.jpg">

---

## Tokenizer: DIY

```php
<?php
	$allTokens = PhpToken::tokenize($source);
	$print_r($allTokens);
```

uses `ext-tokenizer`

---

## AST: DIY

```php
<?php
  $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
  try {
    $ast = $parser->parse($source);
  } catch (Error $error) {
    echo "Parse error: {$error->getMessage()}\n";
    return;
  }
```

uses `nikic/PHP-Parser`

---

### Other SA tools

<ul>
 <li style="font-size: 60%;">Copy/Paste Detector <a href="">https://github.com/sebastianbergmann/phpcpd</a></li>
 <li style="font-size: 60%;">Magid Number Detector <a href="">https://github.com/povils/phpmnd</a></li>
 <li style="font-size: 60%;">PHP Metrics <a href="">https://github.com/phpmetrics/phpmetrics</a></li>
 <li style="font-size: 60%;">PHPLOC <a href="">https://github.com/sebastianbergmann/phploc</a></li>
 <li style="font-size: 60%;">PhpDeprecationDetector <a href="">https://github.com/wapmorgan/PhpDeprecationDetector</a></li>
 <li style="font-size: 60%;">PHP Coupling Detector <a href="">https://github.com/akeneo/php-coupling-detector</a></li>
 <li style="font-size: 60%;">noverify - <a href="">https://github.com/VKCOM/noverify</a></li>
 <li style="font-size: 60%;">phan - <a href="">https://github.com/phan/phan</a></li>
 <li style="font-size: 60%;">Codescene - <a href="">https://codescene.com</a></li>
 <li style="font-size: 60%;">Scrutinizer - <a href="">https://scrutinizer-ci.com</a></li>
</ul>

---

### Other SA Repos

<ul>
 <li style="font-size: 60%;">PHP-Parser <a href="">https://github.com/nikic/php-ast</a></li>
 <li style="font-size: 60%;">php-ast <a href="">https://github.com/nikic/PHP-Parser</a></li>
 <li style="font-size: 60%;">tolerant-php-parser <a href="">https://github.com/Microsoft/tolerant-php-parser</a></li>
 <li style="font-size: 60%;">php-8-stubs <a href="">https://github.com/phpstan/php-8-stubs</a></li>
</ul>

---

## Summary

1. coding standard tool (like PHP-CS-Fixer)
1. static analyzer (like PSPStan / Psalm)
1. Rector

---

## Summary

1. coding standard tool (PHP-CS-Fixer)
1. static analyzer (PSPStan / Psalm)
1. **architecture testing (Deptrac / PhpAT)**
1. Rector

---

## [put meme here]

<img class="r-stretch" data-src="presentations/2022-05-04-static-analysis/images/bald-soup-1600.jpg">

---

# Fin.
