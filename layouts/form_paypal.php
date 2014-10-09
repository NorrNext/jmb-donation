<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar and b2z <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

$pos = strpos($this->params->get('merchant'), '@');

if (false !== $pos)
{
	$mail = explode('@', $this->params->get('merchant'));
}
?>
<div id="jmb-paypal">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
		<input type="hidden" name="cmd" value="_xclick">
		<input id="merchant<?php echo $this->token; ?>" type="hidden" name="business" value="">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<input class="y-input" type="text" id="amount<?php echo $this->token; ?>" name="amount" value="<?php echo $this->params->get('amount'); ?>" size="4" style="margin-right: 5px;" />
		<div id="elslider<?php echo $this->token; ?>" class="slider y-input">
			<div class="knob y-input"></div>
		</div>
		<canvas class="y-smile" id="smile<?php echo $this->token; ?>"  width="75" height="75" color="#CC6600" rel="2"></canvas>
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>
<div style="text-align: right">
	<a href="http://joomlablog.ru/rasshireniya-joomla/206-jmb-donation" target="_blank" style="font-family: arial,helvetica,sans-serif; font-size: 7pt;text-decoration:none;color:#bfbfbf;"><?php echo JText::_('PLG_CONTENT_JBM_DONATION_JOOMLABLOG_EXTENSIONS'); ?></a>
</div>

<?php if (false !== $pos) : ?>
	<script>
		<!--
		var a = '<?php echo $mail[0]; ?>';
		var b = '@';
		var c = '<?php echo $mail[1]; ?>';
		var d = a + b + c;
		var elem = document.getElementById('merchant<?php echo $this->token; ?>');
		elem.value = d;
		//-->
	</script>
<?php endif; ?>

<?php if (false === $pos) : ?>
	<script>
		<!--
		var elem = document.getElementById('merchant<?php echo $this->token; ?>');
		elem.value = '<?php echo $this->params->get('merchant'); ?>';
		//-->
	</script>
<?php endif; ?>
