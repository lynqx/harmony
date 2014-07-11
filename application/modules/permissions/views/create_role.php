			<?php
			$data = $this->session->flashdata('result');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
			?>
			
			<h3>Role Setup</h3>

<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>


<form action="<?php echo base_url(); ?>permissions/createRole" method="post"
      enctype="multipart/form-data" name="form" id="form1" onSubmit="return validateForm()">

<div class="widget">
<div class="navbar">
    <div class="navbar-inner"><h6>Role</h6></div>
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
            <input id="prependedInput" type="text" name="rolename" placeholder="Role Name"/>
        </div>
    </div>
</div>

<div class="form-actions align-right">

    <button type="submit" class="btn btn-primary">Create Role</button>
    <button type="reset" class="btn btn-danger">Reset</button>
</div>



