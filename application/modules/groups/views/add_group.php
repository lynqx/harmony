<!-- Other fields will be added later -->



<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>
			<?php if (isset($success)) { 
            echo '<h4>SUCCESS : ' . $success . ' </h4>'; 
            }
                                  

$data = $this->session->flashdata('result');
if (isset($data)) echo '<h6>' . $data . '</h6>';
?>                 
                <div class="widget">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <h6>Create a New Group</h6>
                            <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?php echo base_url(); ?>groups/view"><i class="icon-zoom-in"></i>View All Groups</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Login Form -->
	                    <form action="<?php echo base_url() ?>groups/creategroup" method="post" name="form" id="form1" onSubmit = "return validateForm()">							
                                
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
                                            <i class=" ico-folder-close"></i>
                                            </span>
                                        <input id="prependedInput" type="text" name="groupname" placeholder="Group Name" />
                                  	  </div>
        
                                    </div>
	                                </div>
	                                
	                                <div class="control-group">
	                                    <div class="controls">
                                        
                                        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class=" ico-folder-open"></i>
                                            </span>
                                        <input id="prependedInput" type="text" name="groupdesc" placeholder="Group Description" />
                                  	   </div>
                                      
                                   </div>
	                                </div>
	                                                                     
	                                <div class="form-actions align-right">                                                 
	                                    <button type="submit" class="btn btn-primary"><i class=" ico-briefcase"></i> &nbsp; Create</button>
	                                    <button type="reset" class="btn btn-danger">Reset</button>
	                                </div>
                                    </div>
                                     
                                    <div class="controls">
	                                </div>

	                            
	                            
	                        </div>
	                    </form>
	                    <!-- /default form -->
	
<!-- end login_form-->
                
                
                
                <script type="text/javascript">

function validateForm()
	{
  		  var f=document.forms["form"]["loanname"].value;
		if (f==null || f=="")
		  {
		  alert("Please enter your Loan name on form 1");
		  return false;
		  }
		  
		  
		  var p=document.forms["form"]["city"].value;
		if (p==null || p=="")
		  {
		  alert("Please enter your city on form 2");
		  return false;
		  }
		  
		 
		  
		  	
		
		
	}

</script>

