<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$count = count($list);
?>
<div class="cd-testimonials-wrapper cd-container">
	<ul class="cd-testimonials">
		<?php for ($i = 0; $i < $count; $i++) : ?>
		<li>
			<h4 class="newsflash-title">
				<?php echo $list[$i]->title; ?>
			</h4>
			<p><?php echo $list[$i]->introtext; ?></p>
			<div class="cd-author">
				<?php if ($params->get('img_intro_full') !== 'none' && !empty($list[$i]->imageSrc)) : ?>	
					<img class="round" src="<?php echo $list[$i]->imageSrc; ?>" alt="<?php echo $list[$i]->imageAlt; ?>">
				<?php endif; ?>
				<ul class="cd-author-info">
					<li>Name</li>
				</ul>
			</div>
		</li>
		<?php endfor; ?>
	</ul>
</div>
<div class="mehr"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($list[0]->catid)); ?>"><i class="fas fa-angle-down"></i> Mehr Testimonials <i class="fas fa-angle-down"></i></a></div>



	<?php for ($i = 0; $i < $count; $i++) : ?>
		<input type="radio" name="nav" id="t<?php echo $i; ?>" <?php echo $i == 0 ? 'checked' : ''; ?>/>
		<label for="t<?php echo $i; ?>" class="test-<?php echo $i; ?>"></label>
	<?php endfor; ?>

