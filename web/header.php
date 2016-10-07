
<head>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<meta charset="UTF-8">
</head>
<header>
			<TABLE class="tableNav"> 
			
				<TR> 
					<TH><a class="linkNav" href="../web/home.php">Home</a></TH> 
					<TH><a class="linkNav" href="../web/articles.php">Articles</a></TH>
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
					</TH>
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