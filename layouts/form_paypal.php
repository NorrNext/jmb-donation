<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar and b2z <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>
<div id="jmb-paypal">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		<input type="hidden" name="cmd" value="_xclick">
		<input id="merchant<?php echo $displayData->token; ?>" type="hidden" name="business" value="">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<input class="y-input" type="text" id="amount<?php echo $displayData->token; ?>" name="amount" value="<?php echo $displayData->params->get('amount'); ?>" size="4" style="margin-right: 5px;" />
		<div id="elslider<?php echo $displayData->token; ?>" class="slider y-input">
			<div class="knob y-input"></div>
		</div>
		<canvas class="y-smile" id="smile<?php echo $displayData->token; ?>"  width="75" height="75" color="#CC6600" rel="2"></canvas>
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>
