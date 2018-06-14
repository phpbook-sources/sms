<?php namespace PHPBook\SMS\Driver;

class NEXMO extends Adapter  {
    	
    private $key;

    private $secret;

    private $from;

    public function getKey(): String {
    	return $this->key;
    }

    public function setKey(String $key): NEXMO {
    	$this->key = $key;
    	return $this;
    }

    public function getSecret(): String {
    	return $this->secret;
    }

    public function setSecret(String $secret): NEXMO {
    	$this->secret = $secret;
    	return $this;
    }

    public function getFrom(): String {
    	return $this->from;
    }

    public function setFrom(String $from): NEXMO {
    	$this->from = $from;
    	return $this;
    }

    public function dispatch(\PHPBook\SMS\Message $message): Bool {

    	foreach($message->getTo() as $to) {

    		$ch = curl_init('https://rest.nexmo.com/sms/json?api_key='.$this->getKey().'&from='.$this->getFrom().'&api_secret='.$this->getSecret().'&text='.urlencode($message->getContent()).'&timestamp='.time().'&to='.$to.'&type=unicode');
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);

			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			curl_close($ch);

			if (($httpcode < 200) or ($httpcode > 299)) {

				throw new \Exception($response);

			};

    	};

    	return true;
			
    }

}