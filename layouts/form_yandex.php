<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>
<div class="jmb-donation-form-yandex">
	<form class="form-inline" style="margin-bottom: 0" action="https://money.yandex.ru/charity.xml" method="post">
		<input id="merchant<?php echo $displayData->token; ?>" type="hidden" name="to" value="" />
		<input class="jmb-input input-small" type="text" id="amount<?php echo $displayData->token; ?>" name="CompanySum" value="<?php echo $displayData->params->get('amount'); ?>" size="4" />
		<button class="btn" type="submit"><?php echo JText::_('PLG_CONTENT_JMB_DONATION_SUBMIT'); ?></button>
		<?php if ($displayData->params->get('show_logo', 1)) : ?>
			<a class="jmb-logo" href="http://money.yandex.ru/" target="_blank">
				<img src="http://img.yandex.net/i/ym-logo.gif" width="90" height="39" border="0" alt="Яндекс.Деньги лого" />
			</a>
		<?php endif; ?>
		<?php if ($displayData->params->get('show_effects', 1)) : ?>
			<?php echo JLayoutHelper::render('effects', $displayData); ?>
		<?php endif; ?>
		<div class="clr"></div>
	</form>
</div>
