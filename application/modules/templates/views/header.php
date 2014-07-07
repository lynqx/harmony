<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <?php
    // Check for a $page_title value:
    if (!isset($page_title)) {
        $page_title = 'Admin Registration';
    }
    ?>
    <title>
        <?php
        $first_name = $this->session->userdata('first_name');
        $last_name = $this->session->userdata('last_name');
        if ($first_name) {
//if (isset($_COOKIE['user_id'])) {
            echo $page_title . "- " . $first_name . " " . $last_name . " ::Armony";
        } else {

            echo $page_title . " - ::Armony";
        }
        ?></title>


    <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css"/>


    <!------------ site favicon logo ---------->
    <?php

    foreach ($displays as $display) {
        $fav = $display->favicon;
        if ($fav == 1) {

            foreach ($logos as $sitelogo) {
                $favicon = $sitelogo->favicon;
                ?>

                <link rel="shortcut icon" href="<?php echo base_url() . 'img/' . $favicon; ?>"/>

            <?php
            }
        }
    }
    ?>


   <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" type="text/css"/>
    
    
    <!--[if IE 8]>
    <link href="css/ie8.css" rel="stylesheet" type="text/css"/><![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>ckeditor/contents.css"/>
    


    <!--code for date and time function  ##Lynqx 19012014-->

    <script language="javascript">

        function clock() {
// Get today's current date.
            var now = new Date();
// Array list of days.

            var days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
// Array list of months.

            var months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
// Calculate the number of the current day in the week.

            var date = ((now.getDate() < 10) ? "0" : "") + now.getDate();
            if (date == '01') {
                date = '1st';
            } else if (date == '02') {
                date = '2nd';
            } else if (date == '03') {
                date = '3rd';
            } else {
                date = date + "th";
            }
// Calculate four digit year.

            function fourdigits(number) {

                return (number < 1000) ? number + 1900 : number;

            }

            var hours = now.getHours();
            var amPm = (hours > 11) ? "pm" : "am";
            hours = (hours > 12) ? hours - 12 : hours;

            var minutes = now.getMinutes();
            minutes = (minutes < 10) ? "0" + minutes : minutes;

            var seconds = now.getSeconds();
            seconds = (seconds < 10) ? "0" + seconds : seconds;

// Join it all together

            today = days[now.getDay()] + ", " + date + " of " +

                months[now.getMonth()] + " " + +

                (fourdigits(now.getYear())) + " (" + hours + ":" + minutes + ":" + seconds + " " + amPm + ") ";
// Print out the data.


            if (document.getElementById) {
                document.getElementById("clockspa").innerHTML = today;
            }

            setTimeout("clock()", 1000);
        }

    </script>

    <!--sa input that accept number only-->
    <SCRIPT language=Javascript>
        <!--
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        //-->
    </SCRIPT>

</head>

<body onLoad="clock()">

<!-- Fixed top -->
<div id="top">
    <div class="fixed">
        <!------------display site logo ---------->
        <?php


        // allowed to use logo on site ?
        foreach ($displays as $display) {
            $logo = $display->logo;
            $defaultlogo = $display->defaultlogo;


            if ($logo == 1) {

                // which logo to use, uploaded or default
                if ($defaultlogo == 1) {
                    ?>

                    <a href="index.html" title="" class="logo">
                        <?php
                        foreach ($logos as $sitelogo) {
                            $logo = $sitelogo->logo;
                            echo '<img src="' . base_url() . 'img/' . $logo . '" alt="" />';
                        }
                        ?>
                    </a>
                <?php
                } else {
                    echo '<a href="index.html" title="" class="logo"><img src="' . base_url() . 'img/defaultlogo.png" alt="" /></a>';
                }
            }
        }
        ?>

        <!------------display site name ---------->
        <?php

        foreach ($settings as $setting) {


        $companyname = $setting->companyname;
        $shortname = $setting->shortname;
        ?>

        <p title="" class="sitename"> <?php
            foreach ($displays as $display) {
                $sitename = $display->sitename;

                if ($sitename == 1) {

                    echo $companyname;
                }
            }
            } ?></p>

        <?php $id = $this->session->userdata('id'); ?>

        <ul class="top-menu">
            <li><a class="fullview" title="toggle sidebar"></a></li>
            <li>
                <!-- Count number of new messages -->

                <?php
                $status = 'unread';
                // to count and echo number of unread messages
                $query = $this->db->query("SELECT * FROM user_messages WHERE receipient_id = '$id' and state = 'unread'");
                $msg = $query->num_rows();
                ?>
                <a href="<?php echo base_url(); ?>message" title=" <?php echo $msg; ?> new messages" class="messages">

                    <?php
                    if ($msg > 0) {
                        echo '<i class="new-message">&nbsp;' . $msg . ' </i>';
                    }
                    ?>

                </a></li>


            <?php // Create a login/logout link:
            //if(!isset($is_logged_in) || $is_logged_in != true) {

            if ($this->session->userdata('username')) {
                ?>
                <li class="dropdown">
                    <a class="user-menu" data-toggle="dropdown">

                        <?php foreach ($photos as $photo) { ?>
                            <?php $image = $photo->image; ?>
                            <img src=" <?php echo base_url(); ?>userphoto/<?php echo $image ?>" width="22" height="22"/>
                        <?php } ?>

                        <span>Howdy, <?php echo $this->session->userdata('username'); ?> !
                     
                    <b class="caret"></b></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>userview/profile" title=""><i class="icon-user"></i>Profile</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>selfservice" title=""><i
                                    class="icon-user"></i>Dashboard</a></li>
                        <li><a href="<?php echo base_url(); ?>message" title=""><i class="icon-inbox"></i>Messages

                                <!-- number of new messages counted above -->
                                <span class="badge badge-info"><?php echo $msg; ?></span></a>

                            <!-- End for Count number of new messages, user dropdown menu continues -->
                        </li>
                        <li><a href="<?php echo base_url(); ?>settings/<?php echo $id; ?>" title=""><i
                                    class="icon-cog"></i>Settings</a></li>
                        <li><a href="<?php echo base_url(); ?>users/logout" title="End Session"
                               onclick="return confirm('Are you sure you want to log out?');"><i
                                    class="icon-remove"></i>Logout</a></li>
                    </ul>
                </li>

            <?php
            } else {
                $baseUrl = base_url();
                echo '<li class="dropdown"><a class="user-menu" href="' . $baseUrl . 'users/login">Login</a></li>';

            }
            ?>

        </ul>

        <!-- Block for date and time function -->
        <div id="clockspa"></div>
        <!-- End block date and time -->
    </div>
</div>
<!-- /fixed top -->


<!-- Content container -->
<div id="container">