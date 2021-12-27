
<h3>Blumilk Internal Meetup #12</h3>
<h2>Crypto<span class="fragment highlight-red strike">currencies</span><span class="fragment fade-in">graphy</span></h2>
<img class="r-stretch" data-src="presentations/2021-11-17-cryptography/images/cover.png">
<p>Kamil Stefaniak 17.11.2021</p>

---

<section>
    <h2>Red queen race</h2>
</section>
<section>
    <p>"Now, here, you see, it takes all the running you can do, to keep in the same place."</p>
    <p style="text-align:right;"><small><span style="font-style: italic">"Through the Looking-Glass"</span> by Lewis Carroll</small></p>
</section>
<section>
    <h3>Is perfect security possible?</h3>
    <ul class="r-fit-text">
        <li>Information-theoretic security - derived from information theory, the system cannot be broken even with unlimited computing power</li>
        <li>Perfect security - one time pad with password:
            <ul>
                <li>at least as long as the message</li>
                <li>generated by true random number generator</li>
                <li>never reused, even in part (if reused just once, it becomes a running key cipher - and both messages can be decoded outright if written in natural language)</li>
                <li>kept secret</li>
            </ul>
        </li>
        <li>Impractical - if you have a secure way to exchange such long keys, you can use it to transmit the message as well</li>
    </ul>
</section>    
<section>
    <h4>Stream cipher</h4>
        <ul class="r-fit-text">
            <li>More practical application of OTP</li>
            <li>Replaces random key with pseudorandom generator - we only need to exchange the seed</li>
            <li>Stops being perfectly secure; actually block ciphers are more secure</li>
        </ul>
</section>
<section>
    <h3>WEP</h3>
    <ul class="r-fit-text">
        <li>Stream cipher</li>
        <li>Flawed from the start, but adequate at the time (no security inside the network; initially, 10 or 26 digit hexadecimal password was required)</li>
        <li>It's possible to force the same seed to be reused - every 16M frames the IV cycles back</li>
        <li>RC4 is susceptible to related seeds - cycling IV produced non-random, related seeds and deciphering the key was possible after 1M frames (later 40k frames)</li>
    </ul>
    <img class="r-stretch" data-src="presentations/2021-11-17-cryptography/images/wep.png">
</section>
<section>
    <ul class="r-fit-text">
        <li>November 16th - still used by 4,38% of networks</li>
        <li>RC4 was used until TLS 1.3 (2018) for backwards compatibility</li>
        <img class="r-stretch" data-src="presentations/2021-11-17-cryptography/images/wifi.png">
    </ul>
</section>
<section>
    <h3>Never-ending story</h3>
    <ul class="r-fit-text">
        <li>WPA/TKIP (improvement, but still uses underlying WEP mechanisms like RC4)</li>
        <li>WPA2/AES-CCMP (TKIP still supported) - KRACK attack exploits a weakness in the 802.11i standard itself, making it possible to decipher packets</li>
        <li>WPA3...</li>
        <li>SSL 2.0 -> SSL 3.0 -> TLS 1.0 -> TLS 1.1 -> TLS 1.2 (not deprecated yet) -> TLS 1.3 (prohibits SSL or RC4 for backwards compatibility)</li>
    </ul>
</section>
<section>
    <ul class="r-fit-text">
        <li>md5 -> SHA1 -> SHA2 -> SHA3 (never use them for password storage!)</li>
        <li>DES / 3DES - not cracked, but small effective key length and block sizes, hence deprecated by the NIST since 2017 for new applications and for all applications by 2023</li>
        <li>RSA - ever-growing key length (current NIST recommendation is 2048)</li>
        <img class="r-stretch" data-src="presentations/2021-11-17-cryptography/images/rsa.webp">
        <li>Post-quantum cryptography
            <ul>
                <li>Symmetrical cryptography is largely safe; Grover's algorithm requires doubling the key lengths</li>
                <li>All asymmetric algorithms that rely on the integer factorization problem, the discrete logarithm problem or the elliptic-curve discrete logarithm problem can be made obsolete by Shor's algorithm (as of now, the factorization of 21 was achieved)</li>
                <li>Many PQC algorithms are developed</li>
                <li>Quantum key distribution - one time pad possible</li>
            </ul>
        </li>
    </ul>
</section>

---

<section>
    <h2>What can we do?</h2>
</section>
<section>
    <h3>Basic steps</h3>
    <ul class="r-fit-text">
        <li>Don't use deprecated, vulnerable algorithms and protocols</li>
        <li>Use available, open-source standards - don't implement your own cryptography</li>
        <li>Kerchoof's principle: <span style="font-style: italic">"A cryptosystem should be secure even if everything about the system, except the key, is public knowledge"</span></li>
        <li>Implement and use the tools correctly</li>
        <li>Human as the weakest link - force safe passwords (check against blacklists, absolute minimum of 8 characters, maximum of at least 64) and 2FA</li>
    </ul>
</section>
<section>
    <h3>General guidelines</h3>
    <ul class="r-fit-text">
        <li>AES (and all symmetric keys) - at least 112 bits; 128 bits in 2031 - why not 256 bits?</li>
        <li>RSA - 2048 bits (3072 bits in 2031)</li>
        <li>TLS 1.3</li>
        <li>SHA3 (though SHA2 is not yet broken)</li>
        <li>PBKDF2 - don't use password as encryption key, they are not random</li>
        <li>bcrypt or Argon2 for password hashing</li>
        <li>ECC - same level as RSA, but shorter keys (a 256 bit key is relatively the same strength as a 3072 bit RSA key)</li>
    </ul>
</section>
<section>
    <h3>PHP</h3>
    <ul class="r-fit-text">
        <li>Since 7.2 PHP has a modern cryptography library in its core (libsodium) - don't use openssl (if possible), hash or mcrypt (deprecated)</li>
        <li><code>$hash = password_hash($password, PASSWORD_DEFAULT/PASSWORD_ARGON2ID)</code> - default is bcrypt (password maximum length of 72 characters)</li>
        <li><code>password_verify($password, $hash)</code></li>
        <li>Use JWT tokens carefully - verify that the library is secure and don't use them for session storage</li>
        <li>Don't use <code>rand()</code> and <code>mt_rand()</code> if cryptographically secure pseudo-random values are needed - use <code>random_int()</code> or <code>random_bytes()</code> instead</li>
        <li>Laravel - still uses openssl and AES-256-CBC (AES-256-GCM being more modern and secure, TLS 1.3 dropped support for CBC)</li>
    </ul>
</section>

---

<section>

</section>
<section>
    <img class="r-stretch" data-src="presentations/2021-11-17-cryptography/images/cat1.jpg">
</section>
<section>
    <img class="r-stretch" data-src="presentations/2021-11-17-cryptography/images/cat2.jpg">
</section>
<section>
    <img class="r-stretch" data-src="presentations/2021-11-17-cryptography/images/cat3.jpg">
</section>

---

<h2>Further information</h2>
<ul class="r-fit-text">
    <li><a href="https://www.youtube.com/watch?v=KcjJ19geKmA">DPC2018: Cryptography For Beginners - Adam Englander</a></li>
    <li><a href="https://www.youtube.com/watch?v=NuyzuNBFWxQ">7 Cryptography Concepts EVERY Developer Should Know</a></li>
    <li><a href="https://www.youtube.com/watch?v=j_8PLI_wCVU">Cryptography Full Course Part 1</a></li>
    <li><a href="https://www.youtube.com/watch?v=s5yza-s0bhM">Cryptography Full Course Part 2</a></li>
    <li><a href="https://www.youtube.com/watch?v=C_e37dfGmNA">Cryptography and Cyber Security Full Course</a></li>
    <li><a href="https://www.youtube.com/watch?v=lvTqbM5Dq4Q">How Quantum Computers Break Encryption | Shor's Algorithm Explained</a></li>
    <li><a href="https://blog.1password.com/why-we-moved-to-256-bit-aes-keys/">Why we moved to 256-bit AES keys</a></li>
    <li><a href="https://www.youtube.com/watch?v=S9JGmA5_unY&t=191s">How secure is 256 bit security?</a></li>
    <li><a href="https://www.youtube.com/watch?v=RijGNytjbOI">No Way JOSE! Designing Cryptography</a></li>
    <li><a href="https://dev.to/techschoolguru/a-complete-overview-of-ssl-tls-and-its-cryptographic-system-36pd">A complete overview of SSL/TLS and its cryptographic system</a></li>
    <li><a href="https://www.scottbrady91.com/jose/alternatives-to-jwts">Alternatives to JSON Web Tokens (JWTs)</a></li>
    <li><a href="https://deliciousbrains.com/php-encryption-methods/">Best Ways to Encrypt Passwords, Keys, & More with PHP in 2021</a></li>
    <li><a href="https://www.zimuel.it/blog/strong-cryptography-in-php/">Strong cryptography in PHP</a></li>
    <li><a href="https://paragonie.com/blog/2017/12/2018-guide-building-secure-php-software#secure-php-cryptography">The 2018 Guide to Building Secure PHP Software</a></li>
    <li><a href="https://jolicode.com/blog/what-libsodium-can-do-for-you-an-introduction-to-cryptography-in-php">What libsodium can do for you? An Introduction to Cryptography in PHP</a></li>
    <li><a href="https://crnkovic.me/encryption-and-hashing-for-laravel-devs-part-1/">Encryption and hashing for Laravel developers: Part 1 - Symmetric Encryption</a></li>
</ul>