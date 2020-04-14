  <nav class="navbar-default navbar-side hidden-print">
    <div class="sidebar-collapse">
        <div class="user">
            <img src=" <?php echo base_url("asset/img/klien/$login[foto_klien]"); ?>" class="img-circle">
            <h3><?php echo $login['nama_klien'] ?></h3>
        </div>
        <ul class="nav" id="main-menu">
            <li><a href="<?php echo base_url("klien/klien") ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?php echo base_url("klien/profile") ?>"><i class="fa fa-user"></i> Profil</a></li>
            <li><a href="<?php echo base_url("klien/klien/pengajuan") ?>"><i class="fa fa-paper-plane"></i>Permohonan</a></li>
            <li><a href="<?php echo base_url("klien/history") ?>"><i class="fa fa-book"></i>Riwayat Permohonan</a></li>
            <li><a href="<?php echo base_url("klien/klien/logout") ?>"><i class="fa fa-sign-out icon"></i> Logout</a></li>
        </ul>
    </div>
</nav>