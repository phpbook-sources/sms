    
+ [About SMS](#about-sms)
+ [Composer Install](#composer-install)
+ [Declare Configurations](#declare-configurations)
+ [Sending SMS](#sending-sms)

### About SMS

- A lightweight SMS PHP library available for NEXMO, PLIVO e TWILIO.

### Composer Install

	composer require phpbook/sms

### Declare Configurations

```php

/********************************************
 * 
 *  Declare Configurations
 * 
 * ******************************************/

//Driver connection NEXMO

\PHPBook\SMS\Configuration\SMS::setConnection('main',
	(new \PHPBook\SMS\Configuration\Connection)
		->setName('Main')
		->setExceptionCatcher(function(String $message) {
			//the PHPBook SMS does not throw exceptions, but you can take it here
			//you can store $message in database or something else
		})
		->setDriver((new \PHPBook\SMS\Driver\NEXMO)
			->setKey('key')
			->setSecret('secret')
			->setFrom('00000000000'))
);

//Driver connection PLIVO

\PHPBook\SMS\Configuration\SMS::setConnection('notify',
	(new \PHPBook\SMS\Configuration\Connection)
		->setName('Notify')
		->setExceptionCatcher(function(String $message) {
			//the PHPBook SMS does not throw exceptions, but you can take it here
			//you can store $message in database or something else
		})
		->setDriver((new \PHPBook\SMS\Driver\PLIVO)
			->setKey('key')
			->setToken('token')
			->setFrom('00000000000'))
);

//Driver connection TWILIO

\PHPBook\SMS\Configuration\SMS::setConnection('payments', 
	(new \PHPBook\SMS\Configuration\Connection)
		->setName('Payments')
		->setExceptionCatcher(function(String $message) {
			//the PHPBook SMS does not throw exceptions, but you can take it here
			//you can store $message in database or something else
		})
		->setDriver((new \PHPBook\SMS\Driver\TWILIO)
			->setKey('key')
			->setToken('token')
			->setFrom('00000000000'))
);


//Set default connection by connection code

\PHPBook\SMS\Configuration\SMS::setDefault('main');

//Getting connections

$connections = \PHPBook\SMS\Configuration\SMS::getConnections();

foreach($connections as $code => $connection) {

	$connection->getName(); 

	$connection->getDriver();

};

?>
```

### Sending SMS

```php
		
	//Connection code is not required if you set default connection

	//make sure the number contain the country code with plus and are code too.

	$boolean = (new \PHPBook\SMS\SMS)
		->setConnectionCode('notify')
		->setMessage(
			(new \PHPBook\SMS\Message)
			->setTo(['+5547999999999', '+5547888888888'])
			->setContent('Hi Jhon')
		)
		->dispatch();

	if ($boolean) {
		//sent
	};

		
```