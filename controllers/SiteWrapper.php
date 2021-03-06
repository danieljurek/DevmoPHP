<?php
/**
 * base controller for creating the default wrapper
 *
 * @category Framework
 * @author Dan Wager
 * @copyright Copyright (c) 2007 Devmo
 * @version 1.0
 */
namespace devmo\controllers;

class SiteWrapper extends \devmo\controllers\Controller {

  public function run (array $args=null) {
  	$view = $this->getView('devmo.SiteWrapper',$args);
		if (!$view->title)
			$view->title = "Default!!";
		$view->poweredby = $this->runController('devmo.PoweredBy');
    return $view;
  }

}
