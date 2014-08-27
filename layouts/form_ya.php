<?php
/**
 * @package    Jmb_donation
 * @author     Lex, AllDar
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>
<form style="margin: 0; padding: 0;" action="https://money.yandex.ru/charity.xml" method="post">
	<div class="item-separator"></div>
	<div class="joo-ymaney">
		<input type="hidden" name="to" value="<:wallet_number:>" />  
		<input class="y-input" type="submit" value="<?php echo JText::_('PLG_CONTENT_JBM_DONATION_SUBMIT'); ?>" style="margin-right: 5px;" />
		<input class="y-input" type="text" id="CompanySum<:unicid:>" name="CompanySum" value="<:money_amount_default:>" size="4" style="margin-right: 5px;" />
		<div id="elslider<:unicid:>" class="slider y-input">
			<div  class="knob y-input"></div>
		</div>
		<canvas class="y-smile" id="smile<:unicid:>"  width="75" height="75" color="#CC6600" rel="2"></canvas>
		<div class="clr"></div>
		<strong><?php echo JText::_('PLG_CONTENT_JBM_DONATION_MONEY_TYPE'); ?></strong> <?php echo JText::_('PLG_CONTENT_JBM_DONATION_2_ACCOUNT'); ?>  <span class="y-red"><:wallet_number:></span><img src="http://img.yandex.net/i/x.gif" width="1" height="10" />

		<a class="y-logo" href="http://money.yandex.ru/">
			<img src="http://img.yandex.net/i/ym-logo.gif" width="90" height="39" border="0"/>
		</a>
	</div>
	<div class="item-separator"></div>
</form>
<div style="text-align: right">
	<a href="http://joomlablog.ru/rasshireniya-joomla/206-jmb-donation" target="_blank" style="font-family: arial,helvetica,sans-serif; font-size: 7pt;text-decoration:none;color:#bfbfbf;"><?php echo JText::_('PLG_CONTENT_JBM_DONATION_JOOMLABLOG_EXTENSIONS'); ?></a>
</div>
