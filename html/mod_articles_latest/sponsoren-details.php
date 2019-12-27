<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="sponsor-details">
	<div class="clearfix">
		<?php foreach ($list as $item) : ?>
			<?php $images   = json_decode($item->images); ?>
			<?php $urls = json_decode($item->urls); ?>
			<div class="sponsor-details-item">
				<div class="sponsor-details-img">
					<img src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo $item->title; ?>">
				</div>
				<p class="sponsor-details-name"><?php echo $item->title; ?></p>
				<div class="sponsor-details-desc">
					<?php echo $item->introtext; ?>
				</div>
				<p class="call2action button">
					<a href="<?php echo $urls->urla; ?>" target="_blank" itemprop="url"><?php echo $urls->urlatext; ?></a>
				</p>
			</div>
		<?php endforeach; ?>
	</div>
</div>
