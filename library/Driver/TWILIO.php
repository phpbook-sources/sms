<?php namespace PHPBook\SMS\Driver;

class TWILIO extends Adapter {
    	
   	private $key;

    private $token;

    private $from;

    public function getKey(): String {
    	return $this->key;
    }

    public function setKey(String $key): TWILIO {
    	$this->key = $key;
    	return $this;
    }

    public function getToken(): String {
    	return $this->token;
    }

    public function setToken(String $token): TWILIO {
    	$this->token = $token;
    	return $this;
    }

	public function getFrom(): String {
		return $this->from;
	}

	public function setFrom(String $from): TWILIO {
		$this->from = $from;
		return $this;
	}

    public function dispatch(\PHPBook\SMS\Message $message): Bool {

		$url = 'https://api.twilio.com/2010-04-01/Accounts/'.$this->getKey().'/SMS/Messages';

		foreach($message->getTo() as $to) {

			$data = [
			    'From' => $this->getFrom(),
			    'To' => $to,
			    'Body' => $message->getContent()
			];

			$post = http_build_query($data);

			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $this->getKey().":".$this->getToken());
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

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