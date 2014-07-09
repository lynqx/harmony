<h5 class="widget-name"><i class="icon-th-list"></i>OVERVIEW - <?php 
	if (isset($firstname) && isset($lastname))
	echo $firstname . " " . $lastname; ?></h5>



<div class="widget navbar-tabs">

	                        <div class="tabbable">
	                            <div class="tab-content">
	                                <div class="tab-pane active fade in" id="tab5">
                               <?php $base_url = base_url(); ?>
                               
							   
		<?php if ($image) { ?>
		<?php
        
				echo '<div class="media row-fluid">';
					echo '<div class="span3">';
					echo '<div class="widget">';
						echo '<div class="well">';
						    echo '<div class="view">';
							?>
					<?php echo '<a href="' . $base_url . 'userphoto/' . $image . '" class="view-back lightbox"></a>
					<img src="' . $base_url . 'userphoto/' .$image . '" alt="" />'; ?>
							    </div>
						    </div>
						</div>
                     </div>
                  </div>
                 <?php  } else {
					 //no image returned
					 
					echo '<div class="media row-fluid">';
					echo '<div class="span3">';
					echo '<div class="widget">';
						echo '<div class="well">';
						    echo '<div class="view">';
							?>
					<?php echo '<a class="view-back lightbox"></a>';
					echo '<img src="' . $base_url . 'userphoto/default.png" alt="" />'; ?>
							    </div>
						    </div>
						</div>
                     </div>
                  </div>
					<?php  }?>
                  
                  
                   <!-- Table with toolbar -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>Member Profile</h6></div></div>
                    <!-- Collapsible widget -->
	                    <div class="widget">
	                        <div class="navbar">
	                            <div class="navbar-inner">
	                                <h6>Biodata</h6>
	                            </div>
	                        </div>
	                        <div class="collapse in" id="demo">
	                            <div class="well body"><div class="table-overflow">
                        <table class="table table-bordered table-checks">
                          <tbody>
                              <tr>
                                  <td width="250"><strong>Firstname</strong></td>
                                  <td><?php echo $firstname; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>Lastname</strong></td>
                                  <td><?php echo $lastname; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>Email</strong></td>
                                  <td><?php echo $email; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>Mobile</strong></td>
                                  <td><?php echo $phone_number; ?></td>
                              </tr>
                                                           
                          </tbody>
                        </table>
                    </div></div>
	                        </div>
	                    </div>
	                    <!-- /collapsible widget -->
                        
                        
                    
                </div>
                                    
                                    
	                                
                                    <!-- Collapsible widget -->
	                    <div class="widget">
	                        <div class="navbar">
	                            <div class="navbar-inner">
	                                <h6>Address</h6>
	                            </div>
	                        </div>
	                        <div class="collapse in" id="demo">
	                            <div class="well body">
                                
                                <div class="table-overflow">
                        <table class="table table-bordered table-checks">
                          <tbody>
                              <tr>
                                  <td width="250"><strong>Contact Address</strong></td>
                                  <td><?php echo $home_address; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>City</strong></td>
                                  <td><?php echo $home_town; ?></td>
                              </tr>
                              
                          </tbody>
                        </table>
                    </div>
                    
                                </div>
	                        </div>
	                    </div>
	                    <!-- /collapsible widget -->
                                                            </div>

                        
	                    </div>
		
                <!-- /table with toolbar -->