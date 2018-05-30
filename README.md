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

This will copy file into directory below :

```
- public/css/SmartDevTable.css
- public/js/SmartDevTable.js
- public/css/bootstrap-dialog.min.css
- public/js/bootstrap-dialog.min.js
- public/css/bootstrap-material-datetimepicker.css
- public/js/bootstrap-material-datetimepicker.js 
```
and include this file on your body html

```
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

```
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
```

### Usage
In your controller, put your code like this 

```use rndediiv2\SmartDevTable\Facade\SmartDevTable;```



### Documentation

See at [SmartDevTable Wiki](https://github.com/rndediiv2/SmartDevTable/wiki)
