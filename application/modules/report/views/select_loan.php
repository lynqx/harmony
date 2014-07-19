<?php

echo validation_errors('<p class="error" style="color:#F00">');


if ($loantypes) {
    ?>

    <div class="widget">
        <div class="navbar">
            <div class="navbar-inner">
                <h6>Loan Report</h6>

                <div class="nav pull-right">
                    <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo base_url(); ?>loan/view"><i class="icon-zoom-in"></i>View All Loans</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <form id="selectLoanWizard" method="post" name="form"
              action="<?php echo base_url(); ?>report/report_loan" class="form-horizontal row-fluid well">
            <fieldset class="step" id="step1">
                <div class="step-title">
                    <i>1</i>
                    <h5>Loan Type to Export</h5>
                    <span>Select the loan to generate reports</span>
                </div>
                <div>
                    <div class="control-group">
                        <label class="control-label">Loan To Report:</label>

                        <div class="controls">
                            <select data-placeholder="Choose a Loan" tabindex="2" name="selectloanname" class="select"
                                    required="required">
                                <option value=""></option>

                                <?php
                                foreach ($loantypes as $loantype) {
                                    $loan_id = $loantype->loan_id;
                                    $loanname = $loantype->loanname;

                                    echo '<option value="' . $loan_id . '">' . $loanname . ' </option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
            </fieldset>

            <!---------- Members participation --------->

            <fieldset id="step2" class="step">
                <div class="step-title">
                    <i>2</i>
                    <h5>Fields to Export</h5>
                    <span>Select the fields from the db to export the reports</span>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div style="margin-top: 10px;">
                            <label class="radio inline">
                                <input type="checkbox" style="width: 20px;" name="member" value="member_id"
                                       class="styled">
                                Cooperator's Name
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <label class="radio inline">
                                <input type="checkbox" style="width: 20px;" name="amount" value="amount" class="styled">
                                Loan Amount
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <label class="radio inline">
                                <input type="checkbox" style="width: 20px;" name="duration" value="duration"
                                       class="styled">
                                Duration
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <label class="radio inline">
                                <input type="checkbox" style="width: 20px;" name="loanbalance" value="loanbalance"
                                       class="styled">
                                Loan Balance
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <label class="radio inline">
                                <input type="checkbox" style="width: 20px;" name="reason" value="reason" class="styled">
                                Reason
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <label class="radio inline">
                                <input type="checkbox" style="width: 20px;" name="formno" value="formno" class="styled">
                                Form Number
                            </label>
                        </div>

                        <div style="margin-top: 10px;">
                            <label class="radio inline">
                                <input type="checkbox" style="width: 20px;" name="status" value="status" class="styled">
                                Status
                            </label>
                        </div>
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
                        <select data-placeholder="Status" tabindex="2" name="status2" class="select"
                                required="required">
                            <option value=""></option>
                            <option value="pending"> Pending</option>
                            <option value="active"> Active</option>
                            <option value="complete"> Completed</option>

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
                            <option value=""></option>
                            <option value="10"> 10</option>
                            <option value="25"> 25</option>
                            <option value="100"> 100</option>

                        </select>
                    </div>
                </div>
            </fieldset>


            <div class="form-actions align-right">
                <input class="btn" id="back-1" value="Back" type="reset"/>
                <input type="submit" class="btn btn-danger" id="next-1" value="Next">
            </div>
        </form>
    </div>
    <!-- /end wizard -->

<?php
} else {
    echo "No loans selected";
}