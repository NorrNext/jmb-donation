<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

/**
 * JMB donation content plugin base class.
 *
 * @package  Jmb_Donation
 * @since    1.0
 */
class PlgContentJmb_Donation extends JPlugin
{
	/**
	 * Token.
	 *
	 * @var  string
	 */
	private $token;

	/**
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe.
	 * @param   array   $params    An array that holds the plugin configuration.
	 */
	public function __construct(&$subject, $params)
	{
		parent::__construct($subject, $params);

		$this->loadLanguage();
	}

	/**
	 * Plugin that adds donation form to content.
	 *
	 * @param   string  $context  The context of the content being passed to the plugin.
	 * @param   mixed   &$row     An object with a "text" property.
	 * @param   array   &$params  Additional parameters.
	 * @param   int     $page     Optional page number. Unused. Defaults to zero.
	 *
	 * @return  boolean  True on success.
	 */
	public function onContentPrepare($context, &$row, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer')
		{
			return true;
		}

		// Simple performance check to determine whether bot should process further
		if (strpos($row->text, 'jmb_donation') === false)
		{
			return true;
		}

		$this->token = uniqid();

		try
		{
			$this->setupParams($row->text);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();

			return true;
		}

		$provider = $this->params->get('provider');

		switch ($provider)
		{
			case 'yandex':
				$row->text = $this->replaceYM($row->text);
				break;

			default:
				$row->text = $this->replacePaypal($row->text);
		}

		return true;
	}

	/**
	 * Method to return replaced content.
	 *
	 * @param   string  $content  The content being passed to the replacer.
	 *
	 * @return  string  Form template.
	 */
	private function replacePaypal($content)
	{
		// Expression to search for
		$regex = '/{jmb_donation\s*(.*?)}/Uis';

		$matches = array();
		preg_match_all($regex, $content, $matches, PREG_SET_ORDER);

		ob_start();
		include_once dirname(__FILE__) . '/layouts/form_paypal.php';
		//JLayoutHelper::render('form_paypal', $this->params, JPATH_PLUGINS . '/' . $this->_type . '/' . $this->_name . '/layouts');
		$template = ob_get_contents();
		ob_end_clean();

		$this->sliderInit();

		return preg_replace($regex, $template, $content);
	}

	/**
	 * Method to return replaced content.
	 *
	 * @param   string  $content  The content being passed to the replacer.
	 *
	 * @return  mixed  Form template.
	 */
	private function replaceYM($content)
	{
		// Expression to search for
		$regex = '/{jmb_donation\s*(.*?)}/Uis';

		$matches = array();
		preg_match_all($regex, $content, $matches, PREG_SET_ORDER);

		ob_start();
		include_once dirname(__FILE__) . '/layouts/form_ya.php';
		//JLayoutHelper::render('form_paypal', $this->params, JPATH_PLUGINS . '/' . $this->_type . '/' . $this->_name . '/layouts');
		$template = ob_get_contents();
		ob_end_clean();

		$this->sliderInit();

		return preg_replace($regex, $template, $content);
	}

	/**
	 * Method to setup plugin's parameters
	 *
	 * @param   string  $content  The content
	 *
	 * @return  void
	 *
	 * @throws  Exception
	 *
	 * @since   1.0
	 */
	private function setupParams($content)
	{
		// Expression to search for
		$regex = '/{jmb_donation\s*(.*?)}/i';

		$matches = array();
		preg_match_all($regex, $content, $matches, PREG_SET_ORDER);

		foreach ($matches as $match)
		{
			// $match[0] is full pattern match, $match[1] are the params.
			$parts = array_filter(explode("|", $match[1]));

			// Incorrect number of params
			if (sizeof($parts) < 3 && sizeof($parts) != 0)
			{
				throw new Exception(JText::_('PLG_CONTENT_JBM_DONATION_PARAMS_MISSING'));
			}

			// There are no params, set up defaults
			if (sizeof($parts) == 0)
			{
				$this->params->set('provider', $this->params->get('def_provider', 'paypal'));
				$this->params->set('merchant', $this->params->get('def_merchant', ''));
				$this->params->set('amount', $this->params->get('def_amount', 10));
			}

			// Set up provider param
			$provider = $this->params->get('def_provider', 'paypal');

			if (!empty($parts[0]))
			{
				switch (trim($parts[0]))
				{
					case 'yandex':
						$provider = 'yandex';
						break;

					case 'paypal':
						$provider = 'paypal';
						break;
				}
			}

			$this->params->set('provider', $provider);

			// Set up merchant param
			$merchant = $this->params->get('def_merchant', '');

			if (!empty($parts[1]))
			{
				$merchant = $parts[1];
			}

			if ($merchant == '')
			{
				throw new UnexpectedValueException(JText::_('PLG_CONTENT_JBM_DONATION_MERCHANT_IS_NOT_VALID'));
			}

			$this->params->set('merchant', $merchant);

			// Set up amount param
			$amount = $this->params->get('def_amount', 10);

			if (!empty($parts[2]))
			{
				$amount = $parts[2];
			}

			if ($amount == 0)
			{
				throw new UnexpectedValueException(JText::_('PLG_CONTENT_JBM_DONATION_AMOUNT_IS_NOT_VALID'));
			}

			$this->params->set('amount', $amount);
		}
	}

	/**
	 * Method to add slider.
	 *
	 * @return  void
	 */
	private function sliderInit()
	{
		JHtml::_('behavior.framework', 'more');

		JHtml::stylesheet('plg_jmb_donation/slider.css', false, true);
		JHtml::script('plg_jmb_donation/excanvas.js', false, true);
		JHtml::script('plg_jmb_donation/smile.js', false, true);

		$js = "
		window.addEvent('domready', function(){
			var el = $('elslider" . $this->token . "');
			var elsmile = $('smile" . $this->token . "');
			var inp = $('amount" . $this->token . "');
			var sum = ('" . $this->params->get('amount') . "')*1;

			var slider" . $this->token . " = new Slider(el, el.getElement('.knob'), {
				steps: sum*2,
				initialStep: sum,
				range: [sum/10, sum*2],
				onChange: function(val){
					inp.set('value', val/1);
					var pr = (val/(sum*2))*100;
					var sml = new Smile ($('smile" . $this->token . "'), pr, elsmile.getWidth()/150, elsmile.getProperty('rel').toInt(), elsmile.getProperty('color'));
				}
			});

			inp.addEvent('keyup', function(event) {
				event = new Event(event).stop();
				var sm = inp.get('value')*1;
				var cpr = (sm/(sum*2))*100;
				if (cpr > 100)	cpr = 100;
				new Smile ($('smile" . $this->token . "'), cpr, elsmile.getWidth()/150, elsmile.getProperty('rel').toInt(), elsmile.getProperty('color'));
			});
		});
		";

		JFactory::getDocument()->addScriptDeclaration($js);
	}
}
