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
<div class="testimonial">
	<?php for ($i = 0; $i < $count; $i++) : ?>
		<input type="radio" name="nav" id="t<?php echo $i; ?>" <?php echo $i == 0 ? 'checked' : ''; ?>/>
		<label for="t<?php echo $i; ?>" class="test-<?php echo $i; ?>"></label>
	<?php endfor; ?>


		<?php for ($i = 0; $i < $count; $i++) : ?>
		<div class="t<?php echo $i; ?> slide">
			<blockquote>
				<span class="leftq quotes">&ldquo;</span><?php echo $list[$i]->introtext; ?><span class="rightq quotes">&bdquo; </span>
			</blockquote>
			<?php if ($params->get('img_intro_full') !== 'none' && !empty($list[$i]->imageSrc)) : ?>	
				<img class="round" src="<?php echo $list[$i]->imageSrc; ?>" alt="<?php echo $list[$i]->imageAlt; ?>">
			<?php endif; ?>

			<h4 class="newsflash-title">
				<?php echo $list[$i]->title; ?>
			</h4>
		</div>
	<?php endfor; ?>
</div>
<div class="mehr"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($list[0]->catid)); ?>"><i class="fas fa-angle-down"></i> Mehr Testimonials <i class="fas fa-angle-down"></i></a></div>

