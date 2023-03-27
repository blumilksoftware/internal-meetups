## Blumilk Internal Meetup #25
\
<img src="presentations/2023-02-28-css-houdini/images/harry-houdini.png" width="230px">
\
CSS Houdini

\
Magdalena Bukowska 28.02.2023

---

#### What is CSS Houdini?

---

#### What are the problems of CSS?

- differences between browsers
- lack of features

---

#### Browser’s rendering engine
\
<img src="presentations/2023-02-28-css-houdini/images/browser-rendering-engine.png" width="700px">

---

#### How does CSS polyfill work?
\
<img src="presentations/2023-02-28-css-houdini/images/browser-rendering-engine-polyfill.png" width="700px">

---

#### Solution - CSS Houdini
\
<img src="presentations/2023-02-28-css-houdini/images/browser-rendering-engine-css-houdini.png" width="700px">

---

#### Is Houdini ready yet?
\
<a href="https://ishoudinireadyyet.com/">https://ishoudinireadyyet.com</a>

---
<section>

### Properties & Values API

</section>
<section>

```javascript
window.CSS.registerProperty({
  name: "--my-color",
  syntax: "<color>", // Defaults to "*"
  inherits: false,
  initialValue: "#c0ffee",
});
```

</section>
<section>

<img src="presentations/2023-02-28-css-houdini/images/syntax.png" width="600px">

```javascript
syntax: "<color>"; /* accepts a color */

syntax: "<length> | <percentage>"; /* accepts lengths or 
                                          percentages */
syntax: "small | medium | large"; /* accepts one of these 
                          values set as custom idents. */
syntax: "*"; /* any valid token */
```

</section>

---
<section>

### CSS TYPED OBJECT MODEL

</section>
<section>

```
document.querySelector("p").set("font-size", "16px");

document.querySelector("p").get("font-size");

// Returns 

CSSUnitValue {
    value: 16,
    unit: "px"
}
```

</section>
<section>

<img src="presentations/2023-02-28-css-houdini/images/css-style-values.png" width="600px">

</section>

<section>

```css
.example {
  background-position: center bottom 10px;  
}
```

```javascript
let map = document.querySelector(".example").computedStyleMap();

map.get("background-position").x;
// CSSUNitValue { value:50, unit: 'percent' }
map.get("background.position").y;
/*
   CSSMathSum {
     operator: 'sum',
     values: [ // CSSNumericArray
       { value: -10, unit: 'px' } // CSSUnitValue
       { value: 100, unit: 'percent' } // CSSUnitValue
     ]
   }
 */

```

</section>

---
<section>

#### Worklets

</section>
<section>

```javascript
window.demoWorklet.addModule("path/to/script.js")
```

</section>

---
<section>

#### Paint API

<p class="fragment">background-image, border-image, mask-image...</p>

</section>
<section>

<img src="presentations/2023-02-28-css-houdini/images/paint-border.png" width="300px">

</section>
<section>

```javascript
class DemoPainter {
    paint(context, geometry, parameters) {
        //...
    }
}
registerPaint('demo', DemoPainter)
```

</section>
<section>

```html
<script>
    CSS.paintWorklet.addModule("demo.js")
</script>
```

</section>
<section>

```css
.item {
    background-image: paint(demo);
}
```

</section>
<section>

<a href="https://houdini.how/">https://houdini.how</a>

</section>

---
<section>

#### Animation Worklet

<p class>Listens for user input</p>
<p class="fragment">Styles elements</p>

</section>
<section>

```javascript
const timeline = new ScrollTimeline({
    scrollSource: document.body,
    timeRange: 100
});
```

</section>
<section>

```javascript
const effect = new KeyframeEffect(
    document.querySelector(".image"),
    [
        { transform: "scale(1)" },
        { transform: "scale(0.25)" },
    ],
    { duration: 100 },
)
```

</section>
<section>

```javascript
class HeaderAnimator
{
    animate(currentTime, effect) {
        effect.localTime = currentTime * 5;
    }
}
registerAnimator("header", HeaderAnimator);
```

</section>
<section>

```javascript
const animation = new WorkletAnimation(
    "header",
    effect,
    timeline
);
animation.play();
```

</section>

---

#### Layout API

<p class>Positioning in container</p>
<p class="fragment">Displays and hides</p>
<p class="fragment">Standardization</p>

---

#### Other APIs

<p class="fragment">Font Metrics API</p>
<p class="fragment">CSS Parser API</p>
<p class="fragment">Scroll customization API</p>

---

#### Summary

<p class="fragment">Normalize cross-browser differences</p>
<p class="fragment">Invent or polyfill new features</p>

---

## Thank you!
