<h3>Membership Account Setup</h3>

<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>


<form action="<?php echo base_url(); ?>users/createMember" method="post"
      enctype="multipart/form-data" name="form" id="form1" onSubmit="return validateForm()">

<div class="widget">
<div class="navbar">
    <div class="navbar-inner"><h6>Biodata</h6></div>
</div>
<div class="well">
<div class="alert margin">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Field marked <span style="color:#F00">*</span> are compulsory
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
            <input id="prependedInput" type="text" name="firstname" placeholder="Firstname"/>
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
            <input id="prependedInput" type="text" name="lastname" placeholder="Lastname"/>
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">

                                            <i class="icon-phone"></i>
                                                <span style="color:#F00">*</span>
                                            </span>
            <input type="text" name="mobile" placeholder="Mobile Number" id="mobile"
                   onkeypress="return isNumberKey(event)"/>
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-envelope"></i>
                                            </span>
            <input id="prependedInput" type="email" name="email" placeholder="Email Address"/>
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
            <select name="gender">
               <option value=""> (Select a Gender)  </option>
               <option value="Male"> Male </option>
               <option value="Female"> Female </option>
            </select>
        </div>
    </div>
</div>


<div class="navbar">
    <div class="navbar-inner">
        <h6>Contact Information</h6>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="homeaddress" placeholder="Home Address"/>
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="hometown" placeholder="Home Town"/>
        </div>
    </div>
</div>

<div class="navbar">
    <div class="navbar-inner">
        <h6>Work Information</h6>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="branch" placeholder="Branch"/>
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-home"></i>
                                            </span>
            <input id="prependedInput" type="text" name="djc" placeholder="Date Joined Company"/>
        </div>
    </div>
</div>

<!-- Login Information Group -->
<div class="navbar">
    <div class="navbar-inner"><h6>Login Information</h6></div>
</div>


<div class="control-group">
    <div class="controls">
        <label>Supply a user name</label>

        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
            <input id="prependedInput" type="text" name="username" placeholder="Username"/>
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <label>Select a User role</label>

        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-briefcase"></i>
                                            </span>
            <!--input id="prependedInput" type="text" name="username" placeholder="Username" /-->
            <select name="role">

                <?php
                $this->load->model('Role_model', 'role');
                $data = $this->role->getAvailableRoles();
                foreach ($data->result() as $row) {
                    echo '<option value="' . $row->id . '">' . $row->title . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <label>Choose a password for this user. Kindly note the supplied password as you may need to give it to the
            user</label>

        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-eye-close"></i>
                                            </span>


            <?php if (isset($update_id)) {
                echo '<input type = "hidden" name="update_id" 
                value="' . $update_id . '" />';
            }
            ?>


            <input id="prependedInput" type="password" name="passwd" placeholder="Password"/>&nbsp;
            <input id="prependedInput" type="password" name="passwd2" placeholder="Confirm Password"/>
        </div>
    </div>
</div>
<!--input id="prependedInput" type="hidden" name="passwd" value=" <?php /*echo uniqid();*/ ?>" /-->


<div class="form-actions align-right">

    <button type="submit" class="btn btn-primary">Create Account</button>
    <button type="reset" class="btn btn-danger">Reset</button>
</div>


<script type="text/javascript">

    function validateForm() {
        var f = document.forms["form"]["firstname"].value;
        if (f == null || f == "") {
            alert("Please enter your First Name");
            return false;
        }


        var l = document.forms["form"]["lastname"].value;
        if (l == null || l == "") {
            alert("Please enter your Last Name");
            return false;
        }


        var x = document.forms["form"]["email"].value;
        if (x == null || x == "") {
            alert("Please enter your Email Address");
            return false;
        }

        var x = document.forms["form1"]["email"].value;
        var atpos = x.indexOf("@");
        var dotpos = x.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
            alert("Not a valid Email address");
            return false;
        }

        var m = document.forms["form"]["mobile"].value;
        if (m == null || m == "") {
            alert("Please enter your mobile number");
            return false;
        }

        if (m.length < 11 || m.length > 13) {
            alert("Not a valid mobile number");
            return false;
        }
        var q = document.forms["form"]["username"].value;
        if (q == null || q == "") {
            alert("Please enter your Username");
            return false;
        }

        var w = document.forms["form"]["passwd"].value;
        if (w == null || w == "") {
            alert("Please enter your Password");
            return false;
        }

        var e = document.forms["form"]["passwd2"].value;
        if (e == null || e == "") {
            alert("Please enter your Confirmation Password");
            return false;
        }
        if (w !== e) {
            alert('Passwords do not match. Please try again');
        }


    }

</script>
