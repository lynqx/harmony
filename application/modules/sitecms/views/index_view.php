                <?php echo validation_errors('<p class="error" style="color:#F00">'); ?>

<div class="row-fluid">

    <div class="span8">
        <div class="widget">
            <div class="navbar">
                <div class="navbar-inner"><h6>Create a new page</h6></div>
            </div>
            <div class="well body">
                <form name="post_create" id="post_create" 
                action="<?php echo base_url() ?>sitecms/submit" method="post" onSubmit = "return validateForm()" >
                    <div class="control-group">
                        <label class="control-label"><h6>Title</h6></label>
                        <p style="font-size:11px;"><i> (The title you want to appear on the page)</i> </p>

                        <div class="controls"><input type="text" name="post_title" id="post_title" class="span12" value="<?php echo $title; ?>"></div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"><h6>Alias</h6></label>
                        <p style="font-size:11px;"><i> (Alias is the name you want shown on the sidebar navigation. Not more than 30 characters)</i> </p>

                        <div class="controls"><input type="text" name="alias" id="alias" class="span12" value="<?php echo $alias; ?>"></div>
                    </div>
                    
                    
                    <div class="control-group">
                        <label class="control-label"><h6>Content</h6></label>

                        <div class="controls">
                        <p style="font-size:11px;"><i> (Type Content here and please format appropriately with the editor)</i> </p>
                            <textarea name="content_2" id="content_2" class="input-block-level">
                            <?php if (isset($content)) { echo $content; 
							} else { $content = ""; }?>
                            </textarea>
                            <?php echo display_ckeditor($ckeditor_2); ?>
                            </textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"><h6>Grant Access</h6></label>
                        <p style="font-size:11px;"><i> </i> </p>
                        <div class="controls">
                        <select name="access">
                        <option value="0" <?php if(isset($accessed) && $accessed == 0) echo 'selected="selected"';?> > All Users </option>
                        <option value="1" <?php if(isset($accessed) && $accessed == 1) echo 'selected="selected"';?>> Only Registered members </option>
                        <option value="2" <?php if(isset($accessed) && $accessed == 2) echo 'selected="selected"';?>> Only Administrators </option>
                        </select>
                        </div>
                    </div>
                    
                    
                    <div class="control-group">
                    <div class="controls">
					<label class="checkbox">
                    <input type="checkbox" class="styled" name="publish_page" value="1" 
                        <?php if(isset($published) && $published == 1) echo 'checked="checked"';?> /> Publish Page?</label>
											
	<?php if (isset($update_id)) { 
	echo '<input type = "hidden" name="update_id" 
	value="' . $update_id . '" />';
    }
	?>
	                </div>
                    </div>
                                    
                    <div class="control-group">

                        <div class="controls">
                        
                        	<?php 
							//change the button value to update if we re not creating a new page
							if (isset($update_id)) { 
                            echo '<button class="btn btn-success btn-large" type="submit">Update</button>';
							} else {
							echo '<button class="btn btn-success btn-large" type="submit">Create</button>';
								}
								?>
                                
                            <button class="btn btn-danger btn-large" type="reset">Cancel</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>



<script type="text/javascript">

function validateForm()
	{
  		  var f=document.forms["post_create"]["post_title"].value;
		if (f==null || f=="" || f=="Title")
		  {
		  alert("Please enter the Title of the Page");
		  return false;
		  }
		  
		  
		  var l=document.forms["post_create"]["content_2"].value;
		if (l==null || l=="")
		  {
		  alert("Please enter the content of the page");
		  return false;
		  }
	}
</script>	