<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="UTF-8">
</head>
<header>
			<TABLE class="tableNav"> 
			
				<TR> 
					<TH><a class="linkNav" href="../web/home.php">Home</a></TH> 
					<TH> 
						<ul id="menu-accordeon">
							<li><a class="linkNav" href="../web/articles.php">Articles</a>
								<ul>
								<?php //TODO:Faire une liste déroulante en fct des catégories
									include('connectDbSQL.php');
									$sql="SELECT `id_Category` FROM `t_category`";
									$reponse = mysql_query($sql);
									while ($donnees = mysql_fetch_array($reponse))
									{
										$data[]=$donnees;
									}
									for ($i=0;$i<count($data);$i++){
										echo('<li><a href="articles_category.php?category='.$data[$i]['id_Category'].'">'.$data[$i]['id_Category'].'</a></li>');
									}
									mysql_close();
								?>
								</ul>	
							</li>
						</ul>
					</TH>
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
							echo("
                            <TH>
                                <ul id=\"menu-accordeon\">
                                    <li><a class=\"linkNav\" href=\"#\">Administration</a>
                                        <ul>
                                            <li><a href=\"administration_users.php\">Utilisateurs</a></li>
                                            <li><a href=\"administration_articles.php\">Articles</a></li>
                                            <li><a href=\"administration_commandes.php\">Commandes</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </TH>
                            ");
						}
					}
				}
				?>
                <?php
                if(isset($_COOKIE['UserName']) && $_COOKIE['UserName']!=""){
                    echo '<TH class="Nav" colspan="2"><a class="linkNav" href="./panier.php">Panier</a></th>';
                }
                ?>
			</TR> 
			</TABLE><br/><br/>
</header>