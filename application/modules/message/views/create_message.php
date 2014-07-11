<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/27/14
 * Time: 6:55 AM
 */
?>
<div class="navbar">
    <div class="navbar-inner">
        <?php if(isset($users)) {
		echo '<h6>Reply Message</h6>';
		} else {
		echo '<h6>Create a message</h6>';
		}
		?>
    </div>
</div>
<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>
<h6><?php
    $data = $this->session->flashdata('result');
    if (isset($data)) echo $data;

    ?></h6>
<form name="create_message" id="create_message" method="post" action="<?php echo base_url(); ?>message/compose" enctype="multipart/form-data">

<?php 
			if(isset($users)) {
			foreach ($users as $user) {
			$username = $user->username;
				?>
				
		<div class="control-group">
        <div class="controls">
            <label class="control-label"><h6>Receipient</h6></label>

            <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-tag"></i>
                                            </span>
                <input id="prependedInput" type="text" name="receiver_id" value ="<?php echo $username ?>" class="input-xlarge" readonly/>
            </div>
        </div>
    </div>
								
			<?php	}
				} else {
				
				?>
    <div class="control-group">
        <div class="controls">
            <label class="control-label"><h6>Receipient</h6></label>

            <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-user"></i>
                                            </span>
                <select name="receiver_id">
                    <?php
                    //TODO: Check permissions.
                    //TODO: If user is admin determine which list to render
                    //TODO: It's a good thing we now get the user rolename :)
                    //TODO: So we should get the user from the session
                    $username = $this->session->userdata('username');
                    $call = modules::run('permissions/getUserRolePermissions', $username);
                    $role = $call->rolename;
                    // The module returns a User_model object
                    //TODO: Is this user an admin? Doesn't matter now ;)
                    $roleToGet = ''; // Default
                    if ($role == 'admin') {
                        $roleToget = 'cooperator';
                    } else $roleToget = 'admin'; //Redundant eh?
                    //Load the platforms users that are not admin
                    $users = modules::run('permissions/getUsers', $roleToget); // Gets us the users that are not Admins
                    foreach ($users as $row) {
                        echo '<option value="' . $row->Id . '">' . $row->username . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
    </div>
	
	<?php } ?>
	
	    <div class="control-group">
        <div class="controls">
            <label class="control-label"><h6>Message Subject</h6></label>

            <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-tag"></i>
                                            </span>
                <input id="prependedInput" type="text" name="subject" placeholder="Subject" class="input-xlarge"/>
            </div>
        </div>
    </div>
	
    <div class="control-group">
        <label class="control-label">Message Content</label>

        <div class="controls"><textarea rows="10" cols="10" name="content" class="auto span12"
                                        style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 180px;width:600px"></textarea>
        </div>
    </div>
    <div class="control-group">

        <div class="controls">
            <input type="submit" value="Send Message" class="btn btn-success btn-large">
            <input type="reset" value="Reset" class="btn btn-danger btn-large">
            <input type="button" value="Save Draft" class="btn btn-info btn-large" formaction="message/save">
        </div>

</form>