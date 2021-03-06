<?php namespace PHPBook\SMS\Configuration;

class Connection {
    
	private $name;

	private $exceptionCatcher;

	private $driver;

	public function getName(): String {
		return $this->name;
	}

	public function setName(String $name): Connection {
		$this->name = $name;
		return $this;
	}

	public function getExceptionCatcher(): ?\Closure {
		return $this->exceptionCatcher;
	}

	public function setExceptionCatcher(\Closure $exceptionCatcher): Connection {
		$this->exceptionCatcher = $exceptionCatcher;
		return $this;
	}

	public function getDriver(): ?\PHPBook\SMS\Driver\Adapter {
		return $this->driver;
	}

	public function setDriver(\PHPBook\SMS\Driver\Adapter $driver): Connection {
		$this->driver = $driver;
		return $this;
	}

}