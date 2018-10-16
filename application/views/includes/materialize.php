<!doctype html>
<?php
if ( function_exists( 'date_default_timezone_set' ) )
date_default_timezone_set('Asia/Jakarta');
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="CACHE-CONTROL" content="NO-CACHE,NO-STORE,must-revalidate">
	<meta http-equiv="PRAGMA" content="NO-CACHE">
	<meta http-equiv="expires" content="0">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php header("Cache-Control: no-store,no-cache,must-revalidate");?>
	<title><?php if(isset($title)){echo $title;} ?></title>
	<link rel="icon" href="<?php echo base_url('/images/icon/pin-land.png')?>" type="image/png">
	<link rel="stylesheet" href="<?php echo base_url('assets/materialize/materialize.min.css') ?>"  media="screen,projection"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/js/select2/select2.min.css') ?>"  media="screen,projection"/>
  <script src="<?php echo base_url('assets/jQuery/jquery-2.2.3.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/jQueryUI/jquery-ui.min.js');?>"></script>
  <script src="<?php echo base_url('assets/materialize/materialize.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/select2.min.js'); ?>"></script>
</head>
<body>
    <!-- Fixed Navbar-->
    <div class="row navbar-fixed">
        <nav>
            <div class="nav-wrapper <?php if(isset($color)){echo $color;}else{echo 'blue darken-2';} ?> z-depth-2">
              <ul class="left">
              <li><a href="#" data-activates="side-navigation" class="button-collapse show-on-large"><i class="material-icons">menu</i></a></li>
              <li><a href="<?php echo site_url('peta'); ?>" class="brand-logo waves-effect"><i class="material-icons prefix white-text">room</i> Sistem Info Grafis 1.0 </a></li>
              </ul>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="<?php echo base_url('peta'); ?>">Index</a></li>
                </li>
              </ul>
            </div><!-- End of Nav Wrapper-->
          </nav>
    </div>  
    <!-- End of Fixed Navbar-->
    <div class="side-nav z-depth-3 <?php if(isset($color)){echo $color;}else{echo 'blue darken-2';} ?> darken-1 white-text" id="side-navigation">
        <?php $this->load->view('includes/sidebar'); ?>
    </div>
    <div class="row">
      <div class="col m12 center">
          <div class="card-content" style="margin-top: 8px;font-size:25px;" id="message">
              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
          </div><!-- End of Message Div -->
      </div><!-- End of Col m12 -->
    </div><!-- End of Row -->
    <div class="row">
        <div class="container">
                <?php $this->load->view('includes/main_content'); ?>
        </div><!-- End of Container -->
    </div><!-- End of Row -->
    <footer class="page-footer grey darken-4 z-depth-2">
          <div class="footer-copyright">
            <div class="container">
                    <strong class="left white-text">Copyright &copy; 2018-2020 <a class="white-text" href="https://twitter.com/arief_sumaila">Developer</a>. All rights
		reserved.</strong>
            <a href="#" title="Top" alt="Top"><span class="right"><i class="large material-icons white-text">expand_less</i></span></a>
            </div>
          </div>
        </footer><!-- End of Footer -->
    <script type="text/javascript">
      $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('select').material_select();
        $('.tooltip').tooltip();
        $('.select2').select2();
        			//This Will Prevent User To Submit The Form on Press Enter Key
			$(document).on('keyup keypress', ':input:not(textarea):not([type=submit])', function(e) {
				  if(e.keyCode == 13) {
				    e.preventDefault();
				    return false;
				  }
				});
			//Animate Alert
			$('#message').slideDown('slow').delay(3000).slideUp('slow');
      });
       </script>
</body>
</html>