<?php
/**
 * @package    Jmb_Donation
 * @author     Dmitry Rekun <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

/**
 * Description field class.
 *
 * @package  Jmb_Donation
 * @since    1.0
 */
class JmbFormFieldDescription extends JFormField
{
	/**
	 * Field name.
	 *
	 * @var  string
	 */
	protected $type = 'description';

	/**
	 * Method to get field input.
	 *
	 * @return  string  HTML output.
	 */
	protected function getInput()
	{
		$html = '<div class="row-fluid">';
		$html .= '<img class="pull-left img-polaroid" style="margin-right:10px;width:125px;" src="' . JUri::root() . '/plugins/content/jmb_donation/fields/jmb-donation.png" />';
		$html .= JText::_('PLG_CONTENT_JMB_DONATION_DESCRIPTION');
		$html .= '</div>';
		$html .= '<div class="row-fluid" style="margin-top: 20px">';
		$html .= JText::_('PLG_CONTENT_JMB_DONATION_ABOUT_NORRNEXT');
		$html .= $this->getSocialButtons();
		$html .= $this->getPaypalDonation();
		$html .= '</div>';

		return $html;
	}

	/**
	 * Method to get social buttons
	 *
	 * @return  string  Social buttons layout.
	 *
	 * @since   1.0
	 */
	private function getSocialButtons()
	{
		$lang = substr(JFactory::getLanguage()->getTag(), 0, 2);

		$html = '
			<a href="https://twitter.com/norrnext"
				class="twitter-follow-button" data-show-count="true" data-show-screen-name="false" data-lang="' . $lang . '"></a>
			<script>
				! function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (!d.getElementById(id)) {
						js = d.createElement(s);
						js.id = id;
						js.src = "//platform.twitter.com/widgets.js";
						fjs.parentNode.insertBefore(js, fjs);
					}
				}(document, "script", "twitter-wjs");
			</script>
			<iframe
				src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Ffacebook.com%2Fnorrnext&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21"
				scrolling="no"
				frameborder="0"
				style="border:none; overflow:hidden; height:20px; width:120px"
				allowTransparency="true">
			</iframe><br />
			<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
			<g:plus href="https://plus.google.com/108999239898392136664" width="200" height="131"></g:plus>
		';

		return $html;
	}

	/**
	 * Method to get PayPal donation layout
	 *
	 * @return  string  PayPal donation form layout
	 *
	 * @since   1.0
	 */
	private function getPaypalDonation()
	{
		$html = '<div>
			<script async="async" src="https://www.paypalobjects.com/js/external/paypal-button.min.js?merchant=eugene.sivokon@gmail.com"
				data-button="donate"
				data-name="NorrNext - Joomla & Pagekit extensions. JMB Donation plugin."
				data-lc="' . JFactory::getLanguage()->getTag() . '"
			></script>
		</div>';

		return $html;
	}
}
