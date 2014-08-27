<?php
/**
 * @package    Jmb_donation
 * @author     Lex, AllDar
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

/**
 * JMB donation content plugin base class.
 *
 * @package  JMB donation content plugin
 * @since    1.0
 */
class plgContentJmb_Donation extends JPlugin 
{
	/**
	 * Token.
	 *
	 * @var  string
	 */
	public $token;

	/**
	 * Constructor.
	 *
	 * @param  object  $subject  The object to observe.
	 * @param  array   $config   An array that holds the plugin configuration.
	 *
	 */
	public function __construct(&$subject, $params) 
	{
		parent::__construct($subject, $params);
		$this->loadLanguage();
	}

	/**
	 * Plugin that adds donation form to content.
	 *
	 * @param   string  $context     The context of the content being passed to the plugin.
	 * @param   mixed   $article     An object with a "text" property.
	 * @param   array   $params      Additional parameters.
	 * @param   int     $limitstart  Optional page number. Unused. Defaults to zero.
	 *
	 * @return  boolean  True on success.
	 */
	public function onContentPrepare($context, &$article, &$params, $limitstart) 
	{
		$this->token   = uniqid();
		$article->text = $this->replaceYM($article->text);

		return true;
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
		preg_match_all('/.*(\{\s*jmb_donation\s*(\s*\S*.*\s*)\s*\}).*/Uis', $content, $money_amount);
		$replacement = array();
		$replacer = array();
		$opt = array();

		ob_start();
		include_once(dirname(__FILE__) . '/layouts/form_ya.php');
		$template = ob_get_contents();
		ob_end_clean();

		$vars = array('money_amount_default', 'wallet_number', );
		$j = 0;
		foreach ($money_amount[1] as $tags)
		{
			$replacement = '|' . str_ireplace(array('|', '/'), array('\|', '\/'), $tags) . '|Uis';
			$opt = explode('|', $money_amount[2][$j]); 
			$replacer = $this->replacerAsHTML($opt, $template, $vars);
			$j++;
		}

		return preg_replace($replacement, $replacer, $content);
	}

	/**
	 * Method to return form template.
	 *
	 * @param   array  $opt       Plugin options.
	 * @param   mixed  $template  Form template.
	 * @param   array  $vars      Options names.
	 *
	 * @return  mixed  Form template.
	 */
	private function replacerAsHTML($opt, $template, $vars)
	{
		$opt = array_diff($opt, array(' '));

		if (count($opt) > 1)
		{
			$opt = array($opt[1], $opt[0]);  
		}
		elseif (count($opt) == 1 && !empty($opt[0]))
		{
			$opt = array($this->params->get('defsumm'), $opt[0]);
		}
		elseif (count($opt) == 1 && !empty($opt[1]))
		{
			$opt = array($opt[1], $this->params->get('wallet_number', ''));
		}
		else
		{ 
			$opt = array($this->params->get('defsumm'), $this->params->get('wallet_number', ''));
		}

		for ($i = 0; $i < count($opt); $i++)
		{
			$opt[$i] = $this->validOptions($i, $opt[$i]);
			if ($i == 0) 
			{
				$this->sliderInit($this->token, $opt[$i]);
			}
			$template = str_replace(array("<:$vars[$i]:>", "<:unicid:>"), array($opt[$i], $this->token), $template);
		}

		return $template;
	}

	/**
	 * Method to validate plugin options.
	 *
	 * @param   string  $i    Plugin option order number.
	 * @param   mixed   $var  Plugin option.
	 *
	 * @return  mixed  Validation result.
	 */
	private function validOptions($i, $var)
	{
		$res = '';

		switch ($i) 
		{
			case 0:
				$var = str_replace(array(' ', ','),array('', '.'), $var);
				if ((float)$var) 
				{
					$res = round((float)$var, 2);
				}
				else
				{
					$res = 0;
				}
				break;
			case 1: 
				if (preg_match('/\s*[0-9]{14}\s*/', $var, $var1)) 
				{
					$res = $var1[0];
				}
				else
				{
					$res = JText::_('PLG_CONTENT_JBM_DONATION_WALLET_NUMBER_IS_NOT_VALID');
				}
				break;
		}

		return $res;
	}

	/**
	 * Method to add slider.
	 *
	 * @param   string  $token  Token.
	 * @param   string  $sum    Donation amount.
	 *
	 * @return  void
	 */
	private function sliderInit($token, $sum)
	{
		JHtml::_('behavior.framework', 'more');

		JHtml::stylesheet('plg_jmb_donation/slider.css', false, true);
		JHtml::script('plg_jmb_donation/excanvas.js', false, true);
		JHtml::script('plg_jmb_donation/smile.js', false, true);

		$js = "
		window.addEvent('domready', function(){
			var el = $('elslider" . $token . "');
			var elsmile = $('smile" . $token . "');
			var inp = $('CompanySum" . $token . "');
			var sum = ('" . $sum . "')*100;
			
			var slider" . $token . " = new Slider(el, el.getElement('.knob'), {
				steps: sum*2,
				initialStep: sum,
				range: [sum/10, sum*2],
				onChange: function(val){
					inp.set('value', val/100);
					var pr = (val/(sum*2))*100;
					var sml = new Smile ($('smile" . $token . "'), pr, elsmile.getWidth()/150, elsmile.getProperty('rel').toInt(), elsmile.getProperty('color'));
				}
			});

			inp.addEvent('keyup', function(event) {
				event = new Event(event).stop();
				var sm = inp.get('value')*100;
				var cpr = (sm/(sum*2))*100;
				if (cpr > 100)	cpr = 100;
				new Smile ($('smile" . $token . "'), cpr, elsmile.getWidth()/150, elsmile.getProperty('rel').toInt(), elsmile.getProperty('color'));
			});
		});
		";

		JFactory::getDocument()->addScriptDeclaration($js);
	}
}
