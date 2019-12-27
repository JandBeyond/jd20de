<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<ul class="category-module<?php echo $moduleclass_sfx; ?> mod-list schedule">
	<?php if ($grouped) : ?>
		<?php foreach ($list as $group_name => $group) : ?>
		<li>
			<div class="time mod-articles-category-group"><?php echo JText::_($group_name); ?></div>
			<ul class="conf">
				<?php foreach ($group as $item) : ?>
					<?php $jcfields = FieldsHelper::getFields('com_content.article', $item, true); 
						  foreach($jcfields as $jcfield) {
							$jcfields[$jcfield->name] = $jcfield;
						  }
					?>
					<li class="slot <?php if(($jcfields['keynote']->rawvalue) == 1) { echo "full"; } ?>">
						<div class="slot-inner">
							<span class="cat-label <?php echo $jcfields['kategorie']->rawvalue; ?>"><?php echo $jcfields['kategorie']->rawvalue; ?></span>
							<?php if(($jcfields['general']->rawvalue) == 1) : ?>
							<h4><?php echo $item->title; ?></h4>
							<?php else : ?>
							<h4>
								<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
								<?php echo $item->title; ?>
								<?php if(!empty($jcfields['sprache']->value)) : ?>
									<span> [<?php echo $jcfields['sprache']->rawvalue; ?>]</span>
								<?php endif; ?>
								</a>
							</h4>
							<?php endif; ?>
							<?php if(!empty($jcfields['sprecher']->value)) : ?>
							<p><i class="fas fa-user"></i> <?php echo $jcfields['sprecher']->value; ?></p>
							<?php endif; ?>
						</div>
						<?php if(!empty($jcfields['room']->value)) : ?>
						<div class="slot-inner location-<?php echo $jcfields['room']->rawvalue; ?>"><i class="fas fa-map-marker-alt"></i> <?php echo $jcfields['room']->name; ?></div>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
