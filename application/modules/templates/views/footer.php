	
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
				  foreach ($settings as $setting) { 
                  $shortname = $setting->shortname;
				  echo $shortname;
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

