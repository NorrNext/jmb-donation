<?php
/**
 * @package    Jmb_Donation
 * @author     Dmitry Rekun <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>

<form class="jmb-donation-form-paypal uk-form form-inline" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<?php if ($displayData->params->get('show_effects', 1)) : ?>
		<?php echo JLayoutHelper::render('effects', $displayData); ?>
	<?php endif; ?>
	<input 
		class="jmb-donation-input" 
		type="text" 
		id="amount<?php echo $displayData->token; ?>" 
		name="amount" 
		value="<?php echo $displayData->params->get('amount'); ?>" 
		size="4" />
	<input type="hidden" name="cmd" value="_xclick">
	<input id="merchant<?php echo $displayData->token; ?>" type="hidden" name="business" value="">
	<button class="jmb-donation-button" type="submit" name="submit"/><?php echo JText::_('PLG_CONTENT_JMB_DONATION_SUBMIT'); ?></button>
	<?php if ($displayData->params->get('show_logo', 1)) : ?>
		<a class="jmb-donation-logo" href="https://www.paypal.com/" target="_blank">
			<img src="https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.png" width="124" height="33" border="0" alt="PayPal logo" />
		</a>
	<?php endif; ?>	
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	<input type="hidden" name="currency_code" value="<?php echo $displayData->params->get('currency', 'EUR'); ?>">
</form>

