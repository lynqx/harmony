<!-- Sidebar -->
<div id="sidebar">

<div class="sidebar-tabs">
<ul class="tabs-nav two-items">
    <li><a href="#general" title=""><i class="icon-reorder"></i></a></li>
    <li><a href="#stuff" title=""><i class="icon-cogs"></i></a></li>
</ul>


<div id="general">

<!-- Sidebar user -->
<div class="sidebar-user widget">
    <div class="navbar">
        <div class="navbar-inner">
            <h6>
                <?php // Create a login/logout link:
                //if(!isset($is_logged_in) || $is_logged_in != true) {

                // global base url for links
                $base_url = base_url();

                $firstname = $this->session->userdata('firstname');
                $lastname = $this->session->userdata('lastname');
                $image = $this->session->userdata('image');
                $id = $this->session->userdata('id');
                if ($id) {

                    foreach ($roles as $role) {
                        $role = $role->role_id;
                        if ($role == 1) {
                            echo "Administrator";
                        } elseif ($role == 2) {
                            echo "Cooperator";
                        }
                    }
                } else {

                    echo 'Welcome Guest';

                }
                ?></h6></div>

        <a href="#" title="" class="user">
            
                <img src=" <?php echo base_url(); ?>userphoto/<?php echo $image ?>" width="172" height="172"/>
        </a>
    </div>

</div>


<!-- /sidebar user overview statistics -->
<!-- / inject permission to make it seen by only administrators -->
<?php if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
    ?>
    <div class="general-stats widget">
        <ul class="head">
            <li><span>All<br/>Members</span></li>
            <li><span>Active<br/> Loans</span></li>
            <li><span>Active<br/>Offers</span></li>
        </ul>
        <ul class="body">
            <li><strong>
                    <?php // calling from templates controller ## function get all members
                    //echo $num_results;
					echo 2105;
                    ?>
                </strong>
            </li>
            <li><strong>
                    <?php // calling from templates controller ## function get all members
                    //echo $num_loans; 
					echo 23;
                    ?>
                </strong></li>
            <li><strong>
                    <?php // calling from templates controller ## function get all members
                    //echo $num_assets;
					echo 531;
                    ?>
                </strong></li>
        </ul>
    </div>
<?php } elseif (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewMember") == "permitted") { ?>

    <div class="general-stats widget">
        <ul class="head">
            <li><span>My<br/>Contributions</span></li>
            <li><span>My<br/> Active Loans</span></li>
            <li><span>My<br/>Active Offers</span></li>
        </ul>
        <ul class="body">
            <li><strong>
                    2
                </strong>
            </li>
            <li><strong>1</strong></li>
            <li><strong>4</strong></li>
        </ul>
    </div>

<?php } ?>


<!-- Main navigation -->
<ul class="navigation widget">
    <li class="active"><a href="<?php echo base_url(); ?>index.php" title=""><i class="icon-home"></i>Home Page</a></li>


    <!-- HomePage Links / no need of permission -->
    <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Quick Links<strong>4</strong></a>
        <ul>

            <li>
                <?php ## toggle login / logout link base on session id
                //$id = $this->session->userdata('id');
                if ($id) {
                    echo '<a href="' . $base_url . 'login/logout" title="End Session" onclick="return confirm(\'Are you sure you want to log out?\');">Logout</a>';
                } else {
                    echo '<a href="' . $base_url . 'login" title="">Login</a>';
                }
                ?>
            </li>
            <li><a href=" <?php echo $base_url; ?>deductions" title="">Deductions</a></li>
            <li><a href=" <?php echo $base_url; ?>contact/about" title="">About Us</a></li>
            <li><a href=" <?php echo $base_url; ?>contact" title="">Contact Us</a></li>
            <li><a href=" <?php echo $base_url; ?>users/change" title="">Change Password</a></li>

        </ul>
    </li>


    <li><a href="#" title="" class="expand"><i
                class="icon-reorder"></i>Features<strong> <?php echo $num_menu; ?> </strong></a>
        <ul>
            <?php

            // now calls dynamic pages menu links the normal way
            // no more accidentals ## Samuel

            foreach ($menus as $menu) {
                $menut = $menu->alias;
                $slug = $menu->slug;
                echo '<li><a href="' . base_url() . 'pages/' . $slug . '" title="">' . $menut . '</a></li>';
                //echo $menu->title;
            }

            ?>
        </ul>
    </li>

    <!-- Basic general Navigation -->


    <!-- Admin Navigation -->
    <!-- inject the permissions module here to determine access -->
    <?php if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewAdmin") == "permitted") {
        echo '
                       <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Basic Operations <strong>6</strong></a>
			                <ul>
			                    <li><a href="' . $base_url . 'viewusers" title="">Coperator Lookup</a></li>
			                    <li><a href="' . $base_url . 'viewusers/pending" title=""> Pending Cooperators </a></li>
			                    <li><a href="' . $base_url . 'viewusers/pending" title=""> Pending Reschedule </a></li>
			                    <li><a href="' . $base_url . 'contribution/transaction" title=""> Perform Transaction</a></li>
								<li><a href="' . $base_url . 'permissions" title="">Create Member</a></li>
								<li><a href="' . $base_url . 'contribution/view" title="">View Contribution Accounts</a></li>
                                <li><a href="' . $base_url . 'contribution/view_transaction" title="">Lumpsum / Withdrawal List</a></li>
			               </ul>
			            </li>';


        echo '
                       <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Member Operations <strong>7</strong></a>
			                <ul>
			                    <li><a href="' . $base_url . 'viewusers" title="">Contribution Reschedule</a></li>
			                    <li><a href="' . $base_url . 'contribution/transaction" title=""> Contribution Lump Sum Payment </a></li>
			                    <li><a href="' . $base_url . 'contribution/transaction" title=""> Part Withdrawal </a></li>
			                    <li><a href="' . $base_url . 'entitlements" title=""> Final Entitlements </a></li>
			                    <li><a href="' . $base_url . 'groups/view" title="">View Groups</a></li>
								</ul>
			            </li>
						
						<!-- Loans Links -->
						<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Loans<strong>5</strong></a>
							<ul>
								<li><a href="' . base_url() . 'loan/viewapply" title="">View Active Loan</a></li>
								<li><a href="' . base_url() . 'loan" title="">Apply for Loan</a></li>
								<li><a href="' . base_url() . 'loans/" title="">Add a New Loan Type</a></li>
								<li><a href="' . base_url() . 'loan/view" title="">Manage Loans</a></li>
								<li><a href="' . base_url() . 'report/loan" title="">Loan Report</a></li>
							</ul>
						</li>

						<!-- Asset Loan Links -->
						<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Asset Loans<strong>5</strong></a>
							<ul>
								<li><a href="' . base_url() . 'assetloan/viewapply" title="">View Active Asset Loans</a></li>
								<li><a href="' . base_url() . 'loan" title="">Apply for Asset Loan</a></li>
								<li><a href="' . base_url() . 'assetloan" title="">Add an Assets </a></li>
								<li><a href="' . base_url() . 'assetloan/viewasset" title="">Manage Asset Types</a></li>
								<li><a href="' . base_url() . 'report/asset" title="">Asset Report</a></li>
							</ul>
						</li>
						
						
						<!-- Contribution Links -->
						<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Contribution Accounts<strong>3</strong></a>
							<ul>
								<li><a href="' . base_url() . 'assetloan/viewapply" title="">Add Contriibution</a></li>
								<li><a href="' . base_url() . 'loan" title="">View Contribution</a></li>
								<li><a href="' . base_url() . 'assetloan" title="">Contribution Report </a></li>
							</ul>
						</li>
						
						 <!------------Messages----------->
		
						 <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Messaging<strong>4</strong></a>
			                <ul>
			                    <li><a href="' . $base_url . 'message/create" title="">Create Message</a></li>
			                    <li>';
        // to count and echo number of unread messages
        $query = $this->db->query("SELECT * FROM user_messages WHERE receipient_id = '$id' and state = 'unread'");
        $msg = $query->num_rows();
        echo '<a href="' . $base_url . 'message" title="">Inbox &nbsp; <span style="color:#f00; font-weight:bold;">(' . $msg . ')</span></a>
								</li>
			                    <li><a href="' . $base_url . 'message/sent" title="">Sent</a></li>
			                    <li><a href="' . $base_url . 'message/draft" title="">Draft</a></li>


			               </ul>
			            </li>
						
						<!-- Utility Links -->
						<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Utilities<strong>8</strong></a>
							<ul>
			                    <li><a href="' . $base_url . 'contact/view" title="">Site Enquiries</a></li>
			                    <li><a href="' . $base_url . 'contact/view" title="">Feedback / Complaints</a></li>
								<li><a href="' . $base_url . 'sitecms/create" title="">Create New Page</a></li>
			                    <li><a href="' . $base_url . 'sitecms/view" title="">View Created Pages</a></li>
			                    <li><a href="' . $base_url . 'groups" title="">Manage Groups</a></li>
			                    <li><a href="' . $base_url . 'sms" title="">Send SMS</a></li>
			                    <li><a href="' . $base_url . 'sms" title="">Post News</a></li>
			                    <li><a href="' . $base_url . 'sms" title="">Loan Calculator</a></li>
							</ul>
						</li>
						
						
						<!-- Report Links -->
						<li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Reports<strong>7</strong></a>
							<ul>
			                    <li><a href="' . $base_url . 'reportview/coperators" title="">Corperator Reports</a></li>
			                    <li><a href="' . $base_url . 'reportview/loan" title="">Loan Reports</a></li>
								<li><a href="' . $base_url . 'reportview/asset" title="">Asset Loan Reports</a></li>
			                    <li><a href="' . $base_url . 'report/contribution" title="">Contribution Report</a></li>
			                    <li><a href="' . $base_url . 'groups" title="">Member Financial Standing</a></li>
			                    <li><a href="' . $base_url . 'reports/log" title="">User Log</a></li>
			                    <li><a href="' . $base_url . 'report/activity" title="">Activity Reports</a></li>
							</ul>
						</li>
						
						<!-- Settings -->
    
                       <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Settings<strong>4</strong></a>
			                <ul>
			                    <li><a href="' . $base_url . 'settings/display_settings" title="">Global Settings</a></li>
			                    <li><a href="' . $base_url . 'settings" title="">Basic Settings</a></li>
			                    <li><a href="' . $base_url . 'settings/sms_settings" title="">SMS Settings</a></li>
			                    <li><a href="' . $base_url . 'usersettings" title="">Users Settings</a></li>
								
			                    <li><a href="#" title="">Bank Accounts</a></li>                             
			                    <li><a href="#" title="">Executives</a></li>                             
			               </ul>
			            </li>';

    } ?>


    <!-- Members Navigation -->
    <!-- inject the permissions module here to determine access -->
    <?php if (modules::run('permissions/isPermitted', $this->session->userdata("username"), "canViewMember") == "permitted") {

        // called if self service module is enabled

        echo '
                        <li><a href="#" title="" class="expand"><i class="icon-reorder"></i>Member Panel<strong>4</strong></a>
			                <ul>
			                    <li><a href="' . $base_url . 'selfservice" title="">Dashboard</a></li>
							    <li><a href="' . $base_url . 'selfservice/activeloan" title="">Active Loans</a></li>
							    <li><a href="' . $base_url . 'selfservice/accounts" title="">My Account</a></li>
			                    <li><a href="' . $base_url . 'selfservice/lumpsum" title="">Lump Sum</a></li>
			                    <li><a href="' . $base_url . 'selfservice/transfer" title="">Account Transfer</a></li>
			                    <li><a class="click_apply_for_loan" href="' . $base_url . 'selfservice/applyloan" title="">Apply for Loan</a></li>
			                    <li><a class="click_apply_for_asset_loan" href="#" title="">Apply for Asset Loan</a></li>
			                    <li><a href="' . $base_url . 'selfservice/exitctcs" title="">Exit CTCS</a></li>
			                    <li><a href="' . $base_url . 'selfservice/bidding" title="">Bidding</a></li>
			                    <li><a href="' . $base_url . 'selfservice/nomination" title="">Nomination</a></li>
			               </ul>
			            </li>';
    } ?>


</ul>
<!-- /main navigation -->

</div>

<div id="stuff">

    <!-- company info -->
    <div class="widget">
        <h4 class="widget-name"><i class="ico-info-sign"></i>Company Information</h4>

        <div>
            <h6 class="widget-name"><i class="ico-envelope"></i><b>Company Email</b> <br/>
                    <span style="font-size:12px">
					<?php
                    $email=modules::run('settings/getSetting', "email");
					echo $email->value;
                    ?>
                    </span>
            </h6>
        </div>

        <div>
            <h6 class="widget-name"><i class="icon-phone"></i><b>Company Phone</b> <br/>
                    <span style="font-size:12px">
					<?php 
					$phone=modules::run('settings/getSetting', "mobile");
					echo $phone->value;
					?>
					
                    </span>
            </h6>
        </div>

        <div>
            <h6 class="widget-name"><i class="ico-home"></i><b>Company Address</b> <br/>
                    <span style="font-size:12px">
                    <?php 
					$address=modules::run('settings/getSetting', "address");
					echo $address->value;
					?>
                    </span>
            </h6>
        </div>
    </div>
    <!-- /company info -->


</div>
</div>
</div>
<!-- /sidebar -->