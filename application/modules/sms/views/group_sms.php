<?php
			$data = $this->session->flashdata('result');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
			?>
<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>

                        <form action="<?php echo base_url(); ?>sms/bulk_sms" method="post">
                
                        <div class="control-group">
                        <label class="control-label"><h6>Groups</h6></label>
                         <div class="controls">

                            <select data-placeholder="Choose a Group..." id="clear-results" tabindex="2" name="group">
                            <option value=""></option>
                                 <?php  $query = $this->db->query("SELECT * FROM groups");

												foreach ($query->result_array() as $row)
												{
												  echo '<option value="' .$row['group_id']  .'">' . $row['group_name']  . ' </option>';
												   //echo $row['loan name'];
												}
												?>
                            </select>
                                                       
                            </div> </div>
                            
                            
                            <div class="control-group">
	                                <label class="control-label">Message: <span class="text-error">*</span></label>
	                                <div class="controls">
	                                    <textarea rows="5" cols="35" name="message" class="validate[required] span12"></textarea>
	                                </div>
	                            </div>
                                
          <button type="submit" name="send" class="btn btn-primary">Send Message</button>

			</form>