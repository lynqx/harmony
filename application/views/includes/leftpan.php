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
						<div class="navbar"><div class="navbar-inner">
                        <h6>
                        <?php // Create a login/logout link:
			//if(!isset($is_logged_in) || $is_logged_in != true) {
			$first_name = $this->session->userdata('first_name');
			$last_name = $this->session->userdata('last_name');
			if($first_name) {
			echo "Wazzup,";
			echo anchor('pages/member_area', $first_name) ;

			} else {
	
			echo 'Welcome Guest';

			}
			?></h6></div></div>
			            <a href="#" title="" class="user"><img src="img/user.jpg" alt="user img" /></a>
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