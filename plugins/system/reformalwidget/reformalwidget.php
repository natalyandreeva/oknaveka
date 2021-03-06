<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );


class plgSystemReformalwidget extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatibility we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access	protected
	 * @param	object	$subject The object to observe
	 * @param 	array   $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function plgSystemReformalwidget( &$subject, $config )
	{
		parent::__construct( $subject, $config );
	}

	/**
	 * Do something onAfterInitialise
	 */
	function onAfterRender()
	{
		$app = JFACTORY::getApplication();
		
		if($app->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false)
		{
			return;
		}

		
		$body = JResponse::getBody();
		$pos = strripos($body, "</body>");
		if($pos > 0)
		{
			$refwd_code = $this->params->get('refwd_code', '');
			$body = substr($body, 0, $pos).$refwd_code.substr($body, $pos);
			JResponse::setBody($body);
		}

		return true;
	}
}
?>