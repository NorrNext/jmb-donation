<?php
/**
 * @package    Jmb_Donation
 * @author     Dmitry Rekun, Artem Valchuk <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2015 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

JHtml::stylesheet('plg_jmb_donation/style.css', false, true);

$pos = strpos($displayData->params->get('merchant'), '@');

// Merchant is an email
if (false !== $pos)
{
	$mail = explode('@', $displayData->params->get('merchant'));
}

?>
<div class="jmb-donation">

	<?php if ($displayData->params->get('show_smile', 1) && $displayData->params->get('show_effects', 1) && !$displayData->params->get('show_image')) : ?>
		<canvas
			id="smile<?php echo $displayData->token; ?>"
			class="jmb-donation-smile"
			width="<?php echo $displayData->params->get('smile_width', 100); ?>"
			height="<?php echo $displayData->params->get('smile_width', 100); ?>"
			color="<?php echo $displayData->params->get('smile_colour', '#CC6600'); ?>"
			rel="2">
		</canvas>
	<?php endif; ?>

	<?php if ($displayData->params->get('show_image', 0)) : ?>
		<div class="jmb-donation-image">
			<img alt="" src="<?php echo $displayData->params->get('show_image'); ?>" />
		</div>
	<?php endif; ?>

	<?php if ($displayData->params->get('donation_text')) :
		echo '<div class="jmb-donation-text">' . htmlspecialchars($displayData->params->get('donation_text')). '</div>';
	 endif; ?>
	 
	<?php if ($displayData->params->get('provider') == 'paypal') : ?>
		<?php echo JLayoutHelper::render('form_paypal', $displayData); ?>
	<?php endif; ?>

	<?php if ($displayData->params->get('provider') == 'yandex') : ?>
		<?php echo JLayoutHelper::render('form_yandex', $displayData); ?>
	<?php endif; ?>

	<?php if ($displayData->params->get('show_backlink', 1)) : ?>
		<div style="text-align: right; clear: both; font-family: Arial, Helvetica, sans-serif; font-size: 7pt; text-decoration: none">
			<?php echo JText::_('PLG_CONTENT_JMB_DONATION_BACKLINK'); ?>
		</div>
	<?php endif; ?>

</div>

<?php if (false !== $pos) :
	// Protect an email from spam bots ?>
	<script>
		<!--
		var a = '<?php echo $mail[0]; ?>';
		var b = '@';
		var c = '<?php echo $mail[1]; ?>';
		var d = a + b + c;
		var elem = document.getElementById('merchant<?php echo $displayData->token; ?>');
		elem.value = d;
		//-->
	</script>
<?php endif; ?>

<?php if (false === $pos) : ?>
	<script>
		<!--
		var elem = document.getElementById('merchant<?php echo $displayData->token; ?>');
		elem.value = '<?php echo $displayData->params->get('merchant'); ?>';
		//-->
	</script>
<?php endif; ?>
