<?php
			$data = $this->session->flashdata('result');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
			?>                 
        <!-- Default datatable -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>Found <?php echo $pending_results; ?> Pending Users</h6>
                    
                    
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
                    <form action="<?php echo base_url(); ?>users/manageuser" method="post">

                        <table class="table table-striped table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th><center><input type="checkbox" name="checkrow" class="styled" /></center></th>
                                    <th>Username</th>
                                    <th>Email Address</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($users as $user) { ?>
								<?php $id = $user->member_id; ?>
                                <tr>
                                    <td>
                <center><input type="checkbox" style="width: 20px;" name="checkbox[]" value="<?php echo $id; ?>" class="styled"></center>
                                    </td>
                                    <td> <?php echo '<a class="testButton" id="testButton1">' . $user->username . '</a>'?></td>
                                    <td> <?php echo $user->email; ?></td>
                                    <td> <?php echo $user->mobile; ?></td>
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
                                                <option value="1"> Unblock Selected User(s) </option>
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
                                                       	   </form>
