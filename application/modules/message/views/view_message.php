<div class="navbar">
    <div class="navbar-inner"><h6>Read Message</h6></div>
	
	<?php echo validation_errors('<p class="error" style="color:#F00">'); ?>
<h6><?php
    $data = $this->session->flashdata('result');
    if (isset($data)) echo $data;

    ?></h6>
	
    <div class="span10">
        <!--Get the message_model object -->
        <h6>Sent by:</h6>
        <input class="span12 input-block-level" type="text" name="readonly" readonly=""
               value="<?php echo $message[0]->sender_name; ?>">
        <h6>Sent on:</h6>
        <input class="span12 input-block-level" type="text" name="readonly" readonly=""
               value="<?php echo $message[0]->message_date; ?>">


        <label class="control-label"><h6>Message:</h6></label>

        <div class="controls"><textarea rows="10" cols="10" readonly name="content" class="auto span12"
                                        style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 180px;width:600px">
										<?php echo $message[0]->message_content; ?>
										</textarea>
        </div>
		<?php 
		        $user = $this->session->userdata('id');
				$sender_id = $message[0]->sender_id;

				if ($user != $sender_id ) {
				?>
				
        <div class="span10">
                <a href="javascript:void(0)" class="btn btn-success btn-large" id="butt"> Reply Message </a>
                <a href="<?php echo base_url(); ?>message/" class="btn btn-large btn-info">Back to Inbox</a>
				
        </div>
		<?php } ?>
    </div>
</div>
	<?php $id = $message[0]->message_id; ?>
	<div class="navbar" id="reply">
    <div class="navbar-inner">

	<h6>Send Reply</h6>
	</div>
	
	<div class="span10">
		<form method="post" action="<?php echo base_url(); ?>message/reply/<?php echo $id ?>">

	 <input id="prependedInput" type="hidden" name="receiver_id" class="input-xlarge" value="<?php echo $message[0]->sender_id; ?>"/>

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
        <div class="controls">
            <label class="control-label"><h6>Reply</h6></label>

            <div class="input-prepend">
						            		<span class="add-on">
                                            <span style="color:#F00">*</span>
                                            <i class="ico-tag"></i>
                                            </span>
                <textarea rows="10" cols="10" name="content" class="auto span12"
                 style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 180px;width:600px">
				 
				 </textarea>
				</div>
			</div>
		</div>
		<div class="control-group">

        <div class="controls">
            <input type="submit" value="Reply" class="btn btn-success btn-large">
        </div>
        </div>
		</form>
    </div>
    </div>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>

	<script>
		 $(document).ready(function () {
			 //by default this initialises when the pagee is fully loaded
			 //alert('am ready');
                	$('#reply').hide();
                });

		 $(document).on('click','#butt',function(){
			 //this performs the hide and show and you can add transitions using either slide,blind,fast,slow and many more
			 $('#reply').slideToggle("slow");
			 $('#butt').toggleClass("btn-info");
			});

         </script>
