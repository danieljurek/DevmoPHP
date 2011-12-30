<?php
namespace Devmo\libs;

class Exception extends \LogicException {
  private $path;
  private $info;


  public function __construct ($text, $path=null) {
    $this->path = $path;
    $this->extra = null;
    parent::__construct($text);
  }


  public function getPath () {
    return $this->path;
  }

  
  public function setInfo ($info) {
    $this->info = $info;
  }


  public function __toString () {
    $err = "\nWhat: ".$this->getMessage()
         .($this->info ? "\nInfo: {$this->info}" : null)
         .($this->path ? "\nPath: {$this->path}" : null)
         . "\nWhen: ".date('Y-m-d H:m:s')
         . "\nWhere: ";
    foreach ($this->getTrace() as $i=>$x) {
      $err .= ($i>0?"       ":null)
           .  (isset($x['file'])?$x['file']:null)
           .  ":" .(isset($x['line'])?$x['line']:null)
           .  " " 
           .  (isset($x['class'])?$x['class']:null)
           .  (isset($x['type']) ?$x['type']:null)
           .  (isset($x['function'])?$x['function']:null)
           #.  (isset($x['args'])?"(".implode(',',$x['args']).")":null)
           .  "\n";
    }
    return $err;
  }  
  
}


class CoreException extends \Devmo\libs\Exception {
  public $name;
  public $tokens;


  public function __construct ($name=null, $tokens=null) {
    $this->name = $name;
    $this->tokens = $tokens ? $tokens : array();
    parent::__construct("DevmoCoreException::{$name}");
  }
  

  public function __toString () {
    $info = "";
    foreach ($this->tokens as $k=>$v)
      if ($v!=null)
        $info .= " ".ucfirst($k).":{$v}";
		parent::setInfo($info);
    return parent::__toString();
  }

}



class UniqueException extends \Devmo\libs\Exception {
}


class InvalidException extends \Devmo\libs\Exception {
  public function __construct ($what,$value) {
    parent::__construct(($value ? "Invalid Value Found For {$what}" : "Missing Value For {$what}"));
  }
}
