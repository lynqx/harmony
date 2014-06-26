<div class="navbar">
    <div class="navbar-inner"><h6>Read Message</h6></div>
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
                                        style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 180px;width:600px"><?php echo $message[0]->message_content; ?></textarea>
        </div>
        <div class="span10">
            <form>
                <a href="<?php echo base_url(); ?>message/create" class="btn btn-success btn-large">Reply message</a>
                <a href="<?php echo base_url(); ?>message/" class="btn btn-large btn-info">Back to messages</a>
            </form>
        </div>
    </div>
</div>
