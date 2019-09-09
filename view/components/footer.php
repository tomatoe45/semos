<div class="pull-left">Powered by Wizard I.T. Systems Corporation 2016</div>
<div class="pull-right">
	Logged as : <?= $session->userlevel == 9 ? 'Administrator' : ($session->userlevel == 8 ? 'Tech Support' : ($session->userlevel == 7 ? 'Expert Level' : 'Member'));?>
</div>
<div class="clearfix"></div>