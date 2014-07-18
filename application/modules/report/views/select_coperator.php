<?php

			echo validation_errors('<p class="error" style="color:#F00">');


				?>
				
				 <div class="widget">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <h6>Coperator Report</h6>
                            <div class="nav pull-right">
                                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-zoom-in"></i>Export Coperator</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form id="wizard1" method="post" name="form" 
                    action="<?php echo base_url();?>report/report_coperator" class="form-horizontal row-fluid well">
                       
                       
                       <!---------- Columns to display --------->
                     
                        <fieldset id="step1" class="step">
                            <div class="step-title">
                            	<i>1</i>
					    		<h5>Fields to Export</h5>
					    		<span>Select the fields from the db to export the reports</span>
					    	</div>
                            <div class="control-group">
	                                        <div class="controls">
												<div style="margin-top: 10px;">
													<label class="radio inline">
                                                    <input type="checkbox" style="width: 20px;" name="firstname" value="firstname" class="styled">
														First Name
													</label>
												</div>
                                                
                                                <div style="margin-top: 10px;">
													<label class="radio inline">
                                                    <input type="checkbox" style="width: 20px;" name="lastname" value="lastname" class="styled">
														 Last Name
													</label>
												</div>
                                                
                                                <div style="margin-top: 10px;">
													<label class="radio inline">
                                                    <input type="checkbox" style="width: 20px;" name="email" value="email" class="styled">
														Email
													</label>
												</div>
                                                
                                                <div style="margin-top: 10px;">
													<label class="radio inline">
                                                    <input type="checkbox" style="width: 20px;" name="mobile" value="phone_number" class="styled">
														Mobile
													</label>
												</div>
                                                                                               
                                                <div style="margin-top: 10px;">
													<label class="radio inline">
                                                    <input type="checkbox" style="width: 20px;" name="status" value="active" class="styled">
														Status
													</label>
												</div>
	                                        </div>
	                                    </div>
                        </fieldset>
                        
                                                
                     <!---------- Members participation --------->
                     
                        <fieldset id="step2" class="step">
                            <div class="step-title">
                            	<i>2</i>
					    		<h5>Filter by Date Joined</h5>
					    		<span>Select the date range for report</span>
					    	</div>
                            <div class="control-group">
		                                <label class="control-label">Date range:</label>
		                                <div class="controls">
		                                    <ul class="dates-range">
		                                        <li><input type="text" class="datepicker" name="start" placeholder="Start Date" /></li>
		                                        <li class="sep">-</li>
		                                        <li><input type="text" class="datepicker" name="end" placeholder="End Date" /></li>
		                                    </ul>
		                                </div>
		                            </div>
                        </fieldset>
                        
                        
                        <fieldset id="step3" class="step">
                            <div class="step-title">
                            	<i>3</i>
					    		<h5>Status</h5>
					    		<span>Filter by status (Leave blank for all)</span>
					    	</div>
                            <div class="control-group">
                                           	<label class="control-label">Status:</label>
	                                        <div class="controls">
	                                            <select data-placeholder="Status" tabindex="2" name="status2" class="select">
                                                <option value=""> Default</option>
                                                <option value="0"> Blocked </option>
                                                <option value="1"> Active </option>
                                                </select>
	                                        </div>
	                                    </div>	                                   
                                                                </fieldset>
                                                                
                        <fieldset id="step4" class="step">
                            <div class="step-title">
                            	<i>4</i>
					    		<h5>Number of Records to Export</h5>
					    		<span>Select the number of records to select from the db to export the reports</span>
					    	</div>
                            <div class="control-group">
                                           	<label class="control-label">Number of Records:</label>
	                                        <div class="controls">
	                                            <select data-placeholder="Number of Records" tabindex="2" name="limit" class="select">
                                                <option value="10"> 10 </option>
                                                <option value="25"> 25</option>
                                                <option value="100"> 100 </option>
                                                <option value="100000"> All </option>

                                                </select>
	                                        </div>
	                                    </div>	                                   
                                                                </fieldset>
                        
                        
                        <div class="form-actions align-right">
                            <input class="btn" id="back-1" value="Back" type="reset" />
                            <input type="submit" class="btn btn-danger" id="next-1" value="Next">
                        </div>
                    </form>
                </div>
                <!-- /end wizard -->
