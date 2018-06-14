<?php namespace PHPBook\SMS;

class Message {

    private $to;

    private $content;

    public function setTo(Array $to): Message {
    	$this->to = $to;
    	return $this;
    }

    public function getTo(): ?Array {
    	return $this->to;
    }

    public function setContent(String $content): Message {
    	$this->content = $content;
    	return $this;
    }

    public function getContent(): String {
    	return $this->content;
    }
  
}
