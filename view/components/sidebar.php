<div class="menu_section">
	
	<div class="clearfix"></div>
	<ul class="nav side-menu">
		<?php if(($session->logged_in) && ($session->isMember())) { ?>
		<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Complaint List <span class="fa fa-angle-double-right"></span></a></li>
		<li><a href="comp_list.php"><i class="fa fa-list"></i> Complaint History <span class="fa fa-angle-double-right"></span></a></li>
		<?php } ?>
		<?php if(($session->logged_in) && ($session->isExpert())) { ?>
		<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-angle-double-right"></span></a></li>
		<li><a href="complaint.php"><i class="fa fa-list-alt"></i> Complaint <span class="fa fa-angle-double-right"></span></a></li>
		<li><a href="complaint_history.php"><i class="fa fa-dashboard"></i> Complaint History <span class="fa fa-angle-double-right"></span></a></li>
		<?php if( ($session->logged_in) && ($session->isExpert()) ) { ?>
		<li><a href="maintenance.php"><i class="fa fa-file-text"></i> Maintenance <span class="fa fa-angle-double-right"></span></a></li>
		<?php } } ?>
		<?php if(($session->logged_in) && ($session->isAdmin()) || ($session->isMaster())) { ?>
		<?php if( ($session->logged_in) && ($session->isAdmin()) ) { ?>
		<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-angle-double-right"></span></a></li>
		<?php } ?>
		<li><a href="complaint.php"><i class="fa fa-headphones"></i> Complaint <span class="fa fa-angle-double-right"></span></a></li>
		<li><a href="monitor.php"><i class="fa fa-desktop"></i> Monitor <span class="fa fa-angle-double-right"></span></a></li>
		<li><a href="complaint_history.php"><i class="fa fa-file-text-o"></i> Complaint History <span class="fa fa-angle-double-right"></span></a></li>
		<li><a href="maintenance.php"><i class="fa fa-file-text"></i> Maintenance <span class="fa fa-angle-double-right"></span></a></li>
		<?php if(($session->logged_in) && ($session->isAdmin())) { ?>
		<li><a href="users.php"><i class="fa fa-users"></i> Users <span class="fa fa-angle-double-right"></span></a></li>
		<?php } ?>
	</ul>
</div>
<div class="menu_section">
	<h3>REPORT MANAGEMENT</h3>
	<ul class="nav side-menu">
		<li><a href="reports.php"><i class="fa fa-files-o"></i> Report Manager <span class="fa fa-angle-double-right"></span></a></li>
		<?php if(($session->logged_in) && ($session->isAdmin())) { ?>	
		<li><a href="settings.php"><i class="fa fa-cogs"></i> Settings <span class="fa fa-angle-double-right"></span></a></li>
		</ul>
		<?php } } ?>
		<?php if( ($session->logged_in) && ($session->isExpert()) ) { ?>
		<ul class="nav side-menu">
			<h3>REPORT MANAGEMENT</h3>
		<li><a href="reports.php"><i class="fa fa-files-o"></i> Report Manager <span class="fa fa-angle-double-right"></span></a></li>
		</ul>
		<?php } ?>
</div>