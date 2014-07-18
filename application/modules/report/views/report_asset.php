
        <!-- Default datatable -->
                <div class="widget">
                	<div class="navbar"><div class="navbar-inner"><h6>Active Loan Reports</h6>
                    
                    <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-reorder"></i> Save PDF</a></li>
                                </ul>
                            </div>
                    </div></div>

                    <div class="table-overflow">

                        <table class="table table-striped table-bordered">
                            <thead>
                            <?php 
							if ($loanrecords) {
							foreach ($loanrecords as $loanrecord) { ?>
								<?php if (isset($loanrecord->member_id)) $member = $loanrecord->member_id; ?>
								<?php if (isset($loanrecord->amount)) $amount = $loanrecord->amount; ?>
								<?php if (isset($loanrecord->duration)) $duration = $loanrecord->duration; ?>
                                <?php } 
								} else {
									echo 'No data found';
									}?>
                                <tr>
                                    <?php if (isset($member)) { echo '<th> Corperator\'s Name </th>';  }?>
                                    <?php if (isset($amount)) { echo '<th> Amount </th>';  }?>
                                    <?php if (isset($duration)) { echo '<th> Duration </th>';  }?>
                                    
                                </tr>
                            </thead>

                            <tbody>
							<?php foreach ($loanrecords as $loanrecord) { ?>
								<?php if (isset($loanrecord->member_id)) $member = $loanrecord->member_id; ?>
								<?php if (isset($loanrecord->amount)) $amount = $loanrecord->amount; ?>
								<?php if (isset($loanrecord->duration)) $duration = $loanrecord->duration; ?>
                 					
                                    <tr>
                 					<?php if (isset($member)) { echo '<td>';
									// accidental query, ll refactor later incase you see this. @schand
										$query = $this->db->query("SELECT firstname, lastname, username FROM users WHERE id='$member'");
										foreach ($query->result() as $row)
											{
											   echo $row->firstname. ' ' . $row->lastname;
											   
											}
								 		 echo '</td>'; }?>
                                    <?php if (isset($amount)) { echo '<td>N ' .$amount . '</td>'; }?>
                                    <?php if (isset($duration)) { echo '<td>' .$duration . ' Months</td>'; } ?>                          
                                 </tr>
								 <?php } ?>
						        </tbody>
</table>

 </div>
 
					 <div class="table-footer">
                        <div class="table-actions">
                            <form action="<?php echo base_url(); ?>pdff" method="post">
                            <input type="hidden" name="filename" value="Active Loan" />
                            <input type="hidden" name="viewfile" value="report/report_loan" />
                                                
                   <button type="submit" id="submitButton" name="update" class="btn btn-primary">Save PDF</button>
							</form>
                        </div>
                    