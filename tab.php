<html dir="rtl">
<head>
<meta http-equiv="Content-Language" content="ar-sa">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<div align="center"class="menu2" >
	<table class="menu2" border="0" width="100%" id="table1" cellspacing="0" cellpadding="0" bgcolor="#003366" height="0" dir="ltr" >
		<tr>
		<?php if ( $_SESSION["per"]==1 ){?>

			<td style="padding-left:7px;border-radius:5px;" width="17%"  class="menu2" height="0" align="center" <?php if($_GET["mnu_id"]==1){?>bgcolor=FF8040 <?php } else {?>bgcolor="#003366"<?php }?>>
			
<strong>
			
	<b><a href="index.php?mnu_id=1">
				Settings</font></a></b></font>
			
			</strong>
			
			</td>
			<?php }?>
			<td class="menu2" height="0" width="174" style="padding-left: 7px;border-radius:5px;" align="center" <?php if($_GET["mnu_id"]==2){?>bgcolor=FF8040 <?php } else {?>bgcolor="#003366"<?php }?>>
			
			<strong><font color="#FFFFFF">
			
			<?php if ($_SESSION["per"]==2 || $_SESSION["per"]==1 ){?>

				</font>

				<b>
				<a href="index.php?mnu_id=2">
				Employees Information 
				</font></a></b>
				<?php }?>
			
			</font></strong>
			
			</td>
			<td  height="0" width="106" style="padding-left: 7px;border-radius:5px;" align="center" <?php  if($_GET["mnu_id"]==3){?>bgcolor=FF8040 <?php } else {?>bgcolor="#003366"<?php }?>>
							<b><a href="index.php?mnu_id=3">
							<strong>Reports</strong></a></b><font color="#FFFFFF"><strong>
							</strong></font>
			
			</td>
			<?php if ($_SESSION["per"]==1){?>
			<td   height="0" width="163" style="padding-left: 7px;border-radius:5px;" align="center" <?php if($_GET["mnu_id"]==4){?>bgcolor=FF8040 <?php } else {?>bgcolor="#003366"<?php }?>>
			
			<strong><font color="#FFFFFF">
			
			
				</font>
				<b><a href="index.php?mnu_id=4&page=main_menu.php">
				List Managment 
				</a></b>				<font color="#FFFFFF">				
						</font></strong>
						</td>
						<?php }?>
			<td   height="0" style="padding-left: 7px;border-radius:5px;" align="center" <?php  if($_GET["mnu_id"]==6){?> bgcolor=FF8040 <?php } else {?>bgcolor="#003366"<?php }?>>
		
															<b><a href="index.php?mnu_id=6">
															<strong>Statistical reports</strong></a></b><strong></li>
			
															</strong></font>
			
			</td>
			<td style="padding-left: 7px;border-radius:5px;" align="center" bgcolor="#003366" >
			
				<strong><font color="#FFFFFF">
			
				</span></font><a href="logout.php">Sign Out</span></a><font color="#FFFFFF"></b>
						</font></strong>
						</td>
		</tr>
		<!--tr>
			<td style="padding-right: 5px" valign="top" colspan="6" bordercolor="#102041" >
			<hr size=1 color=#CC6600>
			</td>
		</tr-->
	</table>
</div>

</body>

</html>