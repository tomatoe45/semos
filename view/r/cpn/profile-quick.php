<div class="profile_pic">
  <img id="side_pic" src="../profile/<?= $session->photo ? $session->photo : '../../images/user.png'; ?>" alt="..." class="img img-circle profile_img">
</div>
<div class="profile_info">
  <span>Welcome,</span>
  <h2><?= ucfirst(strtolower($session->firstname)); ?></h2>
</div>