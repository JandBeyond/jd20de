<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
JHtml::_('behavior.caption');

?>
<div class="item-page" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif; ?>
	<div class="item">
		<?php echo JLayoutHelper::render('joomla.content.full_image', $this->item); ?>
		<div class="item-content" itemprop="articleBody">
			<h2 itemprop="headline">
				<?php echo $this->escape($this->item->title); ?>
			</h2>
			<?php echo $this->item->event->afterDisplayTitle; ?>
			<?php echo $this->item->event->beforeDisplayContent; ?>
			<?php echo $this->item->text; ?>
			<?php echo $this->item->event->afterDisplayContent; ?>
		</div>
	</div>
	<?php echo JHtml::_('content.prepare', '{loadposition session}'); ?>
</div>
