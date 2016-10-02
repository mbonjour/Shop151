
<head>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<meta charset="UTF-8">
</head>
<header>
			<TABLE class="tableNav" BORDER="1" align="center" width=100% bgcolor=#29E7F5 > 
			
				<TR> 
					<TH><a class="linkNav" href="../web/home.php">Home</a></TH> 
					<TH><a class="linkNav" href="../web/articles.php">Articles</a></TH> <!-- PHP ICI POUR GRISE SI PAS AUTH -->
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
				<?php 
				if(isset($_COOKIE['UserName']) && $_COOKIE['UserName']!="")
				{
					if ( isset($_COOKIE['admin']) )
					{	
						if($_COOKIE['admin']==true){
							echo ("<TH><a class=\"linkNav\" href=\"./administration.php\">Administration</a></TH>");
						}
					}
				}
				?>
				</TR> 
			</TABLE><br/><br/>
</header>