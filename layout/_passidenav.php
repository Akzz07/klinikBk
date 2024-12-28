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
      <li><a class="nav-link" href="../dashboard/pasien.php"><i class="fas fa-fire"></i> <span>Home</span></a></li>
      <li class="menu-header">Main Feature</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Periksa</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../daftarpoli/index.php">Daftar Poli</a></li>
          <li><a class="nav-link" href="../daftarpoli/index.php">Lihat Histori</a></li>
        </ul>
      </li>
      
    </ul>
  </aside>
</div>
