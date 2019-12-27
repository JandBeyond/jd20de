

<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');
?>
<div class="blog<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
		<h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
				<span class="subheading-category"><?php echo $this->category->title; ?></span>
			<?php endif; ?>
		</h2>
	<?php endif; ?>

	<?php
		$introcount = (count($this->intro_items));
		$counter = 0;
	?>

    <div class="multiple-category-area">

	<?php if (!empty($this->intro_items)) : ?>
		<?php foreach ($this->intro_items as $key => &$item) : ?>
			<?php 
				$subcatalias = $this->item->category_alias; 
			?>
			<div class="sponsor-<?php echo $subcatalias; ?>">
			<?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
			<?php if ($rowcount == 1) : ?>
				<?php $row = $counter / $this->columns; ?>
                <?php 
					$this->item = &$item;
 					$subcat = $this->item->category_title;
 					if ($subcat != $psubcat) : ?>
				    <h4><?php echo $subcat; ?></h4>
					<?php endif;
 					$psubcat = $subcat;
 				?>
				<div class="sponsor-details">
			<?php endif; ?>
					<div class="clearfix">
						<div class="sponsor-details-item <?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
							itemprop="organization" itemscope itemtype="https://schema.org/Organization">
							<?php
							$this->item = & $item;
							echo $this->loadTemplate('item');
							?>
						</div>
						<!-- end item -->
						<?php $counter++; ?>
					</div><!-- end clearfix -->
			<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
				</div><!-- end details -->
			<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>

    </div><!-- end multiple-category-area -->
</div>

