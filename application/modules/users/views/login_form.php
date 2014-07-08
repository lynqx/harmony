

<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>
<?php if (isset($error)) { echo '<p class="error" style="color:#F00">ERROR : ' . $error . ' 
									<ul class="nav nav-pills">
	                                 <li class="active"><a href="'. base_url(). 'users/recover"><i class="icon-info-sign"></i>Forgot Password</a></li>
                                     </ul>
								  </p>'; }?>


<!-- Login Form -->
	                     <!-- Login block -->
    <div class="login">
        <div class="navbar">
            <div class="navbar-inner">
                <h6><i class="icon-user"></i>Login page</h6>
                <div class="nav pull-right">
                    <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#"><i class="icon-plus"></i>Register</a></li>
                        <li><a href="#"><i class="icon-refresh"></i>Recover password</a></li>
                        <li><a href="#"><i class="icon-cog"></i>Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="well">
	                    <form action="<?php echo base_url(); ?>users/validate_credentials" method="post" name="form" id="form1" onSubmit = "return validateForm()">
                <div class="control-group">
                    <label class="control-label">Username</label>
                    <div class="controls"><input class="span12" type="text" name="username" placeholder="username" /></div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Password:</label>
                    <div class="controls"><input class="span12" type="password" name="password" placeholder="password" /></div>
                </div>

                <div class="login-btn"><input type="submit" value="Login" class="btn btn-danger btn-block" /></div>
            </form>
        </div>
    </div>
    <!-- /login block -->
	
<!-- end login_form-->


<script type="text/javascript">

function validateForm()
	{
  		  var f=document.forms["form"]["username"].value;
		if (f==null || f=="")
		  {
		  alert("Please enter your Username");
		  return false;
		  }
		  
		  
		  var p=document.forms["form"]["password"].value;
		if (p==null || p=="")
		  {
		  alert("Please enter your Password");
		  return false;
		  }
		  
		 
		  
		  	
		
		
	}

</script>

