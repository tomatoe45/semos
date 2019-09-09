<div class="nav_menu">
  <nav>
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <li class="">
      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
       <img src="../profile/<?= $session->photo ? $session->photo : '../../images/user.png'; ?>" alt="">
          <?= ucfirst(strtolower($session->firstname));  ?>
          <span class=" fa fa-angle-down"></span>
      </a>
        <ul class="dropdown-menu dropdown-usermenu pull-right">
          <li><a href="../profile.php?username=<?= $session->username; ?>">Profile</a></li>
          <li><a href="../profile_settings.php"> <span>Settings</span></a></li>
          <li class="hide"><a href="help.php">Help</a></li>
          <li><a href="../include/process.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
        </ul></li>

    <?php if(($session->logged_in) && ($session->isMaster()) || ($session->isAdmin())) { ?>

      <li role="presentation" class="dropdown">
      <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
         <i class="fa fa-bell-o"></i>
          <span id="" class="badge bg-green" style="color: #FFFFFF;"><span id="notify">0</span></span>
      </a>
      <ul id="menu1"
          class="dropdown-menu list-unstyled msg_list scroll-view"
          role="menu">
          <?php foreach ($g_comp as $cn): ?>
            
          <li>
            <a href="../complaint_r.php?comp_id=<?= $cn['comp_id']; ?>">
              <span class="message"> 
                <?= strtoupper($cn['subject']); ?><br/>
                <code><?= $cn['dept_name']; ?></code>
              </span>
            
          </a></li>
          <?php endforeach ?>
          <li>
            <div class="text-center">
              <a href="complaint.php?Complaint list"> <strong>See All Alerts</strong> <i class="fa fa-angle-right"></i>
              </a>
            </div>
          </li>
        </ul></li>
        <?php } ?>
      <!-- /alert -->
    </ul>
  </nav>
</div>
