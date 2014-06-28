               
               <?php
			   
			   
$data = $this->session->flashdata('result');
if (isset($data)) echo '<h6>' . $data . '</h6>';
?> 

        <!-- Default datatable -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>All Groups</h6></div></div>
                    <div class="table-overflow">
                    <form action="<?php echo base_url(); ?>groups/managegroups" method="post">

                        <table class="table table-striped table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th><center><input type="checkbox" name="checkrow" class="styled" /></center></th>
                                    <th>Group Name</th>
                                    <th>Created by</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th> View </th>
                                    <th> Join </th>
  <?php if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
       				 echo '<th> Delete </th>';
  }
  ?>
  
                                </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($groups as $group) { ?>
								<?php $id = $group->group_id; ?>
                                <tr>
                                    <td>
                <center><input style="width: 20px;" name="checkbox[]" type="checkbox" value="<?php echo $id; ?> " class="styled"></center>
                                    </td>
                                    <td> <?php echo $group->group_name; ?></td>
                                    <td> <?php
									    
										// accidental query, ll refactor later incase you see this. @schand
										$userId =$group->group_admin;
										$query = $this->db->query("SELECT firstname, lastname, username FROM users WHERE id='$userId'");
										foreach ($query->result() as $row)
											{
											   echo $row->firstname;
											   echo "  ";
											   echo $row->lastname;
											}
								 		 ?>
                                 </td>
                                 <td> <?php echo $group->status; ?></td>

                                    <td> 
								<?php								
								 echo '<p class="tym"><font style="font-size: 12px;">';
									$days = floor($group->TimeSent / (60 * 60 * 24));
										$remainder = $group->TimeSent % (60 * 60 * 24);
										$hours = floor($remainder / (60 * 60));
										$remainder = $remainder % (60 * 60);
										$minutes = floor($remainder / 60);
										$seconds = $remainder % 60;
								if($days > 0)
										echo date('F d Y', $group->date);
										elseif($days == 0 && $hours == 0 && $minutes == 0)
										echo "few seconds ago";		
										elseif($days == 0 && $hours == 0)
										echo $minutes.' minutes' . " " . $seconds.' seconds ago';
										elseif($days == 0)
										echo $hours.' hours' . " " . $minutes.' minutes' . " " . $seconds.' seconds ago';
										echo '</font></p>';
										 ?>
										</td>
                                        
                          <?php $base_url = base_url(); ?>
                          <td> 
						  <?php echo'<a href="' .$base_url . 'groups/view_selected/'. $id . '" class="btn btn-info tip" title="View"><i class="icon-zoom-in"></i></a>'; ?>
						  </td>
                          
                          <td> 
						  <?php echo'<a href="' .$base_url . 'groups/join/'. $id . '" class="btn btn-info tip" title="Join Group"><i class="ico-ok"></i></a>'; ?>
						  </td>
                          
   <?php if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") { ?>

						  <td><?php echo'<a href="' .$base_url . 'groups/deletegroup/'. $id .'" 
								onclick="return confirm(\'Are you sure you want to delete the group?\');" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>'; ?></td>
                                <?php } ?>
						    			
                                    								

                                </tr>
								 <?php } ?>
						        </tbody>
</table>

 </div>
                    <div class="table-footer">
                        <div class="table-actions">
                            <label>Apply action:</label>
                            <select class="styled" name="action">  <!-- select name should be "action" if needed -->
                                <option value="">Select action...</option>
                                <option value="suspended">Suspend Selected Group</option>
	                            <option value="active">Activate Selected Group</option>
                            </select>
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
                    
                   <button type="submit" name="update" class="btn btn-primary">Update</button>

                
               	   </form>
                
                
                
