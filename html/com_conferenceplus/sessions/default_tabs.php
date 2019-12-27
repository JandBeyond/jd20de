<?php
/**
 * conferenceplus
 * @author Robert Deutz <rdeutz@googlemail.com>
 * @package conferenceplus
 **/

// No direct access
defined('_JEXEC') or die;

$baseLayoutPath = JPATH_ROOT . '/media/conferenceplus/layouts';

$prog	= $this->programme;
$useTabs = count($prog) > 1;

$activeTab  = $this->input->get('tabid', 0);
$roomsCount = count($this->rooms);

$sessionData = [];

JHtml::_('jquery.framework');
$document = JFactory::getDocument();
$document->addScriptDeclaration('
	jQuery( document ).ready(function( $ ) {
		$(".programme .nav.nav-tabs a").click(function(e) {
			e.preventDefault();
			$($(this).attr("href")).show();
			$($(this).attr("href")).siblings().hide();
			$(this).parent().addClass("active");
			$(this).parent().siblings().removeClass("active");
		});

		$($(".programme .nav.nav-tabs .active a").attr("href")).siblings().hide();
	});
');

$Itemid = Conferenceplus\Route\Helper::getItemid();
$returnurl = base64_encode(JUri::getInstance()->toString(['path', 'query', 'fragment']));
?>
<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach ($prog as $key => $p) : ?>
			<li role="presentation"<?php echo $activeTab == $key ? ' class="active"' : '' ;?>>
				<a href="#ptab<?php echo $key; ?>" role="tab" data-toggle="tab"><?php echo $p[0]->dayname; ?></a>
			</li>
		<?php endforeach; ?>
		<li role="presentation">
			<a href="#ptabreminder" role="tab" data-toggle="tab">Merkliste</a>
		</li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<?php foreach ($prog as $key => $p) : ?>
			<div role="tabpanel" class="tab-pane<?php echo $activeTab == $key ? ' active' : '' ;?>" id="ptab<?php echo $key; ?>">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="span2"><?php echo JText::_('COM_CONFERENCEPLUS_TIME'); ?></th>
							<?php foreach ($this->rooms as $room) : ?>
								<th class="span2">
									<?php echo $room->name; ?>
								</th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($p as $slot) : ?>
							<tr class="time slotype<?php echo $slot->slottype; ?>">
								<td class="time slotype<?php echo $slot->slottype; ?>">
									<?php echo substr($slot->stime, 0, 5); ?>&nbsp;-&nbsp;
									<?php echo substr($slot->etime, 0, 5); ?>
								</td>
								<?php if ($slot->slottype == 0 && ! empty($slot->sessionsOrdered)) : ?>
									<?php for($i = 0; $i < $roomsCount; $i++) : ?>
										<td class="slotype<?php echo $slot->slottype; ?>" data-th="<?php echo $this->rooms[$i]->name; ?>">
											<?php $session = $slot->sessionsOrdered[$i]; ?>
											<?php 
												$sessionData[] = [
													"title" => $session->title, 
													"room" => $this->rooms[$i]->name, 
													"id" => (int) $session->conferenceplus_session_id, 
													"slot" => substr($slot->stime, 0, 5) . " - " . substr($slot->etime, 0, 5), 
													"day" => $p[0]->dayname, 
													"starttime" => (int) str_replace(":","",substr($slot->stime, 0, 5)),
													"link" => "index.php?option=com_conferenceplus&view=session&id=" . $session->conferenceplus_session_id . "&Itemid=" . $Itemid . " &return=" . $returnurl
												]; 
											?>
											<?php if (property_exists($session, 'tba')) : ?>
												<?php //echo $session->tba; ?>
											<?php else : ?>
												<?php echo JLayoutHelper::render('html.session', $session, $baseLayoutPath); ?>
												<button class="addtoremindlist" ng-class="onList(<?php echo $session->conferenceplus_session_id; ?>) ? 'selected' : ''" ng-click="toggleSession(<?php echo $session->conferenceplus_session_id; ?>)">Zur Merkliste</button>
											<?php endif; ?>
										</td>
									<?php endfor; ?>
								<?php else : ?>
									<td colspan="<?php echo $roomsCount; ?>" class="slotype<?php echo $slot->slottype; ?>" data-th="<?php echo $this->rooms[0]->name; ?>">
										<?php if ( ! empty($slot->sessionsOrdered)) : ?>
											<?php $session = $slot->sessionsOrdered[0]; ?>
											<?php 
												$sessionData[] = [
													"title" => $session->title, 
													"room" => "Raum 1", 
													"id" => (int) $session->conferenceplus_session_id, 
													"slot" => substr($slot->stime, 0, 5) . " - " . substr($slot->etime, 0, 5), 
													"day" => $p[0]->dayname, 
													"starttime" => (int) str_replace(":","",substr($slot->stime, 0, 5)),
													"link" => "index.php?option=com_conferenceplus&view=session&id=" . $session->conferenceplus_session_id . "&Itemid=" . $Itemid . " &return=" . $returnurl
												]; 
											?>
											<?php echo JLayoutHelper::render('html.session', $session, $baseLayoutPath); ?>
											<button class="addtoremindlist"  ng-class="onList(<?php echo $session->conferenceplus_session_id; ?>) ? 'selected' : ''" ng-click="toggleSession(<?php echo $session->conferenceplus_session_id; ?>)">Zur Merkliste</button>
										<?php else : ?>
											<?php if ($slot->slottype == 4) : ?>
												<span class="glyphicon glyphicon-cutlery"></span>&nbsp;<?php echo $slot->name ; ?>
											<?php else  : ?>
												<?php echo $slot->name ; ?>
											<?php endif; ?>
										<?php endif; ?>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endforeach; ?>
		<div role="tabpanel" class="tab-pane" id="ptabreminder">
			<br />
			<h4>Ihre Merkliste</h4>

			<p ng-hide="hasItems()">In Ihrer Merkliste befinden sich keine Einträge</p>

			<div ng-repeat="(day, daysessions) in sessions" ng-show="hasItems()">
				<h5>{{ day }}</h5>
				<ul>
			        <li ng-repeat="session in daysessions">
			        	{{ session.slot }}, {{ session.room }}:<br /> <a ng-href="{{session.link}}">{{ session.title }}</a> - <span style="cursor:pointer" ng-click="toggleSession(session.id)">x</span>
			        </li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script>
	window.sessionData = <?php echo json_encode($sessionData); ?>;
</script>