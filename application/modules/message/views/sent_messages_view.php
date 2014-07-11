<?php
/**
 * Created by PhpStorm.
 * User: "Samuel Okoroafor"
 * Date: 1/27/14
 * Time: 6:55 AM
 */
?>
<div class="navbar">
    <div class="navbar-inner"><h6>Messages</h6></div>
</div>
<h6><?php
    $data = $this->session->flashdata('delete');
    if (isset($data)) echo $data;

    ?></h6>
<div class="table-overflow">
    <table class="table table-striped table-bordered" id="data-table">
        <thead>
        <tr>
            <th>
                <center><input type="checkbox" name="checkrow" class="styled"/></center>
            </th>
            <th>Recipient</th>
            <th>Title</th>
            <th>Date</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <!--Logic for rendering Messages -->
        <?php
        $user = $this->session->userdata('id');
        $messages = modules::run('message/fetchMessages', $user, 'sent');
        //print_r($messages);
        $count = 1;
        foreach ($messages as $row) {
            echo '<tr>';
            echo '<td><center><input style="width: 20px;" name="checkbox[]" type="checkbox" value="' . $row->message_id . '" class="styled"/></center></td>';
            echo '<td>' . $row->message_receiver . '</td>';
            echo '<td><a href="' . base_url() . 'message/view/' . $row->message_id . '">' . $row->message_title . '</a></td>';
            echo '<td>' . $row->message_date . '</td>';
            echo '<td><a class="btn btn-success btn-mini" href="' . base_url() . 'message/view/' . $row->message_id . '"><i class="ico-edit"></i> View</a></td>
			<td> <a class="btn btn-mini btn-danger" href="' . base_url() . 'message/delete/' . $row->message_id . '"><i class="icon-remove"> Delete</a></td>';
            echo '</tr>';
            $count++;
        }
        ?>
        </tbody>
    </table>
