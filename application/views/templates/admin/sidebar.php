<div class="site-menubar">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu" data-plugin="menu">
          <li class="site-menu-category">General</li>
            <?php if ($title == 'Dashboard'): ?>
            <li class="site-menu-item active">
            <?php else: ?>
            <li class="site-menu-item">
            <?php endif; ?>
            <a class="animsition-link" href="<?= base_url('admin'); ?>">
                    <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                    <span class="site-menu-title">Dashboard</span>
                </a>
          </li>



          <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
                    <i class="site-menu-icon fa-fw fas fa-file-word" aria-hidden="true"></i>
                    <span class="site-menu-title">Seminar</span>
                            <span class="site-menu-arrow"></span>
                </a>
            <ul class="site-menu-sub">

              <!-- <li class="site-menu-item has-sub">
                <a href="javascript:void(0)">
                  <span class="site-menu-title">Maps</span>
                  <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/map-google.html">
                      <span class="site-menu-title">Google Maps</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="pages/map-vector.html">
                      <span class="site-menu-title">Vector Maps</span>
                    </a>
                  </li>
                </ul>
              </li> -->

              <li class="site-menu-item">
                <a class="animsition-link" href="<?= base_url('admin/seminarAktif'); ?>">
                  <span class="site-menu-title">Seminar Aktif</span>
                </a>
              </li>

              <li class="site-menu-item">
                <a class="animsition-link" href="<?= base_url('admin/requestSeminar'); ?>">
                  <span class="site-menu-title">Request Seminar</span>
                  <div class="site-menu-label">
                    <span class="badge badge-info badge-round"><?= $getrequestseminarjumlah; ?></span>
                  </div>
                </a>
              </li>

              <li class="site-menu-item">
                <a class="animsition-link" href="<?= base_url('admin/seminarTolak'); ?>">
                  <span class="site-menu-title">Seminar ditolak</span>
                </a>
              </li>


            </ul>
            <?php if ($title == 'Data User'): ?>
            <li class="site-menu-item active">
            <?php else: ?>
            <li class="site-menu-item">
            <?php endif; ?>
              <a class="animsition-link" href="<?= base_url('admin/datauser'); ?>">
                      <i class="site-menu-icon fa-fw fas fa-user-friends" aria-hidden="true"></i>
                      <span class="site-menu-title">Data User</span>
                  </a>
            </li>
            <?php if ($title == 'Kategori'): ?>
            <li class="site-menu-item active">
            <?php else: ?>
            <li class="site-menu-item">
            <?php endif; ?>
              <a class="animsition-link" href="<?= base_url('admin/kategori'); ?>">
                      <i class="site-menu-icon fa-fw fas fa-tags" aria-hidden="true"></i>
                      <span class="site-menu-title">Data Kategori</span>
                  </a>
            </li>
          </li>



        </div>
    </div>
  </div>

  <div class="site-menubar-footer">
    <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
      data-original-title="Settings">
      <span class="icon md-settings" aria-hidden="true"></span>
    </a>
    <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
      <span class="icon md-eye-off" aria-hidden="true"></span>
    </a>
    <a href="<?= base_url('auth/logout'); ?>" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
      <span class="icon md-power" aria-hidden="true"></span>
    </a>
  </div></div>    <div class="site-gridmenu">
  <div>
    <div>
      <ul>
        <li>
          <a href="apps/mailbox/mailbox.html">
            <i class="icon md-email"></i>
            <span>Mailbox</span>
          </a>
        </li>
        <li>
          <a href="apps/calendar/calendar.html">
            <i class="icon md-calendar"></i>
            <span>Calendar</span>
          </a>
        </li>
        <li>
          <a href="apps/contacts/contacts.html">
            <i class="icon md-account"></i>
            <span>Contacts</span>
          </a>
        </li>
        <li>
          <a href="apps/media/overview.html">
            <i class="icon md-videocam"></i>
            <span>Media</span>
          </a>
        </li>
        <li>
          <a href="apps/documents/categories.html">
            <i class="icon md-receipt"></i>
            <span>Documents</span>
          </a>
        </li>
        <li>
          <a href="apps/projects/projects.html">
            <i class="icon md-image"></i>
            <span>Project</span>
          </a>
        </li>
        <li>
          <a href="apps/forum/forum.html">
            <i class="icon md-comments"></i>
            <span>Forum</span>
          </a>
        </li>
        <li>
          <a href="index.html">
            <i class="icon md-view-dashboard"></i>
            <span>Dashboard</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
