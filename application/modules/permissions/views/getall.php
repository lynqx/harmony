	<div class="control-group">
	<h3> Available Permissions </h3>
	</div>
	
	<input type="hidden" value="<?php echo $perm_menu; ?>" name="total" />

	
	<div class="control-group">
    <div class="controls">
	
	<?php
	
				$stack = array();
				
				foreach ($reals as $real) 
				{
				$permid = $real->permission_id;
 				array_push($stack, $permid);
				}
								
				
                    foreach ($menus as $menu) {
					$pid = $menu->id;
					echo '<label class="checkbox">'; ?>
					<input type="checkbox" id="inlineCheckbox2" class="styled" name="perm<?php echo $pid; ?>" 
					value="<?php echo $pid; ?>" 
					<?php if (in_array($pid, $stack)) { echo "checked"; } ?> >
					<?php
					echo $menu->title;
					echo '</label>';
                }
				
				echo '<br><br>';
				
				//print_r($stack);


    ?>
	
	</div>
	</div>
				
				
				