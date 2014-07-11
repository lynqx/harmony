			<?php
			$data = $this->session->flashdata('result');
			if (isset($data)) echo '<h6>' . $data . '</h6>';
			?>
			<h3>Add Permissions to Roles</h3>

<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>

<form action="<?php echo base_url(); ?>permissions/addToRole" method="post"
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
        <label>Select a Role</label>

        <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-briefcase"></i>
                                            </span>
            <select name="role" onchange="showInfo('modalcontent', this.value)">

                <?php
                $this->load->model('Role_model', 'role');
                $data = $this->role->getAvailableRoles();
                   echo '<option value=""></option>';
                foreach ($data->result() as $row) {
                    echo '<option value="' . $row->id . '">' . $row->title . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</div>


				<div id="modalcontent">
				  
				</div>

<div class="form-actions align-right">

    <button type="submit" class="btn btn-primary">Add Permission</button>
</div>



<script>

	function showInfo(content_div, request_id)
	{
				
		//verify xmlhttp object
		var xmlhttp;
		if (window.XMLHttpRequest)
		{	// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{	// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		//do xmlhttp request
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById(content_div).innerHTML=xmlhttp.responseText;
			}
		}
		
		//send request
		xmlhttp.open("GET","<?php echo base_url(); ?>permissions/getall/"+request_id,true);
		xmlhttp.send();
	}


</script>

