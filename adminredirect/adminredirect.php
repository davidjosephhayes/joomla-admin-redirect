<?php defined('_JEXEC') or die;

// http://docs.joomla.org/Plugin/Events/System
// http://docs.joomla.org/J2.5:Creating_a_System_Plugin_to_augment_JRouter
// http://docs.joomla.org/J3.x:Creating_a_Plugin_for_Joomla
//~ 
//~ function pre($var) { return "<pre>".print_r($var,true)."</pre>"; }
//~ error_reporting(E_ALL&~E_NOTICE);
//~ ini_set('display_errors',1);

class PlgUserAdminRedirect extends JPlugin {
		
	public function __construct(&$subject, $config) {
		
		parent::__construct($subject, $config);

		//~ echo 'subject',pre($subject);
		//~ echo 'config',pre($config);
		//~ echo 'paramps',pre($this->params);
		//~ exit;		
	}

	public function onUserAfterLogin() {

		$app = JFactory::getApplication(); 
		$redirecturl = $this->params->get('redirecturl');

		// undocumented feature: prevent the redirect 
		$session = JFactory::getSession();
		$skipredirect = $session->get('adminredirect-skip', false);
		
		if (!$app->isAdmin()||empty($redirecturl)||$skipredirect) return;
		
		//~ echo pre($redirecturl); exit;
		
		$app->redirect(JRoute::_($redirecturl,false));
	}
}
