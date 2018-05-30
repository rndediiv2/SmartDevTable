# SmartDevTable
A native class pagination with Laravel and Bootstrap

## About
Currently this package is only used for the purposes of our internal development

### Installation

Require the ```rndediiv2/smart-dev-table``` package in your ```composer.json``` and update your dependencies:

```
$ composer require rndediiv2/smart-dev-table
```

Add the SmartDevTable\SmartDevTableServiceProvider to your ```config/app.php``` providers array:

```
rndediiv2\SmartDevTable\SmartDevTableServiceProvider::class,
```

If you want, you can use the facade. Add the reference in ```config/app.php``` to your aliases array.

```
'SmartDevTable' => rndediiv2\SmartDevTable\Facade\SmartDevTable::class,
```

### Configuration
To get started, you'll need to publish all vendor assets:

```
$ php artisan vendor:publish
```
This will create a css file in ```public/css/SmartDevTable.css```, and include this file on your body html 
This will create a js file in ```public/js/SmartDevTable.js```, and include this file on your body html 
This will copy a css file in ```public/js/bootstrap-dialog.min.css```, and include this file on your body html
This will copy a js file in ```public/js/bootstrap-dialog.min.js```, and include this file on your body html 
This will copy a css file in ```public/js/bootstrap-material-datetimepicker.css```, and include this file on your body html  
This will copy a js file in ```public/js/bootstrap-material-datetimepicker.js```, and include this file on your body html 


```
<body>
----
Your html content
----
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-material-datetimepicker.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/SmartDevTable.css') }}" />
<body>

<script type="text/javascript" src="{{ URL::asset('/js/bootstrap-dialog.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/js/SmartDevTable.js') }}"></script>
</body>
```
We also use third-party js : 
* [alertifyjs](https://alertifyjs.org/) - Simple browser dialogs. 
So, you must download above alelrify.js and put your code before ```<script type="text/javascript" src="{{ asset('/js/SmartDevTable.js') }}"></script>```


### Usage
In your controller, put your code like this 

```use rndediiv2\SmartDevTable\Facade\SmartDevTable;```



### Documentation

See at [SmartDevTable Wiki](https://github.com/rndediiv2/SmartDevTable/wiki)
