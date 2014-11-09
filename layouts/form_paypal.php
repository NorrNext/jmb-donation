<?php
/**
 * @package    Jmb_Donation
 * @author     Dmitry Rekun <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>
<div class="jmb-donation-form-paypal">
	<form class="form-inline" style="margin-bottom: 0" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		<input type="hidden" name="cmd" value="_xclick">
		<input id="merchant<?php echo $displayData->token; ?>" type="hidden" name="business" value="">
		<input class="jmb-input input-small" type="text" id="amount<?php echo $displayData->token; ?>" name="amount" value="<?php echo $displayData->params->get('amount'); ?>" size="4" style="margin-right: 5px;" />
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<?php if ($displayData->params->get('show_logo', 1)) : ?>
			<a class="jmb-logo" href="https://www.paypal.com/" target="_blank">
				<img src="https://www.paypalobjects.com/webstatic/i/logo/rebrand/ppcom.png" width="124" height="33" border="0" alt="PayPal logo" />
			</a>
		<?php endif; ?>
		<?php if ($displayData->params->get('show_effects', 1)) : ?>
			<?php echo JLayoutHelper::render('effects', $displayData); ?>
		<?php endif; ?>
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		<input type="hidden" name="currency_code" value="<?php echo $displayData->params->get('currency', 'EUR'); ?>">
	</form>
</div>
