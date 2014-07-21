<h5>Administrators only</h5>
<!--Welcome, <?php
//echo $this->session->userdata('firstname');
//echo '  ';
//echo $this->session->userdata('lastname');
?>-->
<div class="row-fluid">
    <div class="container">
        <div class="row-fluid">
            <div class="widget">
                <div class="navbar">
                    <div class="navbar-inner"><h6>Dashboard</h6></div>
                </div>
                <div class="well body">
                    <div class="row-fluid">

                        <div class="span4">
                            <div class="widget">
                                <div class="navbar">
                                    <div class="navbar-inner"><h6>Loans Management</h6></div>
                                </div>
                                <ul class="nav nav-tabs nav-stacked">
                                    <li><a class="view-loans-modal" href="loans/loadApplicationsView"><i
                                                class="icon-home"></i>View Loan
                                            Applications</a>
                                    </li>
                                    <li><a class="apply-loan-modal" href="loans"><i class="icon-move"></i>Add New Loan
                                            Type</a>
                                    </li>
                                    <li class="dropdown" id="menu1"><a class="dropdown-toggle" data-toggle="dropdown"
                                                                       href="#menu1"><i class="icon-ok"></i>Loan Reports
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="loan-pdf-report-modal" href="#"><i class="icon-plus"></i>Download
                                                    as PDF</a></li>
                                            <li><a class="loan-view-report-modal" href="#overlay=reportview/loan"><i
                                                        class="icon-reorder"></i>Download as Excel</a></li>
                                            <li><a class="loan-view-report-modal" href="#overlay=reportview/loan"><i
                                                        class="icon-cogs"></i>View in browser</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><i class="icon-cogs"></i>Manage Loan Types</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="widget">
                                <div class="navbar">
                                    <div class="navbar-inner"><h6>Contributions Management</h6></div>
                                </div>
                                <ul class="nav nav-tabs nav-stacked">
                                    <li class="dropdown" id="menu5"><a class="dropdown-toggle" data-toggle="dropdown"
                                                                       href="#menu5"><i class="icon-ok"></i>Manage
                                            Contribution Accounts <b
                                                class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="view-contributions-modal" href="<?php echo base_url(); ?>contribution/view"><i
                                                        class="icon-eye-open"></i>View Contributions</a></li>
                                            <li><a href="<?php echo base_url(); ?>contribution"><i class="icon-plus"></i>Add A new Contribution Account</a>
                                            </li>
                                            <li><a href="<?php echo base_url(); ?>contribution/join"><i class="icon-plus"></i>Add Member</a></li>

                                        </ul>
                                    </li>
                                    <li class="dropdown" id="menu2"><a class="dropdown-toggle" data-toggle="dropdown"
                                                                       href="#menu2"><i class="icon-ok"></i>Contribution
                                            Reports <b
                                                class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="icon-plus"></i>Download as PDF</a></li>
                                            <li><a href="#"><i class="icon-reorder"></i>Download as Excel</a></li>
                                            <li><a href="#"><i class="icon-cogs"></i>View in Browser</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="widget">
                                <div class="navbar">
                                    <div class="navbar-inner"><h6>Assets Management</h6></div>
                                </div>
                                <ul class="nav nav-tabs nav-stacked">
                                    <li><a class="viewAssets" href="#"><i class="icon-home"></i>View Assets</a></li>
                                    <li class="dropdown" id="menu3"><a class="dropdown-toggle" data-toggle="dropdown"
                                                                       href="#menu3"><i class="icon-ok"></i>Manage
                                            Assets <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="icon-plus"></i>Add new Asset</a></li>
                                            <li><a href="#"><i class="icon-reorder"></i>Update Existing Assets</a></li>
                                            <li><a href="#"><i class="icon-cogs"></i>Remove an Asset</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid">

                        <div class="span4">
                            <div class="widget">
                                <div class="navbar">
                                    <div class="navbar-inner"><h6>Site Management</h6></div>
                                </div>
                                <ul class="nav nav-tabs nav-stacked">
                                    <li class="dropdown" id="menu4">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#menu4"><i class="icon-ok"></i>Manage Pages <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="sitecms/create"><i class="icon-plus"></i>Add New Pages</a></li>
                                            <li><a href="sitecms/view"><i class="icon-cogs"></i>View All Pages</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="widget">
                                <div class="navbar">
                                    <div class="navbar-inner"><h6>Members Management</h6></div>
                                </div>
                                <ul class="nav nav-tabs nav-stacked">
								    <li><a href="users/register"><i class="icon-plus"></i>Add New Member</a></li>
                                    <li class="dropdown" id="menu6">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#menu6"><i class="icon-ok"></i>Manage Members <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="users/viewall"><i class="icon-table"></i> View All Members </a></li>
                                            <li><a href="users/pending"><i class="icon-table"></i> View Pending Members </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="widget">
                                <div class="navbar">
                                    <div class="navbar-inner"><h6>Settings</h6></div>
                                </div>
                                <ul class="nav nav-tabs nav-stacked">
                                    <li class="dropdown" id="menu7"><a class="dropdown-toggle" data-toggle="dropdown"
                                                                       href="#menu7"><i class="icon-ok"></i>Manage
                                            Site Settings <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="view-settings-modal" href="#"><i class="icon-table"></i> View
                                                    Site
                                                    Settings </a></li>
                                            <li><a href="#"><i class="icon-reorder"></i>Modify Site settings</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
