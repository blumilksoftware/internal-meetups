## Blumilk Internal meetup X
<br>
<strong>Bezpieczeństwo aplikacji internetowych</strong>
<br><br>
<small><br>Krzysztof Rewak, 15 września 2021<br><br></small>
<br>
<img src="presentations/2021-09-15-web-security/images/blumilk.jpg" width="100px" alt="[logo Blumilk]">

---

### SQL Injection

---

<section>
<img src="presentations/2021-09-15-web-security/images/index.png"  alt="[formularz logowania]">
</section>

<section>
  <pre><code data-trim data-noescape>
cd ./examples/sql
docker-compose up -d
docker-compose run php php index.migrate.php 
firefox localhost:2667
  </code></pre>
</section>

<section>
dlaczego
<h3>password' OR 1=1 --</h3>
jako hasło pozwala nam wejść do systemu?
</section>

<section>
normalnie zalogowalibyśmy się jakoś tak:<br><br>
<h4>SELECT name, password FROM users</h4>
<h3>WHERE name='admin'</h3>
<h3>AND password='admin'</h3>
</section>

<section>
ale przecież nie znamy hasła
</section>

<section>
i stąd musimy trochę kombinować
</section>

<section>
musimy znaleźć coś, co będzie pasowało tutaj:<br><br>
<h4>SELECT name, password FROM users</h4>
<h3>WHERE name='admin'</h3>
<h3>AND password='<span style="color:red">admin</span>'</h3>
</section>

<section>
samo 1=1 nie wystarczy:<br><br>
<h4>SELECT name, password FROM users</h4>
<h3>WHERE name='admin'</h3>
<h3>AND password='<span style="color:purple">OR 1=1</span>'</h3>
</section>

<section>
cała magia polega na wyłamaniu się ze stringa:<br><br>
<h3>AND password='<span style="color:purple">OR 1=1</span>'</h3>
</section>

<section>
cała magia polega na wyłamaniu się ze stringa:<br><br>
<h3>AND password='<span style="color:green">password' OR 1=1 --</span>'</h3>
</section>

<section>
szukamy hasła LUB sprawdzamy czy 1=1, a resztę komentujemy:<br><br>
<h3>AND password='<span style="color:green">password' OR 1=1 --</span>'</h3>
</section>

---

<section>
<img src="presentations/2021-09-15-web-security/images/bobby.png"  alt="Little Bobby Tables">
</section>

<section>
<img src="presentations/2021-09-15-web-security/images/bobbyform.png"  alt="Little Bobby Tables">
</section>

<section>
  <pre><code data-trim data-noescape>
cd ./examples/sql
docker-compose up -d
docker-compose run php php bobby.migrate.php 
firefox localhost:2667/bobby.php
  </code></pre>
</section>

<section>
widać, że stało się coś złego:<br><br>

<pre><code>
INSERT INTO students(id, name, surname)
VALUES(7, 'Robert'); DROP TABLE students;--', 'Lewandowski')

</code></pre>
</section>

<section>
zmiana parametrów pomogła:<br><br>

<pre><code>
INSERT INTO students(id, name, surname)
VALUES(7, 'Robert', 'Robert'); DROP TABLE students;--')

</code></pre>
</section>

---

<section>
<h3>Co dalej?</h3>
</section>

<section>
możemy spróbować wykorzystać naszą znajomość SQL:
</section>

<section>
  <pre><code data-trim data-noescape>
cd ./examples/sql
docker-compose up -d
docker-compose run php php database.migrate.php 
firefox localhost:2667/database.php
  </code></pre>
</section>

<section>
krok po kroku, wykorzystując UNIONY i zagnieżdżone SELECTY, możemy wybrać naprawdę dużo danych
</section>

---

<section>
<h3>XSS</h3>
<h4>cross-site scripting</h4>
</section>

<section>
tak naprawdę slajd z wykorzystaniem pola UNION już był przykładem ataku XSS
</section>

<section>
chodzi o to, aby znaleźć miejsce w którym ewidentnie ktoś bezrefleksyjnie przepisuje na frontend coś z formularza lub adresu URL
</section>

<section>
<img src="presentations/2021-09-15-web-security/images/xss.png"  alt="Cześć, Krzysztof!">
</section>

<section>
<img src="presentations/2021-09-15-web-security/images/dupa.png"  alt="alert('dupa')">
</section>

<section>
  <pre><code data-trim data-noescape>
cd ./examples/sql
docker-compose up -d
firefox localhost:2667/xss.php
  </code></pre>
</section>

---

<section>
<h3>a może coś bardziej wyszukanego?</h3>
</section>

<section>
<h3>na stronie X możemy znaleźć podatność XSS</h3>
<h5>(linka nie podam w prezentacji, żeby nikt mi nie uciął głowy)</h5>
</section>

<section>
<h3>co ciekawe, nie jest ona widoczna na pierwszy rzut oka</h3>
<h4>ale można ją wyczaić w źródle strony</h4>
</section>

<section>
<h4>dopisanie</h4>
<h3>&lt;script>alert(1)&lt;/script></h3>
<h4>działa tak jak chcemy</h4>
</section>

<section>
<h4>ale już</h4>
<h3>&lt;script>alert("dupa")&lt;/script></h3>
<h4>nie bardzo</h4>
</section>

<section>
<h3>ktoś jako tako zabezpieczył stronę przed takimi jak ja...</h3>
</section>

<section>
<h3>...ale bardzo dużo rzeczy można sprytnie obejść</h3>
</section>

<section>
<h3>skoro cudzysłowia są escapowane, można spróbować użyć atrybutu src tagu &lt;script></h3>
</section>

<section>
<h4>oczywiście napisanie "dupa" jest śmieszne,</h4>
<h3>ale co można byłoby zrobić ciekawszego?</h3>
</section>

<section>
<h3>można wstrzyknąć złośliwy redirect</h3>
</section>

<section>
<h3>albo śledzące oprogramowanie</h3>
</section>

<section>
<h3>albo redirect ze śledzącym oprogramowaniem</h3>
</section>

<section>
<h3>(strach się bać)</h3>
</section>

---

<section>
<h3>jak z tym walczyć?</h3>
</section>

<section>
<h3>prawda jest taka, że SQL Injection</h3>
<h2>dzięki frameworkom i ORM</h2>
<h3>to już w dużej mierze problem historyczny</h3>
</section>

<section>
<h3>przykładowo Laravel</h3>
<h2>większość rzeczy robi za nas</h2>
<h3>(sanityzację danych, bindowanie parametrów)</h3>
</section>

<section>
<h3>podobnie jest z XSS czy CSRF</h3>
<h2>gdzie Laravel nas ratuje w zasadzie automatycznie</h2>
</section>

<section>
<h3>czy można zrobić lipę takiej rangi korzystając z frameworka?</h3>
</section>

<section>
<h2>oczywiście!</h2>
</section>

<section>
<h3>grunt to mieć świadomość istnienia problemów</h3>
</section>

<section>
<h3>oraz korzystanie z frameworka zgodnie z jego przeznaczeniem</h3>
</section>

---

# Dziękuję