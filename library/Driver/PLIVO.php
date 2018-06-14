<?php namespace PHPBook\SMS\Driver;

class PLIVO extends Adapter  {
    	
    private $key;

    private $token;

    private $from;

    public function getKey(): String {
    	return $this->key;
    }

    public function setKey(String $key): PLIVO {
    	$this->key = $key;
    	return $this;
    }

    public function getToken(): String {
    	return $this->token;
    }

    public function setToken(String $token): PLIVO {
    	$this->token = $token;
    	return $this;
    }

	public function getFrom(): String {
		return $this->from;
	}

	public function setFrom(String $from): PLIVO {
		$this->from = $from;
		return $this;
	}

    public function dispatch(\PHPBook\SMS\Message $message): Bool {
	
		$url = 'https://api.plivo.com/v1/Account/'.$this->getKey().'/Message/';

		foreach($message->getTo() as $to) {

			$data = array("src" => $this->getFrom(), "dst" => $to, "text" => $message->getContent());

			$posts = json_encode($data);

			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($ch, CURLOPT_USERPWD, $this->getKey() . ":" . $this->getToken());
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
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