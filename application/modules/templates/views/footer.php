	
</div>
	<!-- /content container -->



	<!-- Footer -->
	<div id="footer">
    <!-- copyrights information -->
		<div class="copyrights">
                    <p style="font-size:12px; font-family:Georgia, 'Times New Roman', Times, serif"> Credit : Waressence Nigeria. </p>
                 </div>
         
         
         <div class="copyrights" style="margin:0 0 0 320px; font-size:12px; font-family:Georgia, 'Times New Roman', Times, serif">
         &copy;
		<?php  ## Automatic year changer
		
					ini_set ('date.timezone', 'Europe/London');
			$startYear = 2014;
			$thisYear = date('Y');
			if ($startYear == $thisYear) {
				echo $startYear;
			}
			else
			{
				echo "{$startYear} - {$thisYear}";
			}
					?> ||
                    
                   <?php   
		$showfooter=modules::run('settings/getSetting', "show_footer"); 
		if(isset($showfooter->value) && $showfooter->value == "on") { 
		
		$footername=modules::run('settings/getSetting', "footername");
				echo $footername->value; 
		}
		?>
				   || All rights reserved <br />       
		
         </div>
         
		<ul class="footer-links">
			<li><a href="" title=""><i class="icon-cogs"></i>Contact admin</a></li>
			<li><a href="" title=""><i class="icon-screenshot"></i>Report bug</a></li>
		</ul>
	</div>
	<!-- /footer -->

</body>
</html>

	<!-- JS Scripts added to footer for faster page load -->
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&amp;sensor=false"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/excanvas.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/jquery.flot.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/charts/jquery.sparkline.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.collapsible.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/prettify.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.bootbox.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.timepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.fullcalendar.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/ui/jquery.elfinder.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/plupload.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/plupload.html4.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/plupload.html5.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/uploader/jquery.plupload.queue.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.autosize.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputlimiter.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.inputmask.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.listbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.validation.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.validationEngine-en.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.form.wizard.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/forms/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tables/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/files/bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/files/functions.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/charts/graph.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/charts/chart1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/charts/chart2.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/charts/chart3.js"></script>

