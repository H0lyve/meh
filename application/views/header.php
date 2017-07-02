<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Meh</title>
    <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/clean-blog.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('public/jquery/jquery.js')?>"></script>
    <script src="<?php echo base_url('public/bootstrap/js/bootstrap.js')?>"></script>
</head>
<body>
   <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <span id="hidden_title"><b>Meh.</b><span class="sec_title">Dat blog born of boredom.</span></span>               
                <ul class="nav navbar-nav navbar-right">
                    <?php if($this->input->cookie('admin', TRUE) == '1'){ ?>
                    <li>
                        <a href="<?php echo base_url('index.php/modo_log')?>">Modo</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo base_url('')?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('index.php/about')?>">About</a>
                    </li>
                    <?php if($this->session->userdata('username') != false){ ?>
                    <li>
                        <a href="<?php echo base_url('index.php/login/logout_sess')?>">Borded to be <?= $this->session->userdata('username') ?></a>
                    </li>                            
                    <?php }elseif($this->input->cookie('log', TRUE) == '1'){ ?>
                    <li>
                        <a href="<?php echo base_url('index.php/login/logout_cook')?>">Borded to be <?= $this->input->cookie('name', TRUE) ?></a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url('index.php/login')?>">Login</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header id="intro-header" class="intro-header" style="background-image: url(<?php echo base_url('public/img/home-bg.jpg')?>)">
        <div class="container">
            <div class="row">
                <div class="col-lg-8  col-md-10 ">
                    <div class="site-heading">
                        <h1>Meh.</h1>
                        <hr class="small">
                        <span class="subheading">Dat blog born of boredom.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1">
                    <span id='arrow' class="glyphicon glyphicon-menu-up" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </header>
<script>
$('#arrow').click(function(){
    if($('#intro-header').hasClass('hiden_header') && $('#intro-header').height() == 50 ){        
        $('#hidden_title').toggle("fast");
        $('.intro-header').animate({height: '+=426px',width: 'auto'},1000,function(){
            $('.intro-header').removeClass('hiden_header');
            $('#arrow').removeClass('glyphicon-menu-down');
            $('#arrow').addClass('glyphicon-menu-up');
            $('#arrow').removeClass('hiden_arrow');
        });        
    }else if ($('#intro-header').height() == 476 ){
        $('.intro-header').animate({height: '-=426px',width: '102%'},1000,function(){
            $('.intro-header').addClass('hiden_header');
            $('#arrow').removeClass('glyphicon-menu-up');
            $('#arrow').addClass('hiden_arrow');
            $('#arrow').addClass('glyphicon-menu-down');
            $('#hidden_title').toggle("fast");
        });
    }
});
</script>