<?php
require_once '../helper/globals.php';
?>

<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.php">
        <img src="<?= $BASE_URL ?>/images/logo.jpg" alt="logo" width="150">
      </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.php">EF</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="index.php"><i class="fas fa-fire"></i> <span>Home</span></a></li>
      <li class="menu-header">Main Feature</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Dokter</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../dokter/index.php">List</a></li>
          <li><a class="nav-link" href="../dokter/create.php">Tambah Data</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Pasien</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../pasien/index.php">List</a></li>
          <li><a class="nav-link" href="../pasien/create.php">Tambah Data</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Poli</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../poli/index.php">List</a></li>
          <li><a class="nav-link" href="../poli/create.php">Tambah Data</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Obat</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../obat/index.php">List</a></li>
          <li><a class="nav-link" href="../obat/create.php">Tambah Obat</a></li>
        </ul>
      </li>
    </ul>
  </aside>
</div>
