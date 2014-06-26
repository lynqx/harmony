<!-- Content -->
		<div id="content">

		    <!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		            <ul id="breadcrumbs" class="breadcrumb"> 
		                <li><a>You are here</a></li>
		                <li><a href="<?php echo base_url() . $this->uri->segment(1); ?>" title=""> <?php echo $this->uri->segment(1); ?> </a></li>
		                <li class="active"><a href="<?php echo base_url() . $this->uri->segment(1) .'/'. $this->uri->segment(2); ?>" title=""> <?php echo $this->uri->segment(2); ?> </a></li>
		            </ul>
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			    	<div class="page-title">
				    	<span>
                        <?php 
							
						$firstname = $this->session->userdata('firstname');
						$lastname = $this->session->userdata('lastname');
						if($firstname) {

						if (date ('H') <= 12) {
							echo 'Good morning, ';
							} elseif (date ('H') > 12 && (date ('H') <= 20)) {
							echo 'Good day, ';
								} else { 
								echo 'Good Evening, ';	
								}
							echo $firstname.' '.$lastname; ?> &middot; 
                          
                       <?php
					      } else {
                          
                          if (date ('H') <= 12) {
							echo 'Good morning, ';
							} elseif (date ('H') > 12 && (date ('H') <= 20)) {
							echo 'Good day, ';
								} else { echo 'Good Evening, ';	}			
							echo ' Guest';
								}
                          ?>
                          
                    
                    </span>
			    	</div>

			    </div>
			    <!-- /page header -->


			<?php ## this loads the dynamic content from the seperate modules
                    $this->load->view($module.'/'.$view_file);
             ?>

			    
                	</div>
                </div>



		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->