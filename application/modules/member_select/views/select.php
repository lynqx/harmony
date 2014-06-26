
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="<?php echo base_url() ?>css/token-input.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>css/token-input-facebook.css" type="text/css" />

    <script type="text/javascript">
    $(document).ready(function() {
        $("input[type=button]").click(function () {
            alert("Would submit: " + $(this).siblings("input[type=text]").val());
        });
    });
    </script>


        <input type="text" id="demo-input-local-custom-formatters" name="<?php echo $input_field_name; ?>" />
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-local-custom-formatters").tokenInput(
                '<?php echo base_url() ?>member_select/form_search'
            , {
              propertyToSearch: "name",
              method:"POST",
              tokenValue: "member_id",
              preventDuplicates: true,
              noResultsText: "No member found",
              tokenLimit: <?php echo $select_limit; ?>,
              hintText: "Type in member's name",
              resultsFormatter: function(item){ return "<li>" + "<img src='" + item.picture + "' title='" + item.firstname + " " + item.lastname + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.name + "</div><div class='email'>" + item.member_id + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.name + "</p></li>" },
              
          });
        });
        </script>
