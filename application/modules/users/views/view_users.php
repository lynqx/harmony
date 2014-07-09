<style>
	<!--
	#fixedmodal
	{
		min-width:700px;
		background:#ccc;
		display: none;
		position: fixed;
		bottom: 50px;
	}
	
	//-->
</style>

<?php
			$data = $this->session->flashdata('result');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
			?>                 
        <!-- Default datatable -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>Found <?php echo $num_results; ?> registered coperators</h6>
                    
                    
                    <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-plus"></i> View Full Profile</a></li>
                                    <li><a href="#"><i class="icon-reorder"></i> View Account Summary</a></li>
                                    <li><a href="#"><i class="icon-cogs"></i> View Active Loans</a></li>
                                    <li><a href="#"><i class="icon-cogs"></i> View Asset Loans</a></li>
                                    <li><a href="#"><i class="icon-cogs"></i> Apply for loan products </a></li>
                                    <li><a href="#"><i class="icon-cogs"></i> Apply for asset products </a></li>
                                    <li><a href="#"><i class="icon-cogs"></i> Apply for part withdrawal </a></li>
                                    <li><a href="#"><i class="icon-cogs"></i> Export all member's list </a></li>
                                </ul>
                            </div>
                    
                    
                    </div></div>
                    <div class="table-overflow">
                    <form action="<?php echo base_url(); ?>users/manageall" method="post">

                        <table class="table table-striped table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th><center><input type="checkbox" name="checkrow" class="styled" /></center></th>
                                    <th>Username</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th> View </th>
                                    <th> Exit CTCS </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($users as $user) { ?>
								<?php $id = $user->id; ?>
                                <tr>
                                    <td>
                <center><input type="checkbox" style="width: 20px;" name="checkbox[]" value="<?php echo $id; ?>" class="styled"></center>
                                    </td>
                                    <td><a href="#" onclick="showInfo('fixedmodal', 'modalcontent', '<?php echo $id; ?>')"> <?php echo $user->username; ?></a></td>
                                    <td> <?php echo $user->email; ?></td>
                                    <td> <?php echo $user->phone_number; ?></td>
                                    <td> <?php 
									if ($user->active == 0) {
										echo 'Blocked';
										} else {
											echo 'Active';
											} ?></td>
                                    <td> 
								<?php 
								if (!is_numeric($user->last_login)) {
									echo 'Never Logged In!';
									} else { ?>
                                <?php
								
								 echo '<p class="tym"><font style="font-size: 12px;">';
									$days = floor($user->TimeSent / (60 * 60 * 24));
										$remainder = $user->TimeSent % (60 * 60 * 24);
										$hours = floor($remainder / (60 * 60));
										$remainder = $remainder % (60 * 60);
										$minutes = floor($remainder / 60);
										$seconds = $remainder % 60;
								if($days > 0)
										echo date('F d Y', $user->last_login);
										elseif($days == 0 && $hours == 0 && $minutes == 0)
										echo "few seconds ago";		
										elseif($days == 0 && $hours == 0)
										echo $minutes.' minutes' . " " . $seconds.' seconds ago';
										elseif($days == 0)
										echo $hours.' hours' . " " . $minutes.' minutes' . " " . $seconds.' seconds ago';
										echo '</font></p>';
										} ?>
										</td>
                                        
                          
                          <td> 
						  <?php echo'<a href="view/'. $id . '" class="btn btn-info tip" title="View"><i class="icon-zoom-in"></i></a>'; ?>
						  </td>
                    
                           <td><?php echo'<a href="entitlements/view/'. $id .'" 
								onclick="return confirm(\'Are you sure you want to exit from ctcs?\');" class="btn btn-info tip" title="Exit CTCS"><i class="ico-remove"></i></a>'; ?></td>
						    			
                                    								

                                </tr>
                                  <?php }?>
								  
						        </tbody>
</table>

 </div>
                    <div class="table-footer">
                        <div class="table-actions">
                            <label>Apply action:</label>
                                                
                                                <select name="action" id="action">
                                                <option value=""> Select action... </option>
                                                <option value="0"> Block Selected User(s) </option>
                                                </select>
                                                
                   <button type="submit" id="submitButton" name="update" class="btn btn-primary">Update</button>

                        </div>
                        
                        <?php if (strlen($pagination)); ?>
                       <div class="pagination">
                        Pages: <?php echo $pagination; ?>
                        </div>
                        
                        <div class="pagination">
                            <ul>
                                <li> <?php echo $pagination; ?></li>
                                
                            </ul>
                        </div> 
                        <?php // endif; ?>
                    </div>
                    

                </div>
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>Add Members to Group <small> (Select members above to add to group) </small></h6></div>
                 </div>
                        <div class="table-footer">
                        <div class="table-actions">
                            <label>Add Member to Group</label>
                            <select data-placeholder="Choose a Group..." id="clear-results" tabindex="2" name="group_action">
                            <option value=""></option>
                                  <?php  foreach ($groups as $group) { 
								  $group_id = $group->group_id;
								  $group_name = $group->group_name;
                                  ?>
								  <option value="<?php echo $group_id; ?>"> <?php echo $group_name; ?></option>
                                 <?php } ?> 
                            </select>
                            <button type="submit" name="join_group" class="btn btn-primary">Add to Group</button>
                        </div>

                                       	   </form>
										   
										   
										   <!-- Modal -->
         <!-- <div class="modal fade"  role="dialog" aria-hidden="true"> -->
		<div id="fixedmodal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style="background:#ccc">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="closeModal('fixedmodal')"><i class="ico-remove"></i> </button>
                  <h4 class="modal-title" id="myModalLabel">Member Details</h4>
                </div>
                <div class="modal-body">  
                  <!--------------------------------------------------->
				  <div id="modalcontent">
				  
				  </div>
				  <!--------------------------------------------------->
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
										   
										   
										   <script>

	function showInfo(modal_div, content_div, request_id)
	{
		//display div
		var md = document.getElementById(modal_div);
		md.style.display = 'block';
		
		//verify xmlhttp object
		var xmlhttp;
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		//do xmlhttp request
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById(content_div).innerHTML=xmlhttp.responseText;
			}
		}
		
		//send request
		xmlhttp.open("GET","<?php echo base_url(); ?>users/member_details/"+request_id,true);
		xmlhttp.send();
	}
	
	function closeModal(modal_div)
	{
		var md = document.getElementById(modal_div);
		if(md.style.display=='block')
		md.style.display='none';
	}

</script>
