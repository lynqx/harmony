</div>
	<!-- /content container -->


	<!-- Footer -->
	<div id="footer">
    <!-- copyrights information -->
		<div class="copyrights">&copy; 
		
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
					?> || Waressence Software Company. <br />
        
		
         </div>
		<ul class="footer-links">
			<li><a href="" title=""><i class="icon-cogs"></i>Contact admin</a></li>
			<li><a href="" title=""><i class="icon-screenshot"></i>Report bug</a></li>
		</ul>
	</div>
	<!-- /footer -->

</body>
</html>
