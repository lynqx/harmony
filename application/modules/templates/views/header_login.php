<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />


 <?php
    // Check for a $page_title value:
    if (!isset($page_title)) {
        $page_title = 'Admin Registration';
    }
    ?>
    <title>
        <?php
        $first_name = $this->session->userdata('first_name');
        $last_name = $this->session->userdata('last_name');
        if ($first_name) {
//if (isset($_COOKIE['user_id'])) {
            echo $page_title . "- " . $first_name . " " . $last_name . " ::Armony";
        } else {

            echo $page_title . " - ::Armony";
        }
        ?></title>
        
        <!------------ site favicon logo ---------->
					<?php
					
					foreach ($displays as $display) {
					  $fav = $display->favicon;
					  if ($fav == 1) {
				
                foreach ($logos as $sitelogo) { 	  						  
                  $favicon = $sitelogo->favicon;
				  ?>

                <link rel="shortcut icon" href="<?php echo base_url() . 'img/' . $favicon; ?>" />
                
                <?php 			} 
							}
						}
					?>
        

<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
<!--[if IE 9]><link href="css/ie9.css" rel="stylesheet" type="text/css" /><![endif]-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.uniform.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/files/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/files/login.js"></script>

</head>

<body class="no-background">

	<!-- Fixed top -->
	<div id="top">
		<div class="fixed">
    		<!------------display site logo ---------->
					<?php
					
					
					// allowed to use logo on site ?
					foreach ($displays as $display) {
					  $logo = $display->logo;
					  $defaultlogo = $display->defaultlogo;

					 
					  if ($logo == 1) {
						  
						  // which logo to use, uploaded or default
					  if ($defaultlogo == 1) {
				?>
                
                <a href="index.html" title="" class="logo">
                <?php 
				  foreach ($logos as $sitelogo) { 	  						  
                  $logo = $sitelogo->logo;
		          echo '<img src="' . base_url() . 'img/' . $logo . '" alt="" />';
				  }
				  ?>
                </a>
                <?php } else {
				echo '<a href="index.html" title="" class="logo"><img src="' . base_url() . 'img/defaultlogo.png" alt="" /></a>';
						  } 
				}
			}
					?>

    <!------------display site name ---------->
    		<?php 

				  foreach ($settings as $setting) { 
				  
				  
						  
                  $companyname = $setting->companyname;
                  $shortname = $setting->shortname;
            ?>
    
        <p title="" class="sitename"> <?php
		foreach ($displays as $display) {
					  $sitename = $display->sitename;
					 
					  if ($sitename == 1) {
		
		 echo $companyname;  } } } ?></p>
         
         
			<ul class="top-menu">
				<li class="dropdown">
					<a class="login-top" data-toggle="dropdown"></a>
					<ul class="dropdown-menu pull-right">
						<li><a href="#" title=""><i class="icon-group"></i>Change user</a></li>
						<li><a href="#" title=""><i class="icon-plus"></i>New user</a></li>
						<li><a href="#" title=""><i class="icon-cog"></i>Settings</a></li>
						<li><a href="#" title=""><i class="icon-remove"></i>Go to the website</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /fixed top -->