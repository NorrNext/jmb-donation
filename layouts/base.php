<?php
/**
 * @package    Jmb_Donation
 * @author     Lex, AllDar <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

$pos = strpos($displayData->params->get('merchant'), '@');

// Merchant is an email
if (false !== $pos)
{
	$mail = explode('@', $displayData->params->get('merchant'));
}
?>

<?php if ($displayData->params->get('provider') == 'paypal') : ?>
	<?php echo JLayoutHelper::render('form_paypal', $displayData); ?>
<?php endif; ?>

<?php if ($displayData->params->get('provider') == 'yandex') : ?>
	<?php echo JLayoutHelper::render('form_ya', $displayData); ?>
<?php endif; ?>

<?php if ($displayData->params->get('show_backlink', 1)) : ?>
	<div style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 7pt; text-decoration: none">
		<?php echo JText::_('PLG_CONTENT_JBM_DONATION_BACKLINK'); ?>
	</div>
<?php endif; ?>

<?php if (false !== $pos) : ?>
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
