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
<div class="sponsorlist">
	<ul>
	<?php foreach ($list as $item) : ?>
		<?php $images   = json_decode($item->images); ?>
		<?php $urls = json_decode($item->urls); ?>
		<li itemscope itemprop="sponsor" itemtype="https://schema.org/Organization">
			<a href="<?php echo $urls->urla; ?>" target="_blank" itemprop="url">
				<figure class="sponsor">
					<img src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo $item->title; ?>">
					<figcaption>
						<p itemprop="name">
							<?php echo $item->title; ?>
						</p>
					</figcaption>
				</figure>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>
</div>