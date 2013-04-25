# PHP Dump - View PHP Objects In Pretty HTML


## What is this?

Dump is a class that takes any variable and echoes the properties in prettified HTML with some light JavaScript 
for expanding and collapsing tree nodes. There are no dependencies on any CSS or JavaScript libraries, so the HTML
output should work in most modern browsers and play nice with many CSS frameworks and JavaScript libraries.

![Example Output](https://github.com/sachabeharry/php_dump/raw/master/ss1.png)

## Example Usage

Typically, developers would use Dump when debugging or investigating PHP web applications, ex.

```
$a = array( 'this', 'is', 'a', 'test' );
Dump::html($a, 'My test array title');
```

