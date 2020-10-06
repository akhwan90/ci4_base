<div class="sidebar">
    <nav class="sidebar-nav ps">
        <ul class="nav">
            <li class="nav-title">Menu Admin</li>
            <li class="nav-item open">
                <a class="nav-link" href="<?=base_url('index.php/adm');?>">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <?php 
            if ($this->session->userdata('level') == 1) {
                ?>
                <li class="nav-item open">
                    <a class="nav-link" href="<?=base_url('index.php/adm/aktifitas');?>">
                        <i class="nav-icon fa fa-th-list"></i> Aktifitas
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('index.php/barang');?>">
                    <i class="nav-icon fa fa-folder"></i> Data Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('index.php/transaksi_in');?>">
                    <i class="nav-icon fa fa-random"></i> Barang Masuk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('index.php/transaksi_out');?>">
                <i class="nav-icon fa fa-random"></i> Transaksi Keluar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('index.php/laporan');?>">
                <i class="nav-icon fa fa-print"></i> Laporan</a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
