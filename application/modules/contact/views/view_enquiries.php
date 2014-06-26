                
        <!-- Default datatable -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>Found <?php echo $contact_count; ?> unattended enquiries</h6>
                    
                    
                    <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-plus"></i>Add new option</a></li>
                                    <li><a href="#"><i class="icon-reorder"></i>View statement</a></li>
                                    <li><a href="#"><i class="icon-cogs"></i>Parameters</a></li>
                                </ul>
                            </div>
                    
                    
                    </div></div>
                    <div class="table-overflow">
                    <form action="<?php echo base_url(); ?>contact/managecontact" method="post">

                        <table class="table table-striped table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th><center><input type="checkbox" name="checkrow" class="styled" /></center></th>
                                    <th>Fullname</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th> View </th>
                                    <th> Delete </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($contacts as $contact) { ?>
								<?php $id = $contact->contact_id; ?> 
                               <?php
							    if ($contact->status == 0) {
                                echo '<tr style="font-weight:bold;"> ';
								} else {
									echo '<tr>';
									}
									?>
                                    <td>
                <center><input style="width: 20px;" name="checkbox[]" type="checkbox" value="<?php echo $id; ?> " class="styled"></center>
                                    </td>
                                    <td> <?php echo $contact->name; ?></td>
                                    <td> <?php echo $contact->email; ?> </td>
                                    <td> <?php echo $contact->mobile; ?> </td>
                                    <td> <?php 
									$position=30; 
									$msg = $contact->message;
									$message = substr($msg, 0, $position);
									echo '<a href="' . base_url() . 'contact/read/'. $id . '" style="color:#333;">';
									echo $message;
                                   		    $num = strlen($msg);
											$num2 = strlen($message);
									
											if ($num > $num2) 
											{ 
												echo '&nbsp;[...] <br />';
											}
											echo '</a>'; ?> 
                                    </td>
                                    <td> <?php echo $contact->sentdate; ?> </td>
								
                                        
                          
                          <td> 
						  <?php echo'<a href="' . base_url() . 'contact/read/'. $id . '" class="btn btn-info tip" title="View"><i class="icon-zoom-in"></i></a>'; ?>
						  </td>                          
                          
						  <td><?php echo'<a href="' . base_url() . 'contact/delete/'. $id .'" 
								onclick="return confirm(\'Are you sure you want to delete this user?\');" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>'; ?></td>
						    			
                                    								

                                </tr>
                                  <?php }?>
								  
						        </tbody>
</table>

 </div>
                    <div class="table-footer">
                        <div class="table-actions">
                            <label>Apply action:</label>
                            <select class="styled" name="action">
                                <option value="">Select action...</option>
                                <option value="0">Mark as Unread</option>
	                            <option value="1">Mark as Read</option>
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
                
                
                
