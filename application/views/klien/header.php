<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Klien - PUSFID</title>
    <link rel="stylesheet" href=" <?php echo base_url("asset/css/bootstrap.min.css"); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href=" <?php echo base_url("asset/plugin/font-awesome/css/font-awesome.css"); ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href=" <?php echo base_url("asset/css/sendiri.css"); ?>">
</head>
<body>

    <div id="wrapper">
        <header class="main-header hidden-print">

            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".sidebar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">KLIEN PUSFID</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-bell-o" style="color:white;"></i>
                              <span class="label label-warning"><?php echo count($notif); ?></span> 
                          </a>
                          <ul class="dropdown-menu">
                            <?php foreach ($notif as $key => $value): ?>
                                <li><a href="<?php echo base_url("klien/history/laporan/$value[id_permohonan]"); ?>" style="color: red">*<?php echo $value['judul_permohonan']; ?> - Laporan Akhir</a></li>
                                <li role="separator" class="divider"></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>