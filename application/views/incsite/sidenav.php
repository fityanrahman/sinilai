    <!-- header - nav-bar -->
    <body>
        <header>
            <nav>
                <div class="nav-wrapper">
                <a href="<?php echo base_url()?>" class="brand-logo left titleheader ">SINILAI AL-ISHLAH</a>
                    <ul id="slide-out" class="side-nav fixed">
                        <li><div class="user-view">
                        <div class="background">
                            <img src="<?php echo base_url(); ?>assets/office.jpg">
                        </div>
                        <a href="<?php echo base_url('profile'); ?>"><img class="circle pprofile" src="<?php echo base_url('assets/images/') . $this->session->userdata('avatar'); ; ?>"></a>
                        <a href="<?php echo base_url('profile'); ?>"><span class="white-text name"><?php echo ucwords(strtolower($this->session->userdata('username'))); ?></span></a>
                        <!-- <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a> -->
                        </div></li>
                        <li><a href="<?php echo base_url()?>"><i class="material-icons">home</i>Beranda</a></li>
                        <?php if($this->session->userdata('level') === '1'): ?>
                        <li><a href="<?php echo base_url('guru'); ?>"><i class="material-icons">book</i>Guru</a></li>
                        <li><a href="<?php echo base_url('mapel'); ?>"><i class="material-icons">book</i>Mapel</a></li>
                        <li><a href="<?php echo base_url('kelas'); ?>"><i class="material-icons">book</i>Kelas</a></li>
                        <li><a href="<?php echo base_url('siswa'); ?>"><i class="material-icons">book</i>Siswa</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo base_url('saran'); ?>"><i class="material-icons">book</i>Saran</a></li>
                        <li><a href="<?php echo base_url('katNilai'); ?>"><i class="material-icons">book</i>Nilai</a></li>             

                    <!-- <li><a class="waves-effect" href="<?php echo base_url('events'); ?>"><i class="material-icons">event</i>Events</a></li> -->
                    <li><div class="divider"></div></li>
                    <li><a class="subheader">Subheader</a></li>
                    <?php if($this->session->userdata('level') === '1'): ?>
                    <li><a class="waves-effect" href="<?php echo base_url('user'); ?>"><i class="material-icons">people</i>Users</a></li>
                    <?php endif; ?>
                    <li><a class="waves-effect" href="<?php echo base_url('profile'); ?>"><i class="material-icons">person</i>Profile</a></li>

                    <li><a class="waves-effect" href="<?php echo base_url('saran/add'); ?>"><i class="material-icons">lightbulb_outline</i>Saran</a></li>
                    <li><a class="waves-effect" href="<?php echo base_url().'auth/logout'?>"><i class="material-icons">power_settings_new</i>Sign Out</a></li>

                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>            
                </div>
            </nav>
            <!-- header - nav-bar -->
        </header>