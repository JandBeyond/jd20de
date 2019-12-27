<?php
/**
 * conferenceplus
 * @author Robert Deutz <rdeutz@googlemail.com>
 * @package conferenceplus
 **/

// No direct access
defined('_JEXEC') or die;

$displayData = new StdClass;

$headerlevel    = $this->params->get('headerlevel', 1);
$shl1 			= $headerlevel + 1;
$shl11 			= $headerlevel + 2;
$shl111			= $headerlevel + 3;
$prog			= $this->programme;

$baseLayoutPath = JPATH_ROOT . '/media/conferenceplus/layouts';
$title = JLayoutHelper::render('html.title', $displayData, $baseLayoutPath);

$doc = JFactory::getDocument()->setTitle($title);

$Itemid = Conferenceplus\Route\Helper::getItemid('programme');

$uri       = JUri::getInstance();
$returnurl = base64_encode($uri->toString(['path', 'query', 'fragment']));

$useTabs = count($prog) > 1;
?>

<!-- ************************** START: conferenceplus ************************** -->
<div class="conferenceplus programme" ng-app="jddSite" ng-controller="ProgramCtrl">
	<?php if ($useTabs) : ?>
		<?php echo $this->loadTemplate('tabs'); ?>
	<?php else : ?>
		plain list
	<?php endif; ?>
</div>

<script src="<?php echo JURI::base(true) . "/templates/jdd_17/js/angular.min.js"; ?>"></script>
<script src="<?php echo JURI::base(true) . "/templates/jdd_17/js/ngStorage.min.js"; ?>"></script>
<script src="<?php echo JURI::base(true) . "/templates/jdd_17/js/program.js"; ?>"></script>
<!-- ************************** END: conferenceplus ************************** -->
