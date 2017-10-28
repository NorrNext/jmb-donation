<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar and Dmitry Rekun <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2015 NorrNext. All rights reserved.
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
	 * Token
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
	 *
	 * @since   1.0
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

		$row->text = $this->makeReplacement($row->text);

		return true;
	}

	/**
	 * Method to return replaced content
	 *
	 * @param   string  $content  The content being passed to the replacer
	 *
	 * @return  string  HTML layout
	 *
	 * @since   1.0
	 */
	private function makeReplacement($content)
	{
		$displayData = new stdClass;
		$displayData->token     = $this->token;
		$displayData->params    = $this->params;

		$template = JFactory::getApplication()->getTemplate();

		$defaultLayoutsPath  = JPATH_PLUGINS . '/' . $this->_type . '/' . $this->_name . '/layouts';
		$templateLayoutsPath = JPATH_THEMES . '/' . $template . '/html/plg_' . $this->_type . '_' . $this->_name . '/layouts';

		jimport('joomla.filesystem.folder');

		JLayoutHelper::$defaultBasePath = JFolder::exists($templateLayoutsPath)
			? $templateLayoutsPath
			: $defaultLayoutsPath;

		$renderedLayout = JLayoutHelper::render('base', $displayData);

		if ($this->params->get('show_effects', 1))
		{
			$this->initEffects();
		}

		// Expression to search for
		$regex = '/{jmb_donation\s*(.*?)}/Uis';

		return preg_replace($regex, $renderedLayout, $content);
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
				throw new Exception(JText::_('PLG_CONTENT_JMB_DONATION_PARAMS_MISSING'));
			}

			// There are no params, set up defaults
			if (sizeof($parts) == 0)
			{
				$this->params->set('provider', $this->params->get('def_provider', 'paypal'));
				$this->params->set('merchant', $this->params->get('def_merchant', ''));
				$this->params->set('amount', $this->params->get('def_amount', 10));
				$this->params->set('amount', $this->params->get('currency', 'EUR'));
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
				$merchant = trim($parts[1]);
			}

			if ($merchant == '')
			{
				throw new UnexpectedValueException(JText::_('PLG_CONTENT_JMB_DONATION_MERCHANT_IS_NOT_VALID'));
			}

			$this->params->set('merchant', $merchant);

			// Set up amount param
			$amount = $this->params->get('def_amount', 10);

			if (!empty($parts[2]))
			{
				$amount = trim($parts[2]);
			}

			if ($amount == 0)
			{
				throw new UnexpectedValueException(JText::_('PLG_CONTENT_JMB_DONATION_AMOUNT_IS_NOT_VALID'));
			}

			$this->params->set('amount', $amount);

			// Set up currency param (it is optional)
			$currency = $this->params->get('def_currency', 'EUR');

			if (!empty($parts[3]))
			{
				$currency = trim($parts[3]);
			}

			$this->params->set('currency', $currency);
		}
	}

	/**
	 * Method to add effects: slider and smile
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	private function initEffects()
	{
		JHtml::_('behavior.framework', 'more');

		JHtml::stylesheet('plg_jmb_donation/slider.css', false, true);

		$showSmile = $this->params->get('show_smile') && !$this->params->get('show_image') ? '1' : '0';
		$amount    = $this->params->get('amount', 10);
		$minAmount = $this->params->get('amount_min', $amount / 10);
		$maxAmount = $this->params->get('amount_max', $amount * 2);
		$step      = $this->params->get('step', 5);

		$steps = round(($maxAmount - $minAmount) / $step);

		if ($showSmile)
		{
			JHtml::script('plg_jmb_donation/excanvas.js', false, true);
			JHtml::script('plg_jmb_donation/smile.js', false, true);
		}

		$js = "
		window.addEvent('domready', function(){
			var showSmile = " . $showSmile . ";
			var el = document.id('elslider" . $this->token . "');
			var inp = document.id('amount" . $this->token . "');
			var sum = " . $amount . ";
			var max = " . $maxAmount . ";
			if (showSmile) {
				var elsmile = document.id('smile" . $this->token . "');
			}

			var slider" . $this->token . " = new Slider(el, el.getElement('.knob'), {
				steps: '" . $steps . "',
				initialStep: sum,
				range: [" . $minAmount . ", " . $maxAmount . "],
				onChange: function(val){
					inp.set('value', val);
					var pr = (val/max)*100;
					if (showSmile) {
						var sml = new Smile(
							elsmile, pr, elsmile.getWidth()/150, elsmile.getProperty('rel').toInt(), elsmile.getProperty('color')
						);
					}
				}
			});

			inp.addEvent('keyup', function(event) {
				event.stop();
				var sm = inp.get('value');
				if (max > sm) {
					sm = max;
				}
				var cpr = (sm/max)*100;
				if (showSmile) {
					new Smile(
						elsmile, cpr, elsmile.getWidth()/150, elsmile.getProperty('rel').toInt(), elsmile.getProperty('color')
					);
				}
			});
		});
		";

		JFactory::getDocument()->addScriptDeclaration($js);
	}
}
