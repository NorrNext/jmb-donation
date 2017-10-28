<?php
/**
 * @package    Jmb_Donation
 * @author     Dmitry Rekun, Artem Valchuk, Lex, AllDar <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2017 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>

<form class="jmb-donation-form-yandex uk-form form-inline" action="https://money.yandex.ru/charity.xml" method="post">
	<?php if ($displayData->params->get('show_effects', 1)) : ?>
		<?php echo JLayoutHelper::render('effects', $displayData); ?>
	<?php endif; ?>
	<input 
		class="jmb-donation-input" 
		type="text" 
		id="amount<?php echo $displayData->token; ?>" 
		name="CompanySum" 
		value="<?php echo $displayData->params->get('amount'); ?>" 
		size="4" />
	<input id="merchant<?php echo $displayData->token; ?>" type="hidden" name="to" value="" />
	<button class="jmb-donation-button" type="submit" name="submit"/><?php echo JText::_('PLG_CONTENT_JMB_DONATION_SUBMIT'); ?></button>
	<?php if ($displayData->params->get('show_logo', 1)) : ?>
		<a class="jmb-donation-logo" href="http://money.yandex.ru/" target="_blank">
			<img src="http://img.yandex.net/i/ym-logo.gif" width="90" height="39" border="0" alt="Яндекс.Деньги лого" />
		</a>
	<?php endif; ?>
</form>
