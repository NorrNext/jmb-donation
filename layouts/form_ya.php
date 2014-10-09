<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar <support@norrnext.com>
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
<form style="margin: 0; padding: 0;" action="https://money.yandex.ru/charity.xml" method="post">
	<div class="item-separator"></div>
	<div class="joo-ymaney">
		<input id="merchant<?php echo $this->token; ?>" type="hidden" name="to" value="" />
		<input class="y-input" type="submit" value="<?php echo JText::_('PLG_CONTENT_JBM_DONATION_SUBMIT'); ?>" style="margin-right: 5px;" />
		<input class="y-input" type="text" id="amount<?php echo $this->token; ?>" name="CompanySum" value="<?php echo $this->params->get('amount'); ?>" size="4" style="margin-right: 5px;" />
		<div id="elslider<?php echo $this->token; ?>" class="slider y-input">
			<div  class="knob y-input"></div>
		</div>
		<canvas class="y-smile" id="smile<?php echo $this->token; ?>"  width="75" height="75" color="#CC6600" rel="2"></canvas>
		<div class="clr"></div>
		<a class="y-logo" href="http://money.yandex.ru/" target="_blank">
			<img src="http://img.yandex.net/i/ym-logo.gif" width="90" height="39" border="0"/>
		</a>
	</div>
</form>
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
