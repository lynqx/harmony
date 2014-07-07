

<h5 class="widget-name"><i class="icon-th-list"></i>My Profile- <?php echo $firstname . " " . $lastname; ?></h5>



<div class="widget navbar-tabs">
	                        <div class="navbar">
	                            <div class="navbar-inner">
	                                <h6><?php echo $firstname . " " . $lastname; ?></h6>
	                                <ul class="nav nav-tabs pull-right">
	                                    <li class="active"><a href="#tab5" data-toggle="tab"><i class="icon-zoom-in"></i>View</a></li>
	                                    <li><a href="#tab6" data-toggle="tab"><i class="icon-pencil"></i>Edit</a></li>
	                                </ul>
	                            </div>
	                        </div>
	                        <div class="tabbable">
	                            <div class="tab-content">
	                                <div class="tab-pane active fade in" id="tab5">
                               <?php $base_url = base_url(); ?>
		<?php foreach ($photos as $photo) { ?>
		<?php $image = $photo->image;  ?>
        <?php if ($photo->image == "") { 



					echo '<div class="media row-fluid">';
					echo '<div class="span3">';
					echo '<div class="widget">';
						echo '<div class="well">';
						    echo '<div class="view">';
							?>
					<?php echo '<img src="' . $base_url . 'userphoto/default.jpg" alt="" />'; ?>
							    </div>
						    </div>
						</div>
                     </div>
                  </div>
                  
<?php		} else {
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
                 <?php  } }?>
                  
                  
                   <!-- Table with toolbar -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>Member Profile</h6></div></div>
                    <ul class="toolbar">
                        <li><a href="#" title=""><i class="icon-heart"></i><span>Upload file</span></a></li>
                        <li><a href="#" title=""><i class="icon-download-alt"></i><span>Download file</span></a></li>
                        <li><a href="#" title=""><i class="icon-cog"></i><span>Settings</span></a></li>
                    </ul>
                    
                    <!-- Collapsible widget -->
	                    <div class="widget">
	                        <div class="navbar">
	                            <div class="navbar-inner">
	                                <h6>Biodata <small> (Click arrow beside to toggle open or close) </small></h6>
	                                <div class="nav pull-right">
	                                    <a data-toggle="collapse" class="navbar-icon" data-target="#demo"><i class="icon-resize-vertical"></i></a>
	                                </div>
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
                                  <td><?php echo $mobile; ?></td>
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
	                                <h6>Address <small> (Click arrow beside to toggle open or close) </small></h6>
	                                <div class="nav pull-right">
	                                    <a class="navbar-icon" data-toggle="collapse" data-target="#demo2"><i class="icon-resize-vertical"></i></a>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="collapse" id="demo2">
	                            <div class="well body">
                                
                                <div class="table-overflow">
                        <table class="table table-bordered table-checks">
                          <tbody>
                              <tr>
                                  <td width="250"><strong>Address Line 1</strong></td>
                                  <td><?php echo $addressline1; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>Address Line 2</strong></td>
                                  <td><?php echo $addressline2; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>City</strong></td>
                                  <td><?php echo $city; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>State</strong></td>
                                  <td><?php echo $state; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>Country</strong></td>
                                  <td><?php echo $country; ?></td>
                              </tr>
                              
                          </tbody>
                        </table>
                    </div>
                    
                                </div>
	                        </div>
	                    </div>
	                    <!-- /collapsible widget -->
                                                            </div>

                        <div class="tab-pane fade" id="tab6">
						<h4> Update Information </h4>
                                    <?php echo validation_errors('<p class="error" style="color:#F00">'); ?>


<form action="<?php echo base_url() ?>userview/updateprofile" method="post"
      enctype="multipart/form-data" name="form" id="form1" onSubmit="return validateForm()">

<div class="widget">
<div class="navbar">
    <div class="navbar-inner"><h6>Biodata</h6></div>
</div>
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
                                            <i class="ico-user"></i>
                                            </span>
            <input id="prependedInput" type="text" name="firstname" placeholder="Firstname" value="<?php echo $firstname; ?>" />
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
            <input id="prependedInput" type="text" name="lastname" placeholder="Lastname" value="<?php echo $lastname; ?>" />
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">

                                            <i class="icon-phone"></i>
                                                <span style="color:#F00">*</span>
                                            </span>
            <input type="text" name="mobile" placeholder="Mobile Number" id="mobile"
                   onkeypress="return isNumberKey(event)" value="<?php echo $mobile; ?>" />
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-envelope"></i>
                                            </span>
            <input id="prependedInput" type="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" />
        </div>
    </div>
</div>
<div class="navbar">
    <div class="navbar-inner">
        <h6>Contact Information</h6>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="addressline1" placeholder="Address Line 1" value="<?php echo $addressline1; ?>"/>
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="addressline2" placeholder="Address Line 2" value="<?php echo $addressline2; ?>" />
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="city" placeholder="City" value="<?php echo $city; ?>" />
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="state" placeholder="State" value="<?php echo $state; ?>"  />
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="country" placeholder="Country" value="<?php echo $country; ?>"  />
        </div>
    </div>
</div>
<!-- Login Information Group -->
<div class="navbar">
    <div class="navbar-inner"><h6>Login Information</h6></div>
</div>


<div class="control-group">
    <div class="controls">
        <label>Supply a user name</label>

        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
            <input id="prependedInput" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
    </div>

	<?php if (isset($update_id)) { 
	echo '<input type = "hidden" name="update_id" 
	value="' . $update_id . '" />';
    }
	?>
    
</div>

<div class="form-actions align-right">
                       
                       <!-- Viewing from edit view only activates update button-->

    <button type="submit" class="btn btn-primary">Update Account</button>
    <button type="reset" class="btn btn-danger">Reset</button>
</div>
                                    
                                    
                                    
                                    </div>
	                            </div>
	                        </div>
	                    </div>
		
                <!-- /table with toolbar -->