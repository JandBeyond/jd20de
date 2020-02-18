<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_tags_similar
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$article = JTable::getInstance('content');
?>
<div class="tagssimilar<?php echo $moduleclass_sfx; ?>">
<?php if ($list) : ?>
	<?php foreach ($list as $i => $item) : ?>
		<div>
			<?php $article->load($item->content_item_id); ?>
			<?php $jcfields = FieldsHelper::getFields('com_content.article', $article, true); 
				  foreach($jcfields as $jcfield) {
					$jcfields[$jcfield->name] = $jcfield;
				  }
			?>
			<a href="<?php echo JRoute::_($item->link); ?>">
				<?php if (!empty($item->core_title)) : ?>
					<?php echo htmlspecialchars($item->core_title, ENT_COMPAT, 'UTF-8'); ?>
				<?php endif; ?>
			</a> <span>(<?php echo $jcfields['anfang']->value; ?> - <?php echo $jcfields['room']->value; ?>)</span>
			<?php echo $article->introtext; ?>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<span><?php echo JText::_('MOD_TAGS_SIMILAR_NO_MATCHING_TAGS'); ?></span>
<?php endif; ?>
</div>
