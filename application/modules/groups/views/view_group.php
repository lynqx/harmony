

<h5 class="widget-name"><i class="icon-th-list"></i> <?php echo $groupname; ?></h5>

	                        <div class="tabbable">
	                            <div class="tab-content">
	                                <div class="tab-pane active fade in" id="tab5">             
                  
                    
                    <!-- Collapsible widget -->
	                    <div class="widget">
	                        <div class="navbar">
	                            <div class="navbar-inner">
	                                <h6>Group Information <small> (Click arrow beside to toggle open or close) </small></h6>
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
                                  <td width="250"><strong>Name of Group</strong></td>
                                  <td><?php echo $groupname; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="250"><strong>Administrator</strong></td>
                                  <td><?php
								  // accidental query
							$query = $this->db->query("SELECT * FROM users WHERE id='$groupadmin' LIMIT 1");

							if ($query->num_rows() > 0)
							{
							   $row = $query->row();
							   echo $row->username;
							} 
							
							?></td>
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
	                                <h6> Group Members <small> (Click arrow beside to toggle open or close) </small></h6>
	                                <div class="nav pull-right">
	                                    <a class="navbar-icon" data-toggle="collapse" data-target="#demo2"><i class="icon-resize-vertical"></i></a>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="collapse" id="demo2">
	                            <div class="well body">
                                
                                <div class="table-overflow">
                                
                                <ul>
          	<?php 
			
			// now calls dynamic pages menu links the normal way
			// no more accidentals ## Samuel
			echo '<table class="table table-striped table-bordered" id="data-table">';
			echo '<thead>
                   <tr>
                   			<th><center><input type="checkbox" name="checkrow" class="styled" /></center></th>
                                    <th>Name</th>
                                    <th>Operations</th>
                                    </tr>
                            </thead>
                            <tbody>';
					if (isset($members)) {
				  foreach ($members as $member) { 
                  $group_members = $member->firstname . '  ' . $member->lastname;
                  $id = $member->id;
				 echo '<tr>
                 <td><center><input type="checkbox" style="width: 20px;" name="checkbox[]" value="' .$id . '?>" class="styled"></center></td`>
				 <td><a href="' . base_url() . 'userview/view/' . $id . ' " title="View members profile">' . $group_members . '</a></td>'; 
				 ?>
				 
				 <td><?php echo'<a href="'. base_url() . 'groups/remove/'. $id .'"onclick="return confirm(\'Are you sure you want to remove member from group?\');" class="btn btn-info tip" title="Remove"><i class="ico-remove"></i></a>'; ?></td>
					<?php 			
				echo '</tr>';
                 //echo $menu->title;
					} 
					} else {
						echo 'No members in this group';
						}
						
						echo '</tbody></table>';

            ?>
        </ul>
                       
                    </div>
                    
                                </div>
	                        </div>
	                    </div>
	                    <!-- /collapsible widget -->
                                                            </div>
                <!-- /table with toolbar -->