<?php		
		
		$ret=mysqli_query($con,"select * from tbluser where tele_user ='$chatId'");
		$cnt=1;
		while ($row=mysqli_fetch_array($ret)) {
		$teleid = $row['tele_user'];
		$telename = $row['tele_name'];
		$randomid = $row['randomid'];
		$cnt=$cnt+1;
		}
		
		?>