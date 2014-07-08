<?php
			$data = $this->session->flashdata('error');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
?>

<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>
<?php if (isset($error)) { echo '<p class="error" style="color:#F00">ERROR : ' . $error . ' </p>'; }?>


<!-- Login Form -->
	                    <form action="<?php echo base_url(); ?>users/getpassword" method="post" 
                        name="form" id="form1" onSubmit = "return validateForm()">
                        
	                    	<div class="widget">
	                            <div class="navbar"><div class="navbar-inner"><h6>Forgot Password</h6></div></div>

								
                                
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
                                            <i class="ico-question-sign"></i>
                                            </span>
                                        <input id="prependedInput" type="email" name="email" placeholder="Email Address" />
                                  	  </div>
        
                                    </div>
	                                </div>
	                                                                     
	                                <div class="form-actions align-right">                                                 
	                                    <button type="submit" class="btn btn-primary">Request</button>
	                                    <button type="reset" class="btn btn-danger">Reset</button>
	                                </div>
                                    </div>                            
	                            
	                        </div>
	                    </form>
	                    <!-- /default form -->
	
<!-- end forgot password_form-->

<script type="text/javascript">

function validateForm()
	{
  		 		  
		  	var x=document.forms["form"]["email"].value;
		if (x==null || x=="")
		  {
		  alert("Please enter your Email Address");
		  return false;
		  }
		  
		var x=document.forms["form1"]["email"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		  {
		  alert("Not a valid Email address");
		  return false;
		  }
		
		  
		  
		
	}

</script>

