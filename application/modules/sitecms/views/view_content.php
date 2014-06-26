			<?php
			$data = $this->session->flashdata('result');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
			?> 
        
<h5 class="widget-name"><i class="icon-columns"></i>Created Pages</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>...</h6></div></div>
                    <div class="table-overflow">
					<form action="<?php echo base_url(); ?>sitecms/managecontent" method="post">

                        <table class="table table-striped table-bordered" id="data-table">
                            <thead>
                                <tr>
                                    <th><center><input type="checkbox" name="checkrow" class="styled" /></center></th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($contents as $content) { ?>
								<?php $id = $content->content_id; ?>
								<?php $menu = $content->slug; ?>
                                <tr>
                                    <td>
                <center><input type="checkbox" style="width: 20px;" name="checkbox[]" value="<?php echo $id; ?>" class="styled"></center>
                                    </td>
                                    <td> <?php echo '<a href="' . base_url() . 'pages/' . $content->slug . '" 
									title="' . $content->title . '" style="text-decoration:underline">' . $content->title . '</a>'; ?>
                                    
                                    </td>
                            <td> 
							<?php 
							$user = $content->author_id;
							//$query = $this->db->get_where('users', array('id' => $user), 1); 
							$query = $this->db->query("SELECT * FROM users WHERE id='$user' LIMIT 1");

							if ($query->num_rows() > 0)
							{
							   $row = $query->row();
							   echo $row->username;
							} 
							
							?></td>
                            
                            <td> 
							<?php 
							// to show if the page is published or not
							$published = $content->published; 
							if ($published == 1) {
								echo "published";
								} else {
									echo "not published";}
							
							?></td>
                                    <td> <?php echo $content->date_created; ?></td>
                                    
								<td> 
								<?php $edit_url = base_url().'sitecms/create/'.$content->content_id; ?>
								<?php echo '<a href=" ' . base_url() . 'sitecms/create/'. $id . '" class="btn btn-info tip" title="Edit"><i class="icon-pencil"></i></a>'; ?></td>
                                
								<td> <?php 
							echo '<a href="' . base_url() . 'sitecms/delete/'. $id .'" 
							onclick="return confirm(\'Are you sure you want to delete this page?\');" class="btn btn-danger tip" title="Move to trash"><i class="icon-trash"></i></a>'; ?>
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
                                                <option value="1"> Publish Selected Content </option>
                                                <option value="0"> Unpublish Selected Content </option>
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
                    
                   <button type="submit" id="submitButton" name="update" class="btn btn-primary">Update</button>
                
               	   </form>           
                
