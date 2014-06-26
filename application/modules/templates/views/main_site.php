<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Pannonia - premium responsive admin template by Eugene Kopyov</title>
<link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&amp;sensor=false"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/prettify.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.elfinder.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.autosize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.listbox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.validation.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.form.wizard.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.form.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/files/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/files/functions.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/charts/graph.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/charts/chart1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/charts/chart2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/charts/chart3.js"></script>

</head>

<body>

	<!-- Fixed top -->
	<div id="top">
		<div class="fixed">
			<a href="index.html" title="" class="logo"><img src="<?php echo base_url(); ?>img/logo.png" alt="" /></a>
			<ul class="top-menu">
				<li><a class="fullview"></a></li>
				<li><a class="showmenu"></a></li>
				<li><a href="#" title="" class="messages"><i class="new-message"></i></a></li>
				<li class="dropdown">
					<a class="user-menu" data-toggle="dropdown"><img src="<?php echo base_url(); ?>img/userpic.png" alt="" /><span>Howdy, Eugene! <b class="caret"></b></span></a>
					<ul class="dropdown-menu">
						<li><a href="#" title=""><i class="icon-user"></i>Profile</a></li>
						<li><a href="#" title=""><i class="icon-inbox"></i>Messages<span class="badge badge-info">9</span></a></li>
						<li><a href="#" title=""><i class="icon-cog"></i>Settings</a></li>
						<li><a href="#" title=""><i class="icon-remove"></i>Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /fixed top -->


	<!-- Content container -->
	<div id="container">

		<!-- Sidebar -->
		<div id="sidebar">

			<div class="sidebar-tabs">
		        <ul class="tabs-nav two-items">
		            <li><a href="#general" title=""><i class="icon-reorder"></i></a></li>
		            <li><a href="#stuff" title=""><i class="icon-cogs"></i></a></li>
		        </ul>

		        <div id="general">

			        <!-- Sidebar user -->
			        <div class="sidebar-user widget">
						<div class="navbar"><div class="navbar-inner"><h6>Wazzup, Eugene!</h6></div></div>
			            <a href="#" title="" class="user"><img src="http://placehold.it/210x110" alt="" /></a>
			            <ul class="user-links">
			            	<li><a href="" title="">New users<strong>+12</strong></a></li>
			            	<li><a href="" title="">New orders<strong>+156</strong></a></li>
			            	<li><a href="" title="">New messages<strong>+45</strong></a></li>
			            </ul>
			        </div>
			        <!-- /sidebar user -->

			        <div class="general-stats widget">
				        <ul class="head">
				        	<li><span>Users</span></li>
				        	<li><span>Orders</span></li>
				        	<li><span>Visits</span></li>
				        </ul>
				        <ul class="body">
				        	<li><strong>116k+</strong></li>
				        	<li><strong>1290</strong></li>
				        	<li><strong>554</strong></li>
				        </ul>
				    </div>

				    <!-- Main navigation -->
			        <ul class="navigation widget">
			            <li class="active"><a href="index.html" title=""><i class="icon-home"></i>Dashboard</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Form elements<strong>3</strong></a>
			                <ul>
			                    <li><a href="forms.html" title="">Form components</a></li>
			                    <li><a href="wysiwyg.html" title="">WYSIWYG editor</a></li>
			                    <li><a href="form_wizards.html" title="">Wizards</a></li>
			                </ul>
			            </li>
			            <li><a href="#" title="" class="expand"><i class="icon-tasks"></i>Components<strong>4</strong></a>
			                <ul>
			                    <li><a href="components.html" title="">Content components</a></li>
			                    <li><a href="content_grid.html" title="">Content grid</a></li>
			                    <li><a href="blank.html" title="">Blank page</a></li>
			                </ul>
			            </li>
			            <li><a href="media.html" title=""><i class="icon-picture"></i>Media</a></li>
			            <li><a href="icons.html" title=""><i class="icon-th"></i>Icons</a></li>
			            <li><a href="charts.html" title=""><i class="icon-signal"></i>Charts &amp; graphs</a></li>
			            <li><a href="invoice.html" title=""><i class="icon-copy"></i>Invoice</a></li>
			            <li><a href="tables.html" title=""><i class="icon-table"></i>Tables</a></li>
			            <li><a href="#" title="" class="expand"><i class="icon-warning-sign"></i>Error pages<strong>6</strong></a>
			                <ul>
			                    <li><a href="403.html" title="">403 page</a></li>
			                    <li><a href="404.html" title="">404 page</a></li>
			                    <li><a href="405.html" title="">405 page</a></li>
			                    <li><a href="500.html" title="">500 page</a></li>
			                    <li><a href="503.html" title="">503 page</a></li>
			                    <li><a href="offline.html" title="">Offline page</a></li>
			                </ul>
			            </li>
			            <li><a href="typography.html" title=""><i class="icon-text-height"></i>Typography</a></li>
			            <li><a href="calendar.html" title=""><i class="icon-calendar"></i>Calendar</a></li>
			            <li><a href="file_management.html" title=""><i class="icon-cogs"></i>File management</a></li>
	                    <li><a href="#" title="" class="expand"><i class="icon-indent-right"></i>Menu levels<strong>3</strong></a>
			                <ul>
			                    <li><a href="#" title="">Link</a></li>
			                    <li><a href="#" title="" class="expand">Link with submenu</a>
					                <ul>
					                    <li><a href="#" title="">Lorem ipsum</a></li>
					                    <li><a href="#" title="">Dolor sit amet</a></li>
					                </ul>
			                    </li>
			                    <li><a href="#" title="">Link</a></li>
			                </ul>
	                    </li>
			            <li><a href="#" title="" class="expand"><i class="icon-sitemap"></i>Page layouts<strong>3</strong></a>
			                <ul>
			                    <li><a href="no_sidebar_tabs.html" title="">No sidebar tabs</a></li>
			                    <li><a href="no_action_tabs.html" title="">No action tabs</a></li>
			                    <li><a href="actions_on_top.html" title="">Action tabs on top</a></li>
			                    <li><a href="no_breadcrumbs.html" title="">No breadcrumbs line</a></li>
			                </ul>
			            </li>
			        </ul>
			        <!-- /main navigation -->

		        </div>

		        <div id="stuff">

			        <!-- Social stats -->
			        <div class="widget">
			        	<h6 class="widget-name"><i class="icon-twitter"></i>Social statistics</h6>
			        	<ul class="social-stats">
			        		<li>
			        			<a href="" title="" class="orange-square"><i class="icon-rss"></i></a>
			        			<div>
				        			<h4>1,286</h4>
				        			<span>total feed subscribers</span>
				        		</div>
			        		</li>
			        		<li>
			        			<a href="" title="" class="blue-square"><i class="icon-twitter"></i></a>
			        			<div>
				        			<h4>12,683</h4>
				        			<span>total twitter followers</span>
				        		</div>
			        		</li>
			        		<li>
			        			<a href="" title="" class="dark-blue-square"><i class="icon-facebook"></i></a>
			        			<div>
				        			<h4>530,893</h4>
				        			<span>total facebook likes</span>
				        		</div>
			        		</li>
			        	</ul>
			        </div>
			        <!-- /social stats -->


                    <!-- Datepicker -->
		        	<div class="widget">
		        		<h6 class="widget-name"><i class="icon-calendar"></i>Datepicker</h6>
		                <div class="inlinepicker datepicker-liquid"></div>
		            </div>
		            <!-- /datepicker -->


		            <!-- Dates range -->
                    <ul class="widget dates-range">
                        <li><input type="text" id="fromDate" name="from" placeholder="From" /></li>
                        <li class="sep">-</li>
                        <li><input type="text" id="toDate" name="to" placeholder="To" /></li>
                    </ul>
                    <!-- /dates range -->


                    <!-- Color picker -->
                    <div class="widget input-append color" data-color="rgb(255, 146, 180)" data-color-format="rgb" id="cp3">
                        <input type="text" value="" readonly >
                        <span class="add-on"><i style="background-color: rgb(255, 146, 180)"></i></span>
                    </div>
                    <!-- /color picker -->


                    <!-- Time picker range -->
                    <ul class="widget dates-range">
                        <li><input id="timeformatExample1" type="text" placeholder="Start" /></li>
                        <li class="sep">-</li>
                        <li><input id="timeformatExample2" type="text" placeholder="End" /></li>
                    </ul>
                    <!-- /time picker range -->


				    <!-- Gallery thumbs -->
				    <div class="widget">
				    	<h6 class="widget-name"><i class="icon-picture"></i>Gallery thumbs</h6>
				    	<div class="row-fluid thumbs">
					    	<div class="span6">
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    	</div>
					    	<div class="span6">
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    		<a href="img/demo/big.jpg" class="lightbox"><img src="http://placehold.it/580x380" alt="" /></a>
					    	</div>
					    </div>
				    </div>
				    <!-- /gallery thumbs -->

		        	<!-- Action buttons -->
	                <div class="widget">
	                	<h6 class="widget-name"><i class="icon-search"></i>Action buttons</h6>
	                	<button class="btn btn-block btn-danger">Action button</button>
	                	<button class="btn btn-block btn-info">Action button</button>
	                	<button class="btn btn-block btn-success">Action button</button>
	                </div>
	                <!-- /action buttons -->

			        <!-- Tags input -->
					<div class="widget">
						<h6 class="widget-name"><i class="icon-search"></i>Tags input</h6>
						<input type="text" id="tags1" class="tags" value="these,are,sample,tags" />
					</div>
					<!-- /tags input -->

		        </div>

		    </div>
		</div>
		<!-- /sidebar -->


		<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li><a href="index.html">Dashboard</a></li>
		                <li class="active"><a href="calendar.html" title="">Calendar</a></li>
		            </ul>
			        
		            <ul class="alt-buttons">
		                <li><a href="#" title=""><i class="icon-signal"></i><span>Stats</span></a></li>
		                <li><a href="#" title=""><i class="icon-comments"></i><span>Messages</span></a></li>
		                <li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-tasks"></i><span>Tasks</span> <strong>(+16)</strong></a>
		                	<ul class="dropdown-menu pull-right">
		                        <li><a href="#" title=""><i class="icon-plus"></i>Add new task</a></li>
		                        <li><a href="#" title=""><i class="icon-reorder"></i>Statement</a></li>
		                        <li><a href="#" title=""><i class="icon-cog"></i>Settings</a></li>
		                	</ul>
		                </li>
		            </ul>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<h5>Dashboard</h5>
				    	<span>Good morning, Eugene!</span>
			    	</div>

			    	<ul class="page-stats">
			    		<li>
			    			<div class="showcase">
			    				<span>New visits</span>
			    				<h2>22.504</h2>
			    			</div>
			    			<div id="total-visits" class="chart">10,14,8,45,23,41,22,31,19,12, 28, 21, 24, 20</div>
			    		</li>
			    		<li>
			    			<div class="showcase">
			    				<span>My balance</span>
			    				<h2>$16.290</h2>
			    			</div>
			    			<div id="balance" class="chart">10,14,8,45,23,41,22,31,19,12, 28, 21, 24, 20</div>
			    		</li>
			    	</ul>
			    </div>
			    <!-- /page header -->

			    <!-- Action tabs -->
			    <div class="actions-wrapper">
				    <div class="actions">

				    	<div id="user-stats">
					        <ul class="round-buttons">
					            <li><div class="depth"><a href="" title="Add new post" class="tip"><i class="icon-plus"></i></a></div></li>
					            <li><div class="depth"><a href="" title="View statement" class="tip"><i class="icon-signal"></i></a></div></li>
					            <li><div class="depth"><a href="" title="Media posts" class="tip"><i class="icon-reorder"></i></a></div></li>
					            <li><div class="depth"><a href="" title="RSS feed" class="tip"><i class="icon-rss"></i></a></div></li>
					            <li><div class="depth"><a href="" title="Create new task" class="tip"><i class="icon-tasks"></i></a></div></li>
					            <li><div class="depth"><a href="" title="Layout settings" class="tip"><i class="icon-cogs"></i></a></div></li>
					        </ul>
				    	</div>

				    	<div id="quick-actions">
				    		<ul class="statistics">
				    			<li>
				    				<div class="top-info">
					    				<a href="#" title="" class="blue-square"><i class="icon-plus"></i></a>
					    				<strong>12,476</strong>
					    			</div>
									<div class="progress progress-micro"><div class="bar" style="width: 60%;"></div></div>
									<span>User registrations</span>
				    			</li>
				    			<li>
				    				<div class="top-info">
					    				<a href="#" title="" class="red-square"><i class="icon-hand-up"></i></a>
					    				<strong>621,873</strong>
					    			</div>
									<div class="progress progress-micro"><div class="bar" style="width: 20%;"></div></div>
									<span>Total clicks</span>
				    			</li>
				    			<li>
				    				<div class="top-info">
					    				<a href="#" title="" class="purple-square"><i class="icon-shopping-cart"></i></a>
					    				<strong>562</strong>
					    			</div>
									<div class="progress progress-micro"><div class="bar" style="width: 90%;"></div></div>
									<span>New orders</span>
				    			</li>
				    			<li>
				    				<div class="top-info">
					    				<a href="#" title="" class="green-square"><i class="icon-ok"></i></a>
					    				<strong>$45,360</strong>
					    			</div>
									<div class="progress progress-micro"><div class="bar" style="width: 70%;"></div></div>
									<span>General balance</span>
				    			</li>
				    			<li>
				    				<div class="top-info">
					    				<a href="#" title="" class="sea-square"><i class="icon-group"></i></a>
					    				<strong>562K+</strong>
					    			</div>
									<div class="progress progress-micro"><div class="bar" style="width: 50%;"></div></div>
									<span>Total users</span>
				    			</li>
				    			<li>
				    				<div class="top-info">
					    				<a href="#" title="" class="dark-blue-square"><i class="icon-facebook"></i></a>
					    				<strong>36,290</strong>
					    			</div>
									<div class="progress progress-micro"><div class="bar" style="width: 93%;"></div></div>
									<span>Facebook fans</span>
				    			</li>
				    		</ul>
				    	</div>

				    	<div id="map">
				    		<div id="google-map"></div>
				    	</div>

				    	<ul class="action-tabs">
				    		<li><a href="#user-stats" title="">Quick actions</a></li>
				    		<li><a href="#quick-actions" title="">Website statistics</a></li>
				    		<li><a href="#map" title="" id="map-link">Google map</a></li>
				    	</ul>
				    </div>
				</div>
			    <!-- /action tabs -->

		    	<!-- Search widget -->
		    	<form class="search widget" action="#">
		    		<div class="autocomplete-append">
			    		<ul class="search-options">
			    			<li><a href="#" title="Go to search page" class="go-option tip"></a></li>
			    			<li><a href="#" title="Advanced search" class="advanced-option tip"></a></li>
			    			<li><a href="#" title="Settings" class="settings-option tip"></a></li>
			    		</ul>
			    		<input type="text" placeholder="search website..." id="autocomplete" />
			    		<input type="submit" class="btn btn-info" value="Search" />
			    	</div>
		    	</form>
		    	<!-- /search widget -->

		    	<!-- Earnings stats widgets -->
		    	<div class="row-fluid">

		    		<div class="span4">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Earnings statistic</h6></div></div>
				            <div class="well body">
				            	<ul class="stats-details">
				            		<li>
				            			<strong>Current balance</strong>
				            			<span>latest update on 12:39 am</span>
				            		</li>
				            		<li>
				            			<div class="number">
					            			<a href="#" title="" data-toggle="dropdown"></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="#" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>
												<li><a href="#" title=""><i class="icon-cog"></i>Parameters</a></li>
												<li><a href="#" title=""><i class="icon-download-alt"></i>Download statement</a></li>
											</ul>
											<span>$6,458</span>
										</div>
				            		</li>
				            	</ul>
				            	<div class="graph" id="chart1"></div>
				            </div>
				        </div>
		    		</div>

		    		<div class="span4">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Visitor statistics</h6></div></div>
				            <div class="well body">
				            	<ul class="stats-details">
				            		<li>
				            			<strong>Today's visitors</strong>
				            			<span>latest update on 4:42 pm</span>
				            		</li>
				            		<li>
				            			<div class="number">
					            			<a href="#" title="" data-toggle="dropdown"></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="#" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>
												<li><a href="#" title=""><i class="icon-cog"></i>Parameters</a></li>
												<li><a href="#" title=""><i class="icon-download-alt"></i>Download statement</a></li>
											</ul>
											<span>+12,127</span>
										</div>
				            		</li>
				            	</ul>
				            	<div class="graph" id="chart2"></div>
				            </div>
				        </div>
		    		</div>

		    		<div class="span4">
				        <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Click statistics</h6></div></div>
				            <div class="well body">
				            	<ul class="stats-details">
				            		<li>
				            			<strong>Total clicks</strong>
				            			<span>latest update on 3:09 pm</span>
				            		</li>
				            		<li>
				            			<div class="number">
					            			<a href="#" title="" data-toggle="dropdown"></a>
											<ul class="dropdown-menu pull-right">
												<li><a href="#" title=""><i class="icon-refresh"></i>Reload data</a></li>
												<li><a href="#" title=""><i class="icon-calendar"></i>Change time period</a></li>
												<li><a href="#" title=""><i class="icon-cog"></i>Parameters<strong class="badge badge-info">9</strong></a></li>
												<li><a href="#" title=""><i class="icon-download-alt"></i>Download statement</a></li>
											</ul>
											<span>168k+</span>
										</div>
				            		</li>
				            	</ul>
				            	<div class="graph" id="chart3"></div>
				            </div>
				        </div>
		    		</div>
		    	</div>
		    	<!-- /earnings stats widgets -->


                <h5 class="widget-name"><i class="icon-reorder"></i>Options bar</h5>

		    	<!-- Options bar -->
		    	<div class="widget">
		    		<ul class="options-bar">
		    			<li>
			    			<div class="bar-select pull-left">
				    			<span>Sorting: </span>
				                <select name="select2" class="styled">
				                    <option value="opt1">Sort by date</option>
				                    <option value="opt2">Sort by time</option>
				                    <option value="opt3">Sort by category</option>
				                    <option value="opt4">Sort by size</option>
				                </select>
				            </div>

		                    <div class="loading pull-left">
		                        <span>Updating list</span>
		                        <img src="img/elements/loaders/6s.gif" alt="" />
		                    </div>
		    			</li>
		    			<li class="bar-entries">
		    				<span>Showing 8 of 1290 entries &nbsp;&nbsp;/&nbsp;&nbsp; New entries: <strong class="">+12</strong></span>
		    			</li>
		    			<li>
				    		<div class="pull-right bulk">
				    			<div class="bar-select">
					    			<span>Bulk actions: </span>
					                <select name="select2" class="styled">
					                    <option value="opt1">Edit</option>
					                    <option value="opt2">Unpublish</option>
					                    <option value="opt3">Publish</option>
					                    <option value="opt4">Move to trash</option>
					                </select>
					            </div>

					            <div class="bar-button">
					            	<button type="button" class="btn btn-info">Apply</button>
					            </div>
				    		</div>
		    			</li>
		    		</ul>
		    	</div>
		    	<!-- /options bar -->


		    	<h5 class="widget-name"><i class="icon-th"></i>Grid gallery items</h5>

                <!-- With titles -->
				<div class="media row-fluid">

					<div class="span3">
						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>

						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>
					</div>

					<div class="span3">
						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>

						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>
					</div>

					<div class="span3">
						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>

						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>
					</div>

					<div class="span3">
						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>

						<div class="widget">
						    <div class="well">
						    	<div class="view">
									<a href="img/demo/big.jpg" class="view-back lightbox"></a>
							    	<img src="http://placehold.it/580x380" alt="" />
							    </div>
						    	<div class="item-info">
						    		<a href="#" title="" class="item-title">Aenean Malesuada Consectetur Risus</a>
						    		<p>Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur mollis ornare vel leo.</p>
						    		<p class="item-buttons">
						    			<a href="#" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>
						    			<a href="#" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>
						    		</p>
						    	</div>
						    </div>
						</div>
					</div>
				</div>
                <!-- /with titles -->


		    	<h5 class="widget-name"><i class="icon-th"></i>Media table</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6>Media table</h6>
                            <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-plus"></i>Add new option</a></li>
                                    <li><a href="#"><i class="icon-reorder"></i>View statement</a></li>
                                    <li><a href="#"><i class="icon-cogs"></i>Parameters</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-overflow">
                        <table class="table table-striped table-bordered table-checks media-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>File info</th>
                                    <th class="actions-column">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image2 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                                <tr>
			                        <td><a href="img/demo/big.jpg" title="" class="lightbox"><img src="http://placehold.it/37x37" alt="" /></a></td>
			                        <td><a href="#" title="">Image1 description</a></td>
			                        <td>Feb 12, 2012. 12:28</td>
			                        <td class="file-info">
			                        	<span><strong>Size:</strong> 215 Kb</span>
			                        	<span><strong>Format:</strong> .jpg</span>
			                        	<span><strong>Dimensions:</strong> 120 x 120</span>
			                        </td>
			                        <td>
		                                <ul class="navbar-icons">
		                                    <li><a href="#" class="tip" title="Add new option"><i class="icon-plus"></i></a></li>
		                                    <li><a href="#" class="tip" title="View statistics"><i class="icon-reorder"></i></a></li>
		                                    <li><a href="#" class="tip" title="Parameters"><i class="icon-cogs"></i></a></li>
		                                </ul>
			                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /media datatable -->

                <div class="row-fluid">
                	<div class="span6">

						<!-- Simple chart -->       
			            <div class="widget">
			            	<div class="navbar">
			                	<div class="navbar-inner">
			                    	<h6>Simple chart</h6>
			                    </div>
			                </div>
			                <div class="well body">
			                	<div class="graph-standard" id="graph"></div>
			                </div>
			            </div>
			            <!-- /simple chart -->

                        <!-- Pre, code -->
                        <div class="widget">
                            <div class="navbar"><div class="navbar-inner"><h6>Pre, code styles</h6></div></div>
                            <div class="well body">

<pre class="pre-scrollable prettyprint linenums">
&lt;dl class="dl-horizontal"&gt;
  &lt;div class="well-white">
    &lt;blockquote>
      &lt;p>Lorem ipsum.&lt;/p>
      &lt;small>Someone famous&lt;/small>
    &lt;/blockquote>
  &lt;/div>
&lt;/div>

&lt;div class="well-white body semi-block">
  &lt;blockquote class="pull-right">
    &lt;p>Lorem ipsum.&lt;/p>
    &lt;small>Someone famous&lt;/small>
  &lt;/blockquote>
&lt;/div>
</pre>         

                            </div>
                        </div>                                
                        <!-- /pre, code -->

                	</div>

                	<div class="span6">

		                <!-- Calendar -->
		                <div class="widget">
							<div class="navbar"><div class="navbar-inner"><h6>Calendar</h6></div></div>
		                    <div id="calendar" class="well"></div>
		                </div>
		                <!-- /calendar -->

                	</div>
                </div>



		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->

	</div>
	<!-- /content container -->


	<!-- Footer -->
	<div id="footer">
		<div class="copyrights">&copy;  Brought to you by Eugene Kopyov.</div>
		<ul class="footer-links">
			<li><a href="" title=""><i class="icon-cogs"></i>Contact admin</a></li>
			<li><a href="" title=""><i class="icon-screenshot"></i>Report bug</a></li>
		</ul>
	</div>
	<!-- /footer -->

</body>
</html>
