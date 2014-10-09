<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>
<form style="margin: 0; padding: 0;" action="https://money.yandex.ru/charity.xml" method="post">
	<div class="item-separator"></div>
	<div class="joo-ymaney">
		<input id="merchant<?php echo $displayData->token; ?>" type="hidden" name="to" value="" />
		<input class="y-input" type="submit" value="<?php echo JText::_('PLG_CONTENT_JBM_DONATION_SUBMIT'); ?>" style="margin-right: 5px;" />
		<input class="y-input" type="text" id="amount<?php echo $displayData->token; ?>" name="CompanySum" value="<?php echo $displayData->params->get('amount'); ?>" size="4" style="margin-right: 5px;" />
		<div id="elslider<?php echo $displayData->token; ?>" class="slider y-input">
			<div  class="knob y-input"></div>
		</div>
		<canvas class="y-smile" id="smile<?php echo $displayData->token; ?>"  width="75" height="75" color="#CC6600" rel="2"></canvas>
		<div class="clr"></div>
		<a class="y-logo" href="http://money.yandex.ru/" target="_blank">
			<img src="http://img.yandex.net/i/ym-logo.gif" width="90" height="39" border="0"/>
		</a>
	</div>
</form>
