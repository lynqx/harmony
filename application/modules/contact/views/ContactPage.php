<h3> Contact Us </h3>

<?php echo validation_errors('<p class="error">'); ?>

     <img src="http://localhost/joit/images/contact.png" alt="contact" width="80" height="91" align="left" />


                <form action="contact/submit" method="post"
                enctype="multipart/form-data" name="form" id="form1" onSubmit = "return validateForm()">	

<div class="widget">
                <div class="well">
	                            <div class="alert margin">
						    		<button type="button" class="close" data-dismiss="alert">×</button>
						    		Field marked <span style="color:#F00">*</span> are compulsory
						    	</div>
                <div class="control-group">
						            <div class="controls">
						            	<div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-hand-right"></i>
                                            </span>
                                    <input id="prependedInput" type="text" name="name" placeholder="Fullname" />
						            	</div>
						        	</div>
						        </div>
                 
                 <div class="control-group">
						            <div class="controls">
						            	<div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-hand-right"></i>
                                            </span>
                                 <input id="prependedInput" type="email" name="email" placeholder="Email Address" />
                                  </div>
						        	</div>
						        </div>  
                <div class="control-group">
						            <div class="controls">
						            	<div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-hand-right"></i>
                                            </span>
                                    <input type="text" name="mobile" placeholder="Mobile Number" id="mobile" onkeypress="return isNumberKey(event)" />
									</div>
						        	</div>
						        </div>      
                                
                <div class="control-group">
	                                    <label class="control-label">Message:</label>
	                                    <div class="controls">
	                                        <textarea rows="5" cols="50" name="message" class="span12"></textarea>
	                                    </div>
	                                </div>

									<div class="form-actions align-right">                                                 
	                                    <button type="submit" class="btn btn-primary">Contact Us</button>
	                                    <button type="reset" class="btn btn-danger">Reset</button>
	                                </div>




<script type="text/javascript">

function validateForm()
	{
  		  var f=document.forms["form"]["name"].value;
		if (f==null || f=="")
		  {
		  alert("Please enter your Name");
		  return false;
		  }
		  
	  
		  
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
		  
		 var m=document.forms["form"]["mobile"].value;
		if (m==null || m=="")
		  {
		  alert("Please enter your mobile number");
		  return false;
		  }
		
		
		if (m.length<11 || m.length>13 ) 
	 	{
		  alert("Not a valid mobile number");
		  return false;
		 } 	
	 
		  
		     var e=document.forms["form"]["message"].value;
		if (e==null || e=="")
		  {
		  alert("Please enter your Message");
		  return false;
		  }
		  
		  
		
	}

</script>
