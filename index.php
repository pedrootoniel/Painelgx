<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="GxGaming, Painel de licença, MuOnline, Mu Online, Marketing digital, WebDesign" />
	<meta name="keywords" content="Supremo" />
	<meta name="author" content="Supremo" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content="GxGaming - Global"/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content="GxGaming-Global, Desenvolvedor Full Stack"/>
	<meta property="og:description" content="GxGaming, Painel de licença, MuOnline, Mu Online, Marketing digital, WebDesign"/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" contenclt="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

<title>GxGaming Painel</title>
    <!-- Bootstrap Core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="./css/style.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    
		<link rel="icon" href="favicon.png">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">	
	
    <!-- Morris Charts CSS -->
    <link href="./vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">		
		
<?php

if(isset($_GET['getOut']))
{
	DestroyAll();
	die();
}

$con = @mysql_connect("localhost","mutrixco_license","T#VH)k{t9t&[");
$db = @mysql_select_db("mutrixco_user",$con);
 # pera ai

//Secure
function Secure($str)
{
	if(is_array($str))
		foreach($str AS $id => $value)
			$str[$id] = Secure($value);
	else
		$str = SanityCheck($str);
	return $str;
}
//Sanity
function SanityCheck($str)
{
	if(strpos(str_replace("''",""," $str"),"'") != false)
		return str_replace("'", "''", $str);
	else
		return $str;
}
// Get Filter
if(isset($_GET))
{
	$xweb_AI = array_keys($_GET);
	$count	 = count($xweb_AI);
	for($i=0; $i < $count; $i++)
		$_GET[$xweb_AI[$i]] = Secure($_GET[$xweb_AI[$i]]);
	unset($xweb_AI);
}
// Request Filter
if(isset($_REQUEST))
{
	$xweb_AI = array_keys($_REQUEST);
	$count	 = count($xweb_AI);
	for($i=0; $i < $count; $i++)
		$_REQUEST[$xweb_AI[$i]] = Secure($_REQUEST[$xweb_AI[$i]]);
	unset($xweb_AI);
}
// Post Filter
if(isset($_POST))
{
	$xweb_AI = array_keys($_POST);
	$count = count($xweb_AI);
	for($i=0; $i < $count; $i++)
		$_POST[$xweb_AI[$i]] = Secure($_POST[$xweb_AI[$i]],true);
	unset($xweb_AI);
}
// Cookie Filter
if(isset($_COOKIE))
{
	$xweb_AI = array_keys($_COOKIE);
	$count	 = count($xweb_AI);
	for($i=0; $i < $count; $i++)
		$_COOKIE[$xweb_AI[$i]] = Secure($_COOKIE[$xweb_AI[$i]]);
	unset($xweb_AI);
}
// Session Filter
if(isset($_SESSION))
{
	$xweb_AI = array_keys($_SESSION);
	$count	 = count($xweb_AI);
	for($i=0; $i < $count; $i++)
		$_SESSION[$xweb_AI[$i]] = Secure($_SESSION[$xweb_AI[$i]]);
	unset($xweb_AI);
}

if(isset($_SESSION["logged"]))
{
	if($_SESSION["logged"] != "F")
	{
		DestroyAll();
	}
	
	if($_SESSION["logged"] == "F")
	{
		$authquery = "SELECT * FROM clientes WHERE username = '". $_SESSION['username'] ."' AND password = '". $_SESSION['password'] ."'";
		$authrun   = @mysql_query($authquery,$con);
		if(@mysql_num_rows($authrun) < 1)
		{
			DestroyAll();
		}
		else
		{
			$authdata = @mysql_fetch_array($authrun);
			if($authdata['access'] < 1)
			{
				session_destroy();
				die("<h1>A conta foi bloqueada</h1><h3>Contacto:</h3><h4>e-mail: contato@gxgaming.com.br</h4>");
			}
			$_SESSION['access'] = $authdata['access'];
			GetContent();
		}
	}
}
else
{
	if(isset($_POST['login']) && !empty($_POST['login']))
	{
		$username = strtolower($_POST['login']);
		$password = $_POST['senha'];
		AuthUser($username,$password);
	}
	else
	{
		?>
  <div id="wrapper">		


<section class="box-login">
	<div class="user-icon-wraper">
		<div class="barra-login"><!--- barra login--->
		<div class="user-icon"></div><!--- icone- -->







</div><!--- wraper--->

<form id="login" name="login" method="post" action="index.php">
	<h3>Painel de Controle GxGaming!</h3>
	<div class="alert alert-info bs-alert-old-docs">
						  Nome do mu = CustomerName
						</div>
	<div class="input">
	<input name="login" type="text" id="login" size="15" maxlength="15" placeholder="login..." />
	<div class="icon-input"  style="background-image: url(images/cont.svg);"></div>

	</div><!--- input--->

	<div class="input">
	<input name="senha" type="password" id="senha" size="15" maxlength="15" placeholder="Senha...">
	<div class="icon-input" style="background-image: url(images/lock.svg);"></div>


	</div><!--- INPUT2--->
	<input type="submit" name="button" id="button" value="Entrar">
<center><img src="favicon.png"/></center>

</form>
<!---<img src="images/logo.png" />--->

</section><!--- box login--->
 
   
		<?php
	}
}

function AuthUser($username,$password)
{
	if(!isset($username) || !isset($password))
	{
		echo "redirect, welcome back.";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=/">';
		return;
	}
	
	if(empty($username) || empty($password))
	{
		echo "invalid username or password.";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="2;URL=/">';
		return;
	}
	
	if(isset($_SESSION['logged']))
		session_destroy();
		
	$authquery = "SELECT * FROM clientes WHERE username = '$username' AND password = '$password'";
	$authrun   = @mysql_query($authquery);
	if(@mysql_num_rows($authrun) > 0)
	{
		$authdata = @mysql_fetch_array($authrun);
		
		$_SESSION['logged']		= "F";
		$_SESSION['username']	= $username;
		$_SESSION['password']	= $password;
		$_SESSION['email']		= $authdata['email'];
		$_SESSION['ip']			= $_SERVER['REMOTE_ADDR'];
		
		//$logquery = "INSERT INTO log (action,fromIP,date,login) VALUES ('login','".$_SESSION['ip']."',NOW(),'$username')";
		//$logrun	  = @mysql_query($logquery);
		
		echo 'redirect, Logado Com Sucesso.';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="1;URL=/index.php?index">';
		return;
	}
	else
	{
		echo "Login ou Senha Incorreta.";
		echo '<META HTTP-EQUIV="Refresh" CONTENT="2;URL=/">';
		return;
	}
}

function DestroyAll()
{
	session_destroy();
	echo 'logout succes. <br />';
	echo '<META HTTP-EQUIV="Refresh" CONTENT="2;URL=/">';
	return;
}

function GetContent()
{
	?>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?index">Painel De Cliente</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?getOut"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="?Update"><i class="fa fa-dashboard fa-fw"></i>Updates Downloads</a>
                        </li>
                        
                           <li>
                            <a href="?Video"><i class="fa fa-dashboard fa-fw"></i>Videos Tutoriais Instalações</a>
                        </li>
                                 
                                         <li>
                            <a href="?Video1"><i class="fa fa-dashboard fa-fw"></i>Videos Tutoriais Season 4</a>
                        </li>
                                                                        <li>
                            <a href="?Video2"><i class="fa fa-dashboard fa-fw"></i>Videos Tutoriais Season 2.09 Customs</a>
                        </li>
                        
                                                                        <li>
                            <a href="?Video3"><i class="fa fa-dashboard fa-fw"></i>Videos Tutoriais 2.5 Classic</a>
                        </li>
                        
                        
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Licença Ativação<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?GameServer">GameServer</a>
                                </li>
                                <li>
                                    <a href="#">Cliente</a>
                                   <!-- <a href="?Main">Cliente</a> -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php
						if($_SESSION['username'] == 'supremo')
						{
							?>
                        <li>
                            <a href="#"><i class="fa fa-user-md fa-fw"></i> Administrator<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?Adm&New">Create User</a>
                                </li>
                                <li>
                                    <a href="?Adm&Edit">User Manager</a>
                                </li>
                                <li>
                                    <a href="?Adm&Licenses">Lic Manager</a>
                                </li>								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
							<?php
						}
						?>						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">                  

	<?php
	if(isset($_GET['GameServer']))
	{
		//Alterar IP
		if(isset($_GET['upIP']))
		{
			if(isset($_POST['ip']) && !empty($_POST['ip']) && isset($_POST['lic']) && !empty($_POST['lic']))
			{
				if(@mysql_num_rows(@mysql_query("SELECT * FROM eMUlic WHERE ip = '". $_POST['ip'] ."'")) < 2)
					@mysql_query("UPDATE eMUlic SET ip = '". $_POST['ip'] ."',hash = '',lastChange = NOW() WHERE id = '". $_SESSION['username'] ."'");
				else
					echo "IMPOSSÍVEL ATUALIZAR O IP: [REDUNDÂNCIA]<br />Entre em contato para resolver o problema.";
			}
		$logquery = "INSERT INTO log (ip,date,login) VALUES ('".$_POST['ip']."',NOW(),'". $_SESSION['username'] ."')";
		$logrun	  = @mysql_query($logquery);			
		}
		
		//Resetar HASH
		
		if(isset($_GET['cancel']))
			if(!empty($_GET['cancel']))
				@mysql_query("UPDATE eMUlic SET hash = '', lastChange = NOW() WHERE id = '". $_SESSION['username'] ."'");
		
		$serverquery = @mysql_query("SELECT * FROM eMUlic WHERE id = '". $_SESSION['username'] ."'");
		while($data = @mysql_fetch_array($serverquery))
		{
			$licenseId = sprintf("%03d",$data['id']);
			$ip = $data['ip'];
			$serial = $data['hash'];
			if(strlen($serial) < 44)
			$serial = "Serial inactive";
			$alterada = date("d/m/Y H:i:s",strtotime($data['lastChange']));
			
			if(empty($data['lastAuth']))
				$lastAuth = "-";
			else
				$lastAuth = date("d/m/Y H:i:s",strtotime($data['lastAuth']));
			
			?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
										<th>Version</th>
                                        <th>IP Server</th>
										<th>Key</th>
                                        <th>Last Auth</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td><?php echo $licenseId; ?></td>
										<td><?php echo $data['version']; ?></td>
										
										<td>
											<form name="upIP" method="post" action="?GameServer=&upIP">
											<input type="hidden" name="lic" value="<?php echo $data['id']; ?>">
											<input type="text" name="ip" id="ip" size="15" maxlength="32" value="<?php echo $ip; ?>" />
											<input type="submit" class="btn btn-success" name="upIP" id="upIP" value="Update" />
											</form>
										</td>

										<td><?php echo $serial; ?></td>
										<td><?php echo $lastAuth; ?></td>
                                    </tr>									
                                </tbody>
                                
                            </table>
                        </div>
			<hr />
          <?php
		}
	}
		
		if(isset($_GET['Video']))
	{		
			?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       
                                        
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <div class="dih">
    <h1><center>Tutoriais de Instalações e etc</h1></center>
</div>
                                      <center><p class="dih1">Videos tutoriais</p>
     <p class="dih2">Instalando SQL 2008 R2 : Sua senha do sql é você quem escolhe, não é necessario usar a do video</p>
<video width="560" height="315" controls>
  <source src="videos/sql.mp4" type="video/mp4">

</video>
<br/><br/>
<p class="dih2">Backup automatico database</p>
<video width="560" height="315" controls>
  <source src="videos/backup.mp4" type="video/mp4">
</video>
<br/><br/>
<p class="dih2">Alterar porta rdp, conexão remota</p>
<video width="560" height="315" controls>
  <source src="videos/portardp.mp4" type="video/mp4">
</video>
<br/><br/>

                                    </tr>
                                   
                                 
                            </table>
                        </div>
                        
                        
                    
            <?php
		}
	
		if(isset($_GET['Video1']))
	{		
			?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       
                                        
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <div class="dih">
    <h1><center>GxGaming Season 4.8</h1></center>
</div>
                                      <center><p class="dih1">Videos tutoriais</p>
     <p class="dih2">Servidor 4.8</p>
<video width="560" height="315" controls>
  <source src="video.mp4" type="video/mp4">

</video>
<br/><br/>
<p class="dih2">Ligando o Servidor</p>
<video width="560" height="315" controls>
  <source src="ligar.mp4" type="video/mp4">
</video>
<br/><br/>
<p class="dih2">Configurando Invasões</p>
<video width="560" height="315" controls>
  <source src="invasao.mp4" type="video/mp4">
</video>
<br/><br/>

                                    </tr>
                                   
                                 
                            </table>
                        </div>
                        
                         <?php
		}
	
		if(isset($_GET['Video2']))
	{		
			?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       
                                        
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <div class="dih">
    <h1><center>GxGaming Season 2.9</h1></center>
</div>
                                      <center><p class="dih1">Videos tutoriais</p>
     <p class="dih2">Servidor 2.9</p>
<video width="560" height="315" controls>
  <source src="video.mp4" type="video/mp4">

</video>
<br/><br/>
<p class="dih2">Ligando o Servidor</p>
<video width="560" height="315" controls>
  <source src="ligar.mp4" type="video/mp4">
</video>
<br/><br/>
<p class="dih2">Configurando Invasões</p>
<video width="560" height="315" controls>
  <source src="invasao.mp4" type="video/mp4">
</video>
<br/><br/>

                                    </tr>
                                   
                                 
                            </table>
                        </div>
                        
                         <?php
		}
	
		if(isset($_GET['Video3']))
	{		
			?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                       
                                        
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <div class="dih">
    <h1><center>GxGaming Season 2.5 classic</h1></center>
</div>
                                      <center><p class="dih1">Videos tutoriais</p>
     <p class="dih2">Servidor 2.5 classic</p>
<video width="560" height="315" controls>
  <source src="video.mp4" type="video/mp4">

</video>
<br/><br/>
<p class="dih2">Ligando o Servidor</p>
<video width="560" height="315" controls>
  <source src="ligar.mp4" type="video/mp4">
</video>
<br/><br/>
<p class="dih2">Configurando Invasões</p>
<video width="560" height="315" controls>
  <source src="invasao.mp4" type="video/mp4">
</video>
<br/><br/>

                                    </tr>
                                   
                                 
                            </table>
                        </div>
                        
                    
            <?php
		}
	
	if(isset($_GET['Update']))
	{		
			?>
			
			                    
                        
                         <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        
                                        <td class="dih3"><center> GxGaming - Season 4</center>
                                        </td>
                                        </div>
                                        
                              <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                                        
                                <thead>
                                    <tr>
                                        <th>Downloads</th>
                                        <th>Changelogs</th>
                                        <th>Update DATA</th>
                                        <th>Baixar</th>
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <td>Servidor Completo</td>
                                        <td><a target="_blank" href="changelog.txt">Changelog...</a></td>
                                        <td>27/02/2022</td>
                                        <td class="center"><a target="_blank" href="/update/">Baixar</a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>Cliente Arquivos</td>
                                        <td><a target="_blank" href="changelog.txt">Changelog...</a></td>
                                        <td>25/02/2022</td>
                                        <td class="center"><a target="_blank" href="#">Baixar</a></td>
                                       
                                    </tr>                                         
                                                      
                            </table>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        
                                        <td class="dih3"><center> GxGaming - Season 2.9 Customs</center>
                                        </td>
                                        </div>
                                        
                              <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                                        
                                <thead>
                                    <tr>
                                        <th>Downloads</th>
                                        <th>Changelogs</th>
                                        <th>Update DATA</th>
                                        <th>Baixar</th>
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <td>Servidor Completo</td>
                                        <td><a target="_blank" href="https://gxgaming.com.br/s2.html">Changelog...</a></td>
                                        <td>03/03/2022</td>
                                        <td class="center"><a target="_blank" href="/update/MuServer2.9.rar">Baixar</a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>Cliente Arquivos</td>
                                        <td><a target="_blank" href="https://gxgaming.com.br/s2.html">Changelog...</a></td>
                                        <td>03/03/2022</td>
                                        <td class="center"><a target="_blank" href="https://mega.nz/file/OYRBCSKY#bcmVAGd9t3h3yyZYkhCV4A3JzUBVx7VNfuhFNjhWI_k">Baixar</a></td>
                                       
                                    </tr>                                         
                                                      
                            </table>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        
                                        <td class="dih3"><center>GxGaming - Season 2.5 Classic</center>
                                        </td>
                                        </div>
                                        
                              <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                                        
                                <thead>
                                    <tr>
                                        <th>Downloads</th>
                                        <th>Changelogs</th>
                                        <th>Update DATA</th>
                                        <th>Baixar</th>
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <td>Servidor Completo</td>
                                        <td><a target="_blank" href="https://gxgaming.com.br/s2.html">Changelog...</a></td>
                                        <td>11/03/2022</td>
                                        <td class="center"><a target="_blank" href="/update/MuServer2.5.rar">Baixar</a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>Cliente Arquivos</td>
                                        <td><a target="_blank" href="https://gxgaming.com.br/s2.html">Changelog...</a></td>
                                        <td>11/03/2022</td>
                                        <td class="center"><a target="_blank" href="https://mega.nz/file/nRZi0DIb#g-z3v4SKYpDV6x7pvuIC60PN4ySMSZ1esRf5dcokKqs">Baixar</a></td>
                                       
                                    </tr>                                         
                                                      
                            </table>
                        </div>
                                    <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        
                                        <td class="dih1"><table><center>Atualizações, Update e fixer´s Semanalmente<p>Servidores estáveis Downgrade e Versões originais</p></center></table>  </td>
                                        
                                                  
                            
                      
                        
                        <?php
		}
		
		if(isset($_GET['index']))
	{		
			?>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        
                                        <td class="dih4"><table><center>GxGaming - GLOBAL</center></table>  </td>
                                        
                                                  
                            
                        </div>
                     
                                                <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                               
                                <thead>
                                    <tr>
                                        <th>Youtube</th>
                                        <th>Facebook</th>
                                        <th>Instagram</th>
                                        <th>Discord</th>
                                    </tr>
                                </thead>
                                    <tr class="odd gradeX">
                                        <td><a target="_blank" href="https://www.youtube.com/pedrootoniel">Canal Youtube</td></a>
                                        <td><a target="_blank" href="#">Facebook</a></td>
                                        <td>Em Breve</td>
                                        <td class="center"><a target="_blank" href="https://discord.gxgaming.com.br/">Discord</a></td>
                                  
                                    </tr>                                      
                            </table>
                        </div>
                        <center><img src="favicon.png"/></center>

            <?php
	}			
	
	
	if(isset($_GET['Main']))
	{
		$ipValue = "192.168.1.1";
		$serialValue = "TbYehR2hFUPBKgZj";
		$windowValue = "MU GxGaming";
		$ssValue = "ScreenShots\Screen(%02d_%02d-%02d-%02d)-%04d.jpg";
		$instanceValue = "1";
		$portValue = "44405";
		$rfValue = 1;
		$mainCRCValue = "1.04.05";
		
		$query = @mysql_query("SELECT * FROM mains6 WHERE client = '". $_SESSION['username'] ."'");
		if(@mysql_num_rows($query) > 1)
		{
			$data = @mysql_fetch_array($query);
			$ipValue = $data['ip'];
			$windowValue = $data['title'];
			$ssValue = $data['screens'];
			$portValue = $data['port'];
			$rfValue = $data['rf'];
			$serialValue = $data['serial'];
			$mainCRCValue = $data['mainCRC'];
		}
		?>
		</br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
							Generate license info
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <form name="generator" method="post" action="main.php" target="_blank">									
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">IP:</span>
											<td><input type="text" class="form-control" name="ip" id="ip" size="15" maxlength="32" value="<?php echo $ipValue; ?>" /></td>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Port:</span>
                                            <td><input type="text" class="form-control" name="port" id="port" size="5" maxlength="5" value="<?php echo $portValue; ?>" /></td>
                                        </div>										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Serial:</span>
											<td><input type="text" class="form-control" name="serial" id="serial" size="16" maxlength="16" value="<?php echo $serialValue; ?>" /></td>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Version:</span>
                                            <td><input type="text" class="form-control" name="mainCRC" id="mainCRC" size="7" maxlength="7" value="<?php echo $mainCRCValue; ?>" /></td>
                                        </div>										
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Window Name:</span>
                                            <td><input type="text" class="form-control" name="window" id="window" size="32" maxlength="32" value="<?php echo $windowValue; ?>" /></td>
                                        </div>	
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Screnshots Folder:</span>
                                            <td><input type="text" class="form-control" name="ss" id="ss" size="48" maxlength="128" value="<?php echo $ssValue; ?>" /></td>
                                        </div>	
                                            <label>Interface</label>
                                            <select name="rfbt" id="rfbt" class="form-control">
                                                   <option value="4" <?php echo ($rfValue == 0) ? "selected=\"selected\"" : ""; ?>>Season 4</option>
                                                                         <option value="4" <?php echo ($rfValue == 0) ? "selected=\"selected\"" : ""; ?>>Season 2.9</option>         
                                                                                               <option value="4" <?php echo ($rfValue == 0) ? "selected=\"selected\"" : ""; ?>>Season 2.0</option>
                                                                                               
                                            </select>
											</br>											
										<tr>
											<td colspan="2" align="center"><input type="submit" class="btn btn-primary btn-lg btn-block" name="generate" id="generate" value="OK" /></td>
										</tr>										
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
		<?php
	}	
	
	if(isset($_GET['Adm']))
	{
		if($_SESSION['username'] != 'supremo')
			die("What!?!?!?");
			
		
		if(isset($_GET['New']))
		{
			//Cadastrar
			if(isset($_POST['cadastrar']) && !empty($_POST['cadastrar']) && isset($_POST['login']) && !empty($_POST['login']))
			{
				if(mysql_query("INSERT INTO clientes (username, password, email, access) VALUES ('".$_POST['login']."','".$_POST['senha']."','".$_POST['email']."','".$_POST['access']."')"))
				{
					?>
                    <p style="background-color:#060; color:#FFF">GxGaming<?php echo $_POST['login']; ?> Você não é bem vindo
                    <?php
				}
			}
			?>
			</br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           GxGaming
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">			
            <form action="?Adm&New" name="Cadastrar" method="post">
                <table width="450">
                    <div class="form-group input-group">
                    <span class="input-group-addon">Login:</span>
					<input class="form-control" name="login" type="user" id="login" size="10" maxlength="10" />
                    </div>
                    <div class="form-group input-group">
                    <span class="input-group-addon">Senha:</span>
					<input class="form-control" name="senha" type="text" id="senha" size="10" maxlength="10" />
                    </div>					
                    <div class="form-group input-group">
                    <span class="input-group-addon">E-Mail:</span>
					<input class="form-control" name="email" type="text" id="email" size="80" maxlength="80" />
                    </div>
					
                    <label>Descentralizacao</label>
                     <select name="access" class="form-control">
                          <option value="1">Membro</option>
                          <option value="0">Bloquear</option>
                     </select>	
					 </br>
                    <tr><td align="center" colspan="2"><input class="btn btn-success" name="cadastrar" type="submit" value="OK" /></td></tr>
                </table>
			</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>			
            <?php
		}
		
		if(isset($_GET['Edit']))
		{
			//Deletar
			if(isset($_POST['delete']) && !empty($_POST['delete']) && isset($_POST['login']) && !empty($_POST['login']))
			{
				if(mysql_query("DELETE FROM clientes WHERE username = '".$_POST['login']."'"))
				{
					$deleteS6  = mysql_query("DELETE FROM eMUlic WHERE cliente = '".$_POST['login']."'");
					?>
                    <p style="background-color:#060; color:#FFF">Conta <?php echo $_POST['login']; ?> excluir.</p>
                    <?php
				}
			}
			
			//Atualizar
			if(isset($_POST['update']) && !empty($_POST['update']) && isset($_POST['login']) && !empty($_POST['login']))
			{
				if(mysql_query("UPDATE clientes SET username = '".$_POST['login']."', password = '".$_POST['senha']."', email = '".$_POST['email']."', access = '".$_POST['access']."' WHERE username = '".$_POST['login']."'"))
				{
					?>
                    <p style="background-color:#060; color:#FFF">Conta <?php echo $_POST['login']; ?> foi atualizado.</p>
                    <?php
				}
			}
			?>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                       <tr>
                        <th>Conta</th>
                        <th>Senha</th>
                        <th>E-Mail</th>
                        <th>Block</th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>					
                    <?php
					$query = mysql_query("SELECT * FROM clientes ORDER BY username");
					while($data = mysql_fetch_array($query))
					{
						?>
						<tbody>
						<tr class="odd gradeX">
                        	<form action="?Adm&Edit" name="Editar" method="post">
                            <td style="border-bottom:thin dashed #000000"><input name="login" type="number" id="login" size="10" maxlength="15" value="<?php echo $data['login']; ?>" /></td>
                            <td style="border-bottom:thin dashed #000000"><input name="senha" type="text" id="senha" size="10" maxlength="15" value="<?php echo $data['senha']; ?>" /></td>
                            <td style="border-bottom:thin dashed #000000"><input name="email" type="text" id="email" size="30" maxlength="100" value="<?php echo $data['email']; ?>" /></td>
                            <td style="border-bottom:thin dashed #000000"><input name="access" type="text" id="access" size="1" maxlength="1" value="<?php echo $data['access']; ?>" /></td>
                            <td style="border-bottom:thin dashed #000000"><input class="btn btn-primary" name="update" type="submit" value="SAVE" /></td>
                            <td style="border-bottom:thin dashed #000000"><input class="btn btn-danger" name="delete" type="submit" value="DEL" onclick="javascript: if(!confirm('Confirma ai, carai')) return false;" /></td>
                            </form>
						</tr>
						</tbody>
						<?php
					}
                    ?>
                </table>
			</div>
			<?php
		}
		
		if(isset($_GET['Licenses']))
		{
			$user = 0;
			
			if(isset($_GET['client']))
				$user = $_GET['client'];
			
			
			if(isset($_GET['NewS6']))
			{
				if(mysql_query("INSERT INTO eMUlic (id, version) VALUES ('".$_GET['client']."','6')"))
				{
					?>
                    <p style="background-color:#060; color:#FFF">Inicializar Licene Server para conta <?php echo $_GET['client']; ?> sucesso </p>
                    <?php
				}
			}
			
			
			if(isset($_GET['DeleteS6']))
			{
				if(mysql_query("DELETE FROM eMUlic WHERE id = '".$_GET['id']."'"))
				{
					?>
                    <p style="background-color:#060; color:#FFF">Servidor De Licença #<?php echo $_GET['id']; ?> excluir.</p>
                    <?php
				}
			}
			
			
			if(isset($_GET['UpdateS6']))
			{
				if(isset($_GET['id']))
				{
					if(mysql_query("UPDATE eMUlic SET version = '". $_POST['version'] ."' WHERE id = '". $_GET['id'] ."'"))
					{
						?>
						<p style="background-color:#060; color:#FFF">License Server #<?php echo $_GET['id']; ?> đã được cập nhập.</p>
						<?php
					}
				}
			}
			
			
			if(isset($_POST['Filtrar']) && !empty($_POST['Filtrar']) && isset($_POST['clientList']) && !empty($_POST['clientList']))
				$user = $_POST['clientList'];
				
			$query = mysql_query("SELECT clientes FROM username");
			?>
            <center>
			</br><form name="SelectUser" method="post" action="?Adm&Licenses">
                <p>Chọn tài khoản: <select name="clientList">
                <?php
                while($data = mysql_fetch_array($query))
                {
                    echo "<option value=\"".$data['login']."\" ";
					if($user == $data['login']) echo "selected=\"selected\"";
					echo ">".$data['login']."</option>";
                }
                ?>
                </select> <input type="submit" name="Filtrar" value="OK" />
            </form>
            </p>
			</center>
            <?php
			
			if($user > 0)
			{
				?>
                <hr />
		        <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            [v6] eMUlator S6E3
                        </div>
                        <div class="panel-body">
                            <th><a href="?Adm&Licenses&NewS6&client=<?php echo $user; ?>">Tạo</a></th>
                        </div>
                    </div>
					</div>
								
                <?php
				
				$serverquery = @mysql_query("SELECT id,version,ip,lastChange FROM eMUlic WHERE id = '$user'");
				while($data = @mysql_fetch_array($serverquery))
				{
					$licenseId = sprintf("%03d",$data['id']);					
					?>
					
                    <form action="?Adm&amp;Licenses&amp;client=<?php echo $user; ?>&amp;UpdateS6&amp;id=<?php echo $data['id']; ?>" method="post" name="UpdateS6">
		  			<table border="1" align="center" cellpadding="3" cellspacing="0">
						<tr>
							<th align="right" nowrap="nowrap">IP:</th>
							<td nowrap="nowrap"><?php echo $data['ip']; ?></td>
                            <th align="right" nowrap="nowrap">Last Edit:</th>
                            <td  nowrap="nowrap"><?php echo $data['lastChange']; ?></td>
						</tr>
                        <tr>
							<th align="right" nowrap="nowrap">Customer:</th>
							<td nowrap="nowrap"><?php echo $licenseId; ?></td>
                            <th align="right" nowrap="nowrap">Version:</th>
						    <td nowrap="nowrap"><input type="text" size="10" maxlength="50" value="<?php echo $data['version']; ?>" name="version" /></td>
						</tr>
						<tr>
							<td colspan="2" align="center" nowrap="nowrap">[<a href="?Adm&amp;Licenses&amp;client=<?php echo $user; ?>&amp;DeleteS6&amp;id=<?php echo $data['id']; ?>">Remove</a>]</td>
                          <td colspan="2" align="center" nowrap="nowrap"><input type="submit" value="Cập nhập" name="alterar" /></td>
						</tr>
					</table>
                    </form>
                   <br />
					</div>
					<?php
				}
			}
		}
	}
}
?>
</div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morrisjs/morris.min.js"></script>
    <script src="./data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>
		  
</body>
</html>