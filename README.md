# Fuloos RPC API

A PHP implementation of Fuloos Daemon RPC wrapped up into a simple to use class.

## Introduction

This is one file class to allow developers and users to access their Fuloos Daemon by using PHP to send requests using curl and with user authentication.

## How to Use

This class is very simple to use, you need to simply include the api.class.php file and initialize it.

```php

  // Include the class file
  require_once 'api.class.php';
  
  // Start the fuloos class with the RPC Information
  $Fuloos = new \API\Fuloos("IP-ADDRESS", "RPC-PORT", "RPC-USERNAME", "RPC-PASSWORD");
  
  // Send request to the API
  $Fuloos->_get_daemon_info();
  

```

Now the Fuloos RPC API class is ready to do one of two things.

### Error Catcher

This application has an error catching mechanism so you can easily differentiate errors. 

Any errors will invoke a new Exception to be called. I am still working on this feature to have named Exceptions for better usability, but for now they simply give detail error messages.


## Closing

I love help, if you think you can make this class better make a pull request! :)
