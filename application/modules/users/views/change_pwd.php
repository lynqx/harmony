<?php
			$data = $this->session->flashdata('error');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
			?>

<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>
<?php if (isset($error)) { echo '<p class="error" style="color:#F00">ERROR : ' . $error . ' </p>'; }?>


<!-- Login Form -->
	                    <form action="<?php echo base_url(); ?>users/updatepwd" method="post">
	                    	<div class="widget">
	                            <div class="navbar"><div class="navbar-inner"><h6>Change Password</h6></div></div>

								
                                
	                            <div class="well">
	                            <div class="alert margin">
						    		<button type="button" class="close" data-dismiss="alert">×</button>
						    		All fields are required
						    	</div>
	                                <div class="control-group">
	                                    <div class="controls">
                                        
                                        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
                                        <input id="prependedInput" type="password" name="oldpassword" placeholder="Old Password" />
                                  	  </div>
        
                                    </div>
	                                </div>
	                                
	                                <div class="control-group">
	                                    <div class="controls">
                                        
                                        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-eye-close"></i>
                                            </span>
                                        <input id="prependedInput" type="password" name="password" placeholder="New Password" />
                                  	   </div>
                                      
                                   </div>
	                                </div>
                                    
                                    <div class="control-group">
	                                    <div class="controls">
                                        
                                        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-eye-close"></i>
                                            </span>
                                        <input id="prependedInput" type="password" name="passconf" placeholder="Confirm New Password" />
                                  	   </div>
                                      
                                   </div>
	                                </div>
	                                                                     
	                                <div class="form-actions align-right">                                                 
	                                    <button type="submit" class="btn btn-primary">Update</button>
	                                    <button type="reset" class="btn btn-danger">Reset</button>
	                                </div>
                                    </div>                            
	                            
	                        </div>
	                    </form>
	                    <!-- /default form -->
	
<!-- end login_form-->
