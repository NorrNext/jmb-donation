<?php
/**
 * @package    Jmb_Donation
 * @author     Dmitry Rekun <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;
?>
<div id="elslider<?php echo $displayData->token; ?>" class="slider jmb-input">
	<div class="knob jmb-input"></div>
</div>
<?php if ($displayData->params->get('show_smile', 1)) : ?>
	<canvas
		id="smile<?php echo $displayData->token; ?>"
		class="jmb-smile"
		width="<?php echo $displayData->params->get('smile_width', 75); ?>"
		height="<?php echo $displayData->params->get('smile_width', 75); ?>"
		color="<?php echo $displayData->params->get('smile_colour', '#CC6600'); ?>"
		rel="2">
	</canvas>
<?php endif; ?>
