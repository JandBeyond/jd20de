<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


<div class="overlay_big left">
	<?php if ($params->get('backgroundimage')) : ?>
	<div class="overlay_img">
		<img src="<?php echo $params->get('backgroundimage'); ?>" />
	</div>
	<?php endif; ?>
	<div>
		<div class="overlay_content">
			<?php echo $module->content; ?>
		</div>
	</div>
</div>