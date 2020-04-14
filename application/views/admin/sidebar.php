  <nav class="navbar-default navbar-side hidden-print">
    <div class="sidebar-collapse">
      <?php if ($login['level']=="pegawai"): ?>
        <div class="user">
          <img src=" <?php echo base_url("asset/img/$login[foto_tanda_pegawai]"); ?>" class="img-circle">
          <h3><?php echo $login['nama_pegawai'] ?></h3>
          <p><?php echo $login['jabatan_pegawai'] ?></p>
        </div>
        <?php else: ?>
          <div class="user">
            <img src=" <?php echo base_url("asset/img/user.png"); ?>" class="img-circle">
            <h3><?php echo $login['nama_admin'] ?></h3>
          </div>
        <?php endif ?>
        <ul class="nav" id="main-menu">
          <li><a href="<?php echo base_url("admin"); ?>"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="<?php echo base_url("admin/admin/profile"); ?>"><i class="fa fa-user"></i> Profil</a></li>
          <!-- <li><a href="<?php echo base_url("admin/admin/profile"); ?>"><i class="fa fa-gear"></i> API Drive</a></li> -->

          <?php if ($login['level']=="admin"): ?>
           <li class="tr-tree">
            <a href="#"><i class="fa fa-file-o"></i> Data<i class="pull-right fa fa-angle-right"></i></a>
            <ul class="tr-tree-menu">
              <li><a href="<?php echo base_url("admin/admin"); ?>"><i class="fa fa-circle-o"></i> Pegawai</a></li>
             <li><a href="<?php echo base_url("admin/data/klien"); ?>"><i class="fa fa-circle-o"></i>Klien</a></li>
             <li><a href="<?php echo base_url("admin/data/arsip"); ?>"><i class="fa fa-circle-o"></i>Arsip</a></li>
             <li><a href="<?php echo base_url("admin/data/report"); ?>"><i class="fa fa-circle-o"></i>Report</a></li>

           </ul>
         </li>

       <?php endif ?>

       <?php if ($login['level']=="pegawai"): ?>

        <li class="tr-tree">
          <a href="#"><i class="fa fa-file-o"></i> Data<i class="pull-right fa fa-angle-right"></i></a>
          <ul class="tr-tree-menu">
           <li><a href="<?php echo base_url("admin/data/klien"); ?>"><i class="fa fa-circle-o"></i>Klien</a></li>
           <li><a href="<?php echo base_url("admin/data/permohonan"); ?>"><i class="fa fa-circle-o"></i>Permohonan</a></li>
           <li><a href="<?php echo base_url("admin/data/pengajuan"); ?>"><i class="fa fa-circle-o"></i>Administrasi Pengujian</a></li>
           <li><a href="<?php echo base_url("admin/data/arsip"); ?>"><i class="fa fa-circle-o"></i>Arsip</a></li>
           <li><a href="<?php echo base_url("admin/data/report"); ?>"><i class="fa fa-circle-o"></i>Report</a></li>
         </ul>
       </li>
     <?php endif ?>
     <li><a href="<?php echo base_url("admin/history"); ?>"><i class="fa fa-book"></i> Aktivitas Pegawai</a></li>
     <li><a href="<?php echo base_url("admin/admin/logout"); ?>"><i class="fa fa-sign-out icon"></i> Logout</a></li>
   </ul>
 </div>
</nav>

