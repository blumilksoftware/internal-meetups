<h2>Blumilk Internal Meetup #7</h2>
<h1>Cryptocurrencies</h1>
<img class="r-stretch" data-src="presentations/2021-06-30-cryptocurrencies/images/dogecoin.webp">
<p>Kamil Stefaniak 30.06.2021</p>

---
<section><h2>Why cryptocurrencies suck?</h2></section>
<section><h3>Ineffective</h3></section>
<section>
    <img class="r-stretch" data-src="presentations/2021-06-30-cryptocurrencies/images/energy.jpg">
</section>
<section>
    <p>Total transactions per second:</p>
<ol>
    <li>Visa: 24,000</li>
    <li>Ripple: 1,500</li>
    <li>PayPal: 193</li>
    <li>Bitcoin Cash: 60</li>
    <li>Litecoin: 56</li>
    <li>Dash: 48</li>
    <li>Ethereum: 20</li>
    <li>Bitcoin: 7</li>
</ol>
</section>
<section>
    <h3>Fragmentation</h3>
    <p>~4000 cryptocurrencies in January 2021</p>
    <p>~10000 cryptocurrencies in May 2021</p>
</section>
<section>
    <h3>Speculation</h3>
    <p>No real value</p>
    <p>Shitcoins and memecoins</p>
    <p>Pyramid schemes</p>
    <p>90% of Bitcoins have been mined; ~1000 people own 40%</p>
</section>
<section>
    <h3>No consumer security</h3>
    <p>Transactions cannot be undone</p>
    <p>Trust moved from traditional structures to tech companies</p>
    <p>Security failures</p>
    <p>Loss of funds</p>
</section>
<section>
    <h3>No large scale usage for Blockchain</h3>
    <ul>
        <li>an actual currency</li>
        <li>smart contracts</li>
        <li>interbank payments</li>
        <li>distributed storage, computing, and messaging</li>
        <li>authenticity verification</li>
    </ul>
</section>
---
<section><h2>Blockchain - under the hood</h2></section>
<section>
    <h3>Bluecoin</h3>
    <p>Let's start with dinner ledger</p>
    <table style="border: 1px solid black">
        <tr><td>Kamil pays Krzysiek 20 PLN</td></tr>
        <tr><td>Jacek pays Krzysiek 10 PLN</td></tr>
        <tr><td>Ewelina pays Krzysiek 30 PLN</td></tr>
        <tr><td>Krzysiek pays Piotrek 15 PLN</td></tr>
    </table>
    <p>At the end of the month we tally-up</p>
</section>
<section>
    <h3>Problem - signature</h3>
    <ul>
        <li>We must prevent adding lines without approval of the other party</li>
        <li>We need a signature that cannot be copied to other lines</li>
    </ul>
    <p style="text-align: left">Solution: public-key cryptography</p>
</section>
<section>
    <style>
      table,
      th,
      td {
        border: 1px solid black;
      }
    </style>
    <table>
        <tr>
            <td>1</td>
            <td>Kamil pays Krzysiek 20 PLN</td>
            <td>59445...</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Kamil pays Krzysiek 20 PLN</td>
            <td>b504a...</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Ewelina pays Krzysiek 30 PLN</td>
            <td>58013...</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Krzysiek pays Piotrek 15 PLN</td>
            <td>a49be...</td>
        </tr>
    </table>
</section>
<section>
    <h3>Problem - why should we tally-up</h3>
    <ul>
        <li>Possibility of owning a lot of money and not paying up</li>
        <li>We can eliminate this by introducing some funds at the beginning</li>
        <li>We must also control if no one is spending more than they have</li>
    </ul>
    <p style="text-align: left">Solution: inputs</p>
</section>
<section>
    <style>
      table,
      th,
      td {
        border: 1px solid black;
      }
    </style>
    <div class="r-fit-text">
    <table>
        <tr>
            <th>ID</th>
            <th>Transaction</th>
            <th>Hash</th>
            <th>Inputs</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Krzysiek receives 100 BC</td>
            <td>5f3f4...</td>
            <td>...</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Kamil receives 100 BC</td>
            <td>5bc22...</td>
            <td>...</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Jacek receives 100 BC</td>
            <td>33ae3..</td>
            <td>...</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Ewelina receives 100 BC</td>
            <td>1343f..</td>
            <td>...</td>
        </tr>
            <td>5</td>
            <td>Kamil pays Krzysiek 20 PLN</td>
            <td>59445...</td>
            <td>5bc22...</td>
        <tr>
            <td>6</td>
            <td>Jacek pays Krzysiek 10 PLN</td>
            <td>b504a...</td>
            <td>33ae3..</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Ewelina pays Krzysiek 30 PLN</td>
            <td>58013...</td>
            <td>1343f..</td>
        </tr>
        <tr>
            <td>8</td>
            <td>
                Krzysiek pays Piotrek 15 PLN</br>
                Krzysiek pays Krzysiek 15 PLN
            </td>
            <td>a49be...</td>
            <td>58013...</td>
        </tr>
    </table>
    </div>
</section>
<section>
    <h3>Problem - we want a decentralized ledger</h3>
    <ul>
        <li>We keep a copy of the ledger on each computer</li>
        <li>We must ensure that everybody agrees on the same ledger</li>
    </ul>
    <p style="text-align: left">Solution: blockchain and proof of work</p>
</section>
<section>
    <style>
      table,
      th,
      td {
        border: 1px solid black;
      }
    </style>
    <div class="r-fit-text">
    <table>
        <tr>
            <th>ID</th>
            <th>Transaction</th>
            <th>Hash</th>
            <th>Inputs</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Krzysiek receives 100 BC</td>
            <td>5f3f4...</td>
            <td>...</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Kamil receives 100 BC</td>
            <td>5bc22...</td>
            <td>...</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Jacek receives 100 BC</td>
            <td>33ae3..</td>
            <td>...</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Ewelina receives 100 BC</td>
            <td>1343f..</td>
            <td>...</td>
        </tr>
            <td>5</td>
            <td>Kamil pays Krzysiek 20 PLN</td>
            <td>59445...</td>
            <td>5bc22...</td>
        <tr>
            <td>6</td>
            <td>Jacek pays Krzysiek 10 PLN</td>
            <td>b504a...</td>
            <td>33ae3..</td>
        </tr>
        <tr>
            <td>7</td>
            <td>Ewelina pays Krzysiek 30 PLN</td>
            <td>58013...</td>
            <td>1343f..</td>
        </tr>
        <tr>
            <td>8</td>
            <td>
                Krzysiek pays Piotrek 15 PLN
                Krzysiek pays Krzysiek 15 PLN
            </td>
            <td>a49be...</td>
            <td>58013...</td>
        </tr>
        <tr>
            <th>Nonce: 938833</th>
            <th>Hash: c788f7782238e...</th>
            <th>Prev: ca355c435fedc...</th>
        </tr>
    </table>
    </div>
</section>
<section>
    <ul>
        <h3>Closing thoughts</h3>
        <li>Trust the longest blockchain</li>
        <li>Alternatives to proof of work - proof of stake, proof of capacity, proof of burn</li>
        <li>PoW needs to be getting harder as computing power grows</li>
        <li>Block rewards and fees</li>
        <li>No balance - computing from unsent inputs</li>
        <li>Key generation</li>
    </ul>
</section>
---
<h2>The end</h2>
<ul>
    <li><a href="https://www.youtube.com/watch?v=bBC-nXj3Ng4">But how does bitcoin actually work?</a></li>
    <li><a href="https://www.youtube.com/watch?v=_160oMzblY8">Blockchain 101</a></li>
    <li><a href="https://www.youtube.com/watch?v=Lx9zgZCMqXE">How Bitcoin Works Under the Hood</a></li>
    <li><a href="https://hackernoon.com/ten-years-in-nobody-has-come-up-with-a-use-case-for-blockchain-ee98c180100">Ten years in, nobody has come up with a use for blockchain</a></li>
    <li><a href="https://medium.com/@kaistinchcombe/decentralized-and-trustless-crypto-paradise-is-actually-a-medieval-hellhole-c1ca122efdec">Blockchain is not only crappy technology but a bad vision for the future</a></li>
    <li><a href="https://towardsdatascience.com/the-blockchain-scalability-problem-the-race-for-visa-like-transaction-speed-5cce48f9d44">The Blockchain Scalability Problem & the Race for Visa-Like Transaction Speed</a></li>
</ul>