
<head>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<meta charset="UTF-8">
</head>
<header>
			<p><a href="http://www.suissemobile.ch" ><img style="margin-bottom:15px;"src="../pictures/logo_smo.gif" align="right"/></a></p></br>
			<TABLE class="tableNav" BORDER="1" align="center" width=100% bgcolor=#29E7F5 > 
			
				<TR> 
					<TH><a class="linkNav" href="../web/home.php">Home</a></TH> 
					<TH><a class="linkNav" href="../web/excursions.php">Excursions</a></TH> <!-- PHP ICI POUR GRISE SI PAS AUTH -->
					<TH><a class="linkNav" href="http://www.sbb.ch" target="blank">Agence CFF</a></TH> 
					<TH class="Nav" colspan="2"><a class="linkNav" href="./login.php">Login</a>		USER : 
					<?php 
							if ( isset($_COOKIE['UserName'] ) )
							{
								echo $_COOKIE['UserName'];
							}
							else {
								echo '---';
							}
					?>
					</TH> <!-- PHP ICI POUR AFFICHER USER AUTH SI IL Y EN A UN -->
				</TR> 
			</TABLE><br/><br/>
</header>