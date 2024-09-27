<img src="presentations/2024-09-23-typescript/images/ts-logo.png" width="200px" alt="Logo">
<h3> TypeScript </h3>
<br>
<p>Dawid Rudnik 23.09.2024</p>

---

<section>
    <h3>What is JavaScript?</h3>
</section>

<section>
    <p>Designed by Brendan Eich (Netscape) and released in 1995</p>
    <p>A lightweight scripting language that helps create dynamic web page content and is supported by all browsers</p>
    <p>Dynamic typing — weakly typed (no option for static typing)</p>
    <p>Best suited for small projects</p>
    <p>Can be directly used in browsers</p>
    <p>JS libraries work by default</p>
</section>

<section>
    <p>JavaScript is a programming language for creating interactive web features</p>
    <p>JavaScript runs directly in the browser.</p>
</section>

---

<section>
    <h3>What is TypeScript?</h3>
</section>

<section>
    <p>Designed by Microsoft and released in 2012</p>
    <p>Superset of JavaScript developed to overcome code complexity for large projects</p>
    <p>Strongly typed — supports both static and dynamic typing</p>
    <p>Best suited for large web apps</p>
    <p>Converted into JavaScript code to be understandable for browsers (Transpiler)</p>
    <p>Since it’s a superset, all the JavaScript libraries and other JavaScript code work without any changes</p>
</section>

<section>
    <p>TypeScript is JavaScript with syntax for types.</p>
    <p>TypeScript is a strongly typed, builds on JavaScript, giving you better tooling at any scale.</p>
</section>

---

<section>
    <h3>Some stats</h3>
</section>

<section>
    <p>Watch - 2.1k</p>
    <p>Forks - 12.4k</p>
    <p>Stars - 100k</p>
    <p>Issues - 5k</p>
    <p>Pull requests - 463</p>
    <p>Last commit - 20 September 2024</p>
    <p>First release - v0.8.0 - October 2012</p>
    <p>Last release - v5.6.2 - 9 September 2024</p>
</section>

<section>
    <img src="presentations/2024-09-23-typescript/images/npm-trends-ts.png" alt="Npm-trends-ts">
    <p>https://npmtrends.com/typescript</p>
</section>

---

<section>
    <h3>Why was TS created?</h3>
</section>

<section>
    <p>TypeScript was created to add static types to JavaScript, improving code quality and scalability in large projects. It helps catch errors at compile-time, making development more reliable and maintainable. It also enhances tooling and supports modern JavaScript features while being backward compatible.</p>
</section>

---

<section>
    <h3>TypeScript's key principles</h3>
</section>

<section>
    <p>TypeScript's key principles are: static typing, improved code readability, early error detection, enhanced tooling support, and backward compatibility with JavaScript.</p>
</section>

---

<section>
    <h3>Project configuration</h3>
</section>

<section>
<p>tsconfig.json</p>
<pre><code>
{
  "extends": "@tsconfig/node12/tsconfig.json",
  "compilerOptions": {
    "preserveConstEnums": true
  },
  "include": ["src/**/*"],
  "exclude": ["**/*.ts"]
}
</code></pre> 
<p>https://www.typescriptlang.org/tsconfig/</p>
</section>

---

<section>
    <h3>Simple Types</h3>
</section>

<section>
<p>Explicit Type</p>
<pre><code data-line-numbers="1|2|3">const firstString: string = "My first string"
const firstNumber: number = 123
const firstBoolean: boolean = true
</code></pre>
</section>

<section>
<p>Implicit Type</p>
<pre><code data-line-numbers="1|2|3">const firstString = "My first string"
const firstNumber = 123
const firstBoolean = true
</code></pre>
</section>

---

<section> 
    <h3>Special Types</h3>
</section>

<section>
<p>Type: unknown & any</p>
<pre><code data-line-numbers>let veryAdvancedVariable: unknown = "New string"
//or
let veryAdvancedVariable: any = "New string"
veryAdvancedVariable = true
Math.abs(veryAdvancedVariable)
&nbsp
console.log(Math.abs(veryAdvancedVariable)) 
// return ?
</code></pre>
</section>

<section>
<p>Type: never</p>
<pre><code data-line-numbers>let variable: never
</code></pre>
</section>

<section>
<p>Type: undefined & null</p>
<pre><code data-line-numbers>let y: undefined = undefined
let z: null = null
</code></pre>
</section>

---

<section>
    <h3>Arrays</h3>
</section>

<section> 
<p>What is a difference ?</p>
<pre><code data-line-numbers>const firstArray = []
// or
let secondArray = []
</code></pre>
</section>

<section> 
<pre><code data-line-numbers>const users: string[] = [
    'Michał M', 
    'Agnieszka', 
    'Kamil P', 
    'Natalia'
]
&nbsp
users.push(1234) // Error
</code></pre>
</section>

<section>
<p>Readonly</p>
<pre><code data-line-numbers>const someArray: readonly string[] = [
    'Test 1', 
    'Test 2', 
]
&nbsp
someArray.push('Test 3') // Error
someArray.pop() // Error
</code></pre>
</section>

<section>
<p>Type Inference</p>
<pre><code data-line-numbers>const someArray = ['Test 1','Test 2']
// Inferred to type string[]
&nbsp
someArray.push('Test 3') // No error
someArray.push(1234) // Error
</code></pre>
</section>

<section>
<p>Tuples</p>
<pre><code data-line-numbers>let someArray: [number, string, string, boolean]
&nbsp
someArray = [5, 'Some text', 'Some text', true]
someArray = [5,4,3,2] // Error
someArray = [5, 'Some text', 'Some text'] // Error
someArray = [5, 'Some text', 'Some text', true, 'New item'] // Error
// but ...
someArray.push('You can't see me TS') //No error ...
&nbsp
const someArray: [x: number, y: number] = [10, 20]
&nbsp
const [first, second] = someArray
</code></pre>
</section>

<section>
<pre><code data-line-numbers>let someArray: readonly [number, string] = [
    1234,
    'Test 1'
]
&nbsp
someArray.push('Test 2') // Error
</code></pre>
</section>

---

<section>
    <h3>Object Types</h3>
</section>

<section>
<p>Require properties</p>
<pre><code data-line-numbers>let user: { firstName: string, lastName: string } = {
  firstName: 'Test 1',
  lastName: 'User',
}
&nbsp
user.firstName = 'Test 2'
user.firstName = 1234 // Error
&nbsp
user = { firstName: 'Test 3', lastName: 'New user' }
</code></pre>
</section>

<section>
<p>Optional properties</p>
<pre><code data-line-numbers>let user: { firstName: string, lastName?: string } = {
  firstName: 'Test 1',
}
&nbsp
user.firstName = 'Test 2'
user.firstName = 1234 // Error
&nbsp
user = { firstName: 'Test 3', lastName: 'New user' }
</code></pre>
</section>

<section>
<p>Inference</p>
<pre><code data-line-numbers>let user = {
  firstName: 'Test 1',
}
&nbsp
user.firstName = 'Test 2'
user.lastName = 'Some last name' // Error
</code></pre>
</section>

<section>
<p>Index Signatures</p>
<pre><code data-line-numbers>let veryAdvancedObject: { 
    [property: string]: boolean 
} = {}
&nbsp
veryAdvancedObject.example = true
veryAdvancedObject.newExample = 'Some text' // Error
</code></pre>
</section>

---

<section>
    <h3>Enums</h3>
</section>

<section>
<p>Numeric</p>
<pre><code data-line-numbers>enum FirstEnum {
  FirstValue,
  SecondValue,
}
&nbsp
console.log(FirstEnum.FirstValue) // return 0
</code></pre>
</section>

<section>
<p>Initialized numeric</p>
<pre><code data-line-numbers>enum FirstEnum {
  FirstValue = 20,
  SecondValue,
}
&nbsp
console.log(FirstEnum.SecondValue) // return 21
</code></pre>
</section>

<section>
<p>Fully Initialized</p>
<pre><code data-line-numbers>enum FirstEnum {
  FirstValue = 20,
  SecondValue = 30,
}
&nbsp
console.log(FirstEnum.SecondValue) // return 30
</code></pre>
</section>

<section>
<p>String</p>
<pre><code data-line-numbers>enum FirstEnum {
  FirstValue = 'first-value',
  SecondValue = 'second-value',
}
&nbsp
console.log(FirstEnum.SecondValue) // return 'second-value'
</code></pre>
</section>

---

<section>
    <h3>Type Aliases and Interfaces</h3>
</section>

<section>
<p>Type Aliases</p>
<pre><code data-line-numbers>type UserFirstName = string //etc.
type User = { firstName: string, lastName: string }
type User = { firstName: UserFirstName, lastName: string } 
&nbsp
const exampleUser: User = { firstName... }
const exampleUser: User = { city: 'Legnica' } // Error
</code></pre>
</section>

<section>
<p>Extending type</p>
<pre><code data-line-numbers>type User = { ..... }
&nbsp
type Employee = User & { 
    city: string
}
&nbsp
const user: User = { ... }
const user: User = { city: 'Legnica' } // Error
const employee: Employee = { ..., city: 'Legnica' }
</code></pre>
</section>

<section>
<p>Interfaces</p>
<pre><code data-line-numbers>interface User { 
    firstName: string
    lastName: string 
}
&nbsp
const exampleUser: User = { firstName... }
const exampleUser: User = { city: 'Legnica' } // Error
</code></pre>
</section>

<section>
<p>Extending interfaces</p>
<pre><code data-line-numbers>interface User { ..... }
&nbsp
interface Employee extends User { 
    city: string
}
&nbsp
const user: User = { ... }
const user: User = { city: 'Legnica' } // Error
const employee: Employee = { ..., city: 'Legnica' }
</code></pre>
</section>

---

<section>
    <h3>Union Types</h3>
    <p>Union types are used when a value can be more than a single type.</p>
</section> 

<section>
<pre><code data-line-numbers>interface User {
    ...
    lastName: string | null
}
&nbsp
const renderError = (message: string | number) => { .... }
&nbsp
renderError('Some error')
renderError(401)
</code></pre>
</section>

<section>
<pre><code data-line-numbers>const renderError = (message: number | string[]) => { 
    if(Array.isArray(message)) { ... } // Array
    &nbsp
    // Number
}
&nbsp
renderError(401)
renderError([123,456]) //Error
</code></pre>
</section>

---

<section>
    <h3>Functions</h3>
</section>

<section>
<p>Return Type</p>
<pre><code data-line-numbers>function renderError(): string {...}
&nbsp
const renderError = (): string => {...}
&nbsp
const renderError = (): void => {...}
&nbsp
const renderError = () => {...} // any
&nbsp
const renderErrors = () => () => {...} // any
</code></pre>
</section>

<section>
<p>Parameters</p>
<pre><code data-line-numbers>function renderError (message: string) { ... }
//Single type
function renderError (message: string | number) { ... }
//Union Types
function renderError (message?: string) { ... }
//Optional
function renderError (message: string = 'Error') { ... }
//Default Parameters
function renderError ({ message, code }: { message: string, code?: number }) { ... }
//Named Parameters
function renderError (...messages: string[]) { ... }
//Rest Parameters
</code></pre>
</section>

<section>
<p>Type Alias</p>
<pre><code data-line-numbers>type newType = (message: string) => string
&nbsp
const renderError: newType = (message) => { ... }
// return string
const renderError: newType = (someNumber) => { ... } 
// Error
</code></pre>
</section>

---

<section>
    <h3>Casting</h3>
    <p>Casting is the process of overriding a type.</p>
</section>

<section>
<p>Casting with 'as'</p>
<pre><code data-line-numbers>const variable: string = '12.345'
Math.round(variable as number) // No error
// or
Math.round(Number(variable)) // No error
</code></pre>
</section>

<section>
<p>Casting with '<>'</p>
<pre><code data-line-numbers><script type="text/template">const variable: string = '12.345'
Math.round(<number>variable) // No error
</script></code></pre>
</section>

<section>
<p>Force casting</p>
<pre><code data-line-numbers>const variable: string = '12.345'
&nbsp
((variable as unknown) as number)
((variable as any) as number)
</code></pre>
</section>

---

<section>
    <h3>Classes</h3>
</section>

<section>
<pre><code data-line-numbers>class User {
    public firstName: string
    protected phoneNumber: string
    private lastName: string
    &nbsp
    public constructor(firstName: string, ...) {
        this.firstName = firstName
        ...
    }
    &nbsp
    public getLastName(): string {
        return this.lastName
    }
}
</code></pre>
</section>

<section>
<pre><code data-line-numbers>class User {
    public constructor(
        public firstName: string, 
        protected phoneNumber: string,
        private lastName: string
    ) {}
    &nbsp
    public getLastName(): string {
        return this.lastName
    }
}
</code></pre>
</section>

<section>
<p>Implements interface</p>
<pre><code data-line-numbers>interface User {
    firstName: string
    getFirstName: () => string
}
&nbsp
class Employee implements User {
    public constructor(
        public firstName: string, 
        public lastName: string,
    ) {}
    &nbsp
    public getFirstName(): string {
        return this.firstName
    }
}
</code></pre>
</section>

<section>
<p>Extends class</p>
<pre><code data-line-numbers>class User { ... }
&nbsp
class Employee extends User {
    public constructor(
        firstName: string, 
        lastName: string
    ) {
        super(firstName, lastName)
    }
}
</code></pre>
</section>

<section>
<p>Abstract class</p>
<pre><code data-line-numbers>abstract class User { ... }
&nbsp
class Employee extends User {
    public constructor(
        firstName: string, 
        lastName: string
    ) {
        super(firstName, lastName)
    }
}
</code></pre>
</section>

---

<section>
    <h3>Generics</h3>
</section>

<section>
<p>Functions</p>
<pre><code data-line-numbers><script type="text/template">function createArray<S, T>(firstValue: S,secondValue: T)
    : [S, T] { 
    return [firstValue, secondValue]
}
const variable = create<boolean, string>(true, 'Test'))
// [true, 'Test']
</script></code></pre>
</section>

<section>
<p>Classes</p>
<pre><code data-line-numbers><script type="text/template">class GenericClass<T> {
    public variable: T
    ...
    public getValue(): T {
        return variable
    }
}
const instance = new GenericClass<string>('Test')
</script></code></pre>
</section>

<section>
<p>Type Aliases</p>
<pre><code data-line-numbers><script type="text/template">type SingleItemWrapper<T> = { value: T, name: string }
const variable: SingleItemWrapper<number> = { 
    value: 10,
    name: 'Test',
}
</script></code></pre>
</section>

<section>
<p>Default value</p>
<pre><code data-line-numbers><script type="text/template">type SingleItemWrapper<T = number> = { 
    value: T, 
    name: string,
}
const variable: SingleItemWrapper = { 
    value: 10,
    name: 'Test',
}
</script></code></pre>
</section>

<section>
<p>Extends</p>
<pre><code data-line-numbers><script type="text/template">function createArray
    <S extends string, T extends string>(
        firstValue: S, 
        secondValue: T
    ): [S, T] {
    return [firstValue, secondValue]
}
</script></code></pre>
</section>

---

<section>
    <h3>Utility Types</h3>
</section>

<section>
<p>Partial</p>
<pre><code data-line-numbers><script type="text/template">interface User {
    firstName: string
    lastName: string
}
let user: Partial<User> = {}
user.firstName = 'Test User'
</script></code></pre>
</section>

<section>
<p>Required</p>
<pre><code data-line-numbers><script type="text/template">interface User {
    firstName: string
    lastName?: string
}
let user: Required<User> = {
    firstName: 'Test'
    lastName: 'User'
}
</script></code></pre>
</section>

<section>
<p>Record</p>
<pre><code data-line-numbers><script type="text/template">const simpleObject: Record<number, string> = {
    1: 'Test 1',
    2: 'Test 2'
}
</script></code></pre>
</section>

<section>
<p>Omit</p>
<pre><code data-line-numbers><script type="text/template">interface User {
    firstName: string
    lastName: string
}
const exampleUser = Omit<User, 'lastName'> = {
    firstName: string
}
</script></code></pre>
</section>

<section>
<p>Pick</p>
<pre><code data-line-numbers><script type="text/template">interface User {
    firstName: string
    lastName: string
}
const exampleUser = Pick<User, 'firstName'> = {
    firstName: string
}
</script></code></pre>
</section>

<section>
<p>Exclude</p>
<pre><code data-line-numbers><script type="text/template">type SomeType = boolean | number
const value: Exclude<SomeType, boolean> = 1234
// Only number
</script></code></pre>
</section>

<section>
<p>ReturnType</p>
<pre><code data-line-numbers><script type="text/template">type SomeFunction = () => { token: string; name: string }
const point: ReturnType<SomeFunction> = {
    token: 'Token123454211',
    name: 'My secret token'
}
</script></code></pre>
</section>

<section>
<p>Parameters</p>
<pre><code data-line-numbers><script type="text/template">type SomeFunction = (value: { token: string; name: string }) => void
const point: Parameters<SomeFunction>[0] = {
    token: 'Token123454211',
    name: 'My secret token'
}
</script></code></pre>
</section>

<section>
<p>Readonly</p>
<pre><code data-line-numbers><script type="text/template">interface User {
    firstName: string
    lastName: string
}
const exampleUser: Readonly<User> = {
    firstName: 'User',
    lastName: 'Test',
}
exampleUser.firstName = 'New user'
// Error
</script></code></pre>
</section>

---

<section>
    <h3>Keyof</h3>
    <p>'keyof' is a keyword in TypeScript which is used to extract the key type from an object type.</p>
</section>

<section>
<p>'keyof' with explicit keys</p>
<pre><code data-line-numbers><script type="text/template">interface User {
    firstName: string
    ...
}
function printUserValue(user: User, property: keyof User) {
    console.log(user[property])
}
printUserValue({ firstName: 'Test', ... }, 'firstName')
// print 'Test'
</script></code></pre>
</section>

---

<section>
    <h3>Definitely Typed</h3>
</section>

<section>
<pre><code data-line-numbers>npm install --save-dev @types/...</code></pre>
</section>

---

<section>
    <h3>How to use TS?</h3>
</section>

<section>
    <p>Use types when type is not obvious or can be multi types</p>
</section>
<section>
    <p>Create own types/interfaces for understanding of code</p>
</section>
<section>
    <p>Use type check, and remove errors</p>
</section>
<section>
    <p>Create generic types with default value</p>
</section>

---

<section>
    <h3>Best practices</h3>
</section>

<section>
    <p>Use utility types</p>
</section>
<section>
    <p>Avoid any types</p>
</section>
<section>
    <p>Prefer union types</p>
</section>
<section>
    <p>Use type annotations liberally</p>
</section>
<section>
    <p>Avoid duplicate of similar types</p>
</section>


---

<section>
    <h3>What to avoid?</h3>
</section>

<section>
    <p>Overcomplicating Types</p>
</section>
<section>
    <p>Not Leveraging TypeScript Features</p>
</section>
<section>
    <p>Ignoring Type-check Errors and Warning</p>
</section>
<section>
    <p>Overuse of type any</p>
</section>
<section>
    <p>Wrong Ts project configuration</p>
</section>


---

<section>
    <h3>Advantages of using TS</h3>
</section>

<section>
    <p>Easier and faster project understanding</p>
</section>
<section>
    <p>Early error detection</p>
    <p>Catches mistakes during development with static typing.</p>
</section>
<section>
    <p>Improved code readability</p>
    <p>Makes code easier to understand and maintain.</p>
</section>
<section>
    <p>Enhanced tooling</p>
    <p>Offers better autocompletion, refactoring, and navigation in IDEs.</p>
</section>
<section>
    <p>Scalability</p>
    <p>Eases management of large codebases.</p>
</section>
<section>
    <p>JavaScript compatibility</p>
    <p>Works with existing JavaScript code and libraries.</p>
</section>

---

<section>
    <h3>Disadvantages of using TS</h3>
</section>

<section>
<p>Readonly</p>
<pre><code data-line-numbers>interface User {
    readonly name: string
}
&nbsp
const user: User = { name: 'Test' }
&nbsp
function renameUser (user: { name: string }): void {
    user.name = 'Test 2' //No error
}
&nbsp
renameUser(user) 
&nbsp
console.log(user) // return { name: 'Test 2' }
</code></pre>
</section>

<section>
<p>Function Types</p>
<pre><code data-line-numbers>function myFirstFunction(): void {
    return 'Compiler error, but string returned'
    // Error
}
&nbsp
console.log(myFirstFunction()) // Return 'Compiler ....'
</code></pre>
</section>

<section>
    <p>Enums</p>
</section>

<section>
    <p>Type check use so many memory</p>
</section>

<section>
    <p>Inertia i useForm (types overriding)</p>
</section>

---

<section>
    <h3>Main reason to use TypeScript</h3>
</section>

<section>
    <p>Type Safety</p>
    <p>TypeScript adds static typing to JavaScript, allowing you to define types for variables, function parameters, and return values. This helps catch errors during development, reducing runtime bugs</p>
</section>
<section>
    <p>Enhanced Developer Experience</p>
    <p>With static types, development tools (IDEs) can provide better auto-completion, real-time error checking, and refactoring capabilities, which improves productivity and reduces coding mistakes</p>
</section>
<section>
    <p>Scalability</p>
    <p>TypeScript is especially useful in large projects or codebases. It helps maintain clear contracts (via types and interfaces) between different parts of the application, making the codebase easier to understand, maintain, and scale</p>
</section>
<section>
    <p>Early Error Detection</p>
    <p>TypeScript catches errors at compile time, before the code is executed, preventing common JavaScript pitfalls like undefined variables, misspelled property names, or invalid argument types</p>
</section>
<section>
    <p>Readability and Maintainability</p>
    <p>The self-documenting nature of TypeScript, due to explicit types, makes code more readable and maintainable, especially for teams where multiple developers are involved</p>
</section>
<section>
    <p>Improve code safety, maintainability, and scalability</p>
</section>

---

<section>
    <h3>When don't use TypeScript</h3>
</section>

<section>
    <p>Simple Frontend applications</p>
</section>
<section>
    <p>Proof of concept</p>
</section>
<section>
    <p>When this will be some package?</p>
</section>
<section>
    <p>When adding TypeScript to an existing project will be too complicated</p>
</section>
<section>
    <p>TypeScript types is not necessary</p>
</section>
<section>
    <p>Lightweight projects</p>
</section>

---

<section>
    <p>JavaScript: finish work fast, but you probably have left some bugs there (like undefined, etc..)</p>
</section>

<section>
    <p>TypeScript: work slower since you will write a lot of types and the compiler will actively prevent you.</p>
    <p>One downside is that some compiler errors can be hard to understand. Another thing is if you wrote some "bad" types or if you find yourself using too much types, it won't be as beneficial.</p>
</section>

---

<section>
    <h3>Different alternatives ?</h3>
</section>
<section>
    <p>JSDoc</p>
    <p>https://blog.openreplay.com/jsdoc--a-solid-alternative-to-typescript/</p>
</section>
<section>
    <p>Flow</p>
    <p>https://github.com/facebook/flow</p>
</section>
<section>
    <p>ReScript</p>
    <p>https://rescript-lang.org/</p>
</section>

---

<section>
    <h3>JavaScript Quiz</h3>
    <p>Find correct answer</p>
</section>

<section>
<pre><code data-line-numbers>console.log(018 - 015)</code></pre>
<p>A) NaN</p>
<p>B) 3</p>
<p>C) 5</p>
<p>D) 13</p>
</section>

<section>
<pre><code data-line-numbers>const numbers = [33, 2, 8]
numbers.sort()
console.log(numbers[1])</code></pre>
<p>A) 33</p>
<p>B) 2</p>
<p>C) 1</p>
<p>D) 8</p>
</section>

<section>
<pre><code data-line-numbers>console.log(false == '0')</code></pre>
<p>A) false</p>
<p>B) true</p>
</section>

<section>
<pre><code data-line-numbers>console.log(3 > 2 > 1)</code></pre>
<p>A) false</p>
<p>B) true</p>
</section>

---

<section>
    <h3>The end :)</h3>
</section>
