<!DOCTYPE html>
<html lang="en">
  <head>
  
<!--   
   _____          _ _     _            _           
  / ____|        | (_)   | |          | |          
 | |     __ _  __| |_  __| |_   _  ___| |__   ___  
 | |    / _` |/ _` | |/ _` | | | |/ __| '_ \ / _ \ 
 | |___| (_| | (_| | | (_| | |_| | (__| | | | (_) |
  \_____\__,_|\__,_|_|\__,_|\__,_|\___|_| |_|\___/ 
--> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Generador de Contrase&ntilde;as | Cadiducho.com </title>

    <!-- Bootstrap core CSS -->
    <link href="http://www.cadiducho.com/datos/css/bootstrap.min.css" rel="stylesheet">
    <!-- Css de la essta pagina -->
    <link href="pass.css" rel="stylesheet">
	<!-- Css de la nueva web -->
	<link href="http://www.cadiducho.com/datos/css/nuevo.css" rel="stylesheet">

  </head>

  <body>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Cadiducho.com</h3>
              <ul class="nav masthead-nav">
                <li class="active"><a href="#">Pass</a></li>
                <li><a href="http://Cadiducho.com">Inicio</a></li>
                <li><a href="http://blog.cadiducho.com">Blog</a></li>
              </ul>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading morado">Caracteristicas de tu contrase&ntilde;a:</h1>
<? /* Código del programa */ 

$limit = 100; //Si no me tirais la web locos

function generate_pass() {	
	global $limit;
	
	$pass = '';
	$length = '';
	$nums = array();
	$caps = array();
	$lowers = array();
	$symbols = array();

	if ($_REQUEST['usenums'])
		$nums = range('0', '9');

	if ($_REQUEST['usecaps'])
		$caps = range('A', 'Z');

	if ($_REQUEST['uselower'])
		$lowers = range('a', 'z');

	if ($_REQUEST['usesymbols'])
		$symbols =  array_merge(range("{", "~"), range(":", "@"));

	$chars = array();

	if (!empty($nums) )
	{
		foreach ($nums as $value)
			$chars[] = $value;
	 }

	if (!empty($caps) )
	 {
		foreach ($caps as $value)
			$chars[] = $value;
	 }

	if (!empty($lowers) )
	 {
		foreach ($lowers as $value)
			$chars[] = $value;
	 }

	if (!empty($symbols) )
	 {
		foreach ($symbols as $value)
			$chars[] = $value;
	 }

	if (empty($chars))
		$chars = array_merge(array_merge(range('a', 'z'), range('A', 'Z')), range('0', '9'));

	$count = count($chars);

	if( is_numeric($_REQUEST['value']) && (abs($_REQUEST['value']) < $limit) && (!empty($_REQUEST['value'])) )
		$length = abs((int) $_REQUEST['value']);
	elseif (empty($_REQUEST['value']) && ($_REQUEST['value'] != '0') && !isset($_REQUEST['value']))
		$length = 'keepalive';
	else
		show_error();

	mt_srand((double)microtime() * 1000000);

	if ($length != 'keepalive')
	 {
		for($i = 0; $i < $length; $i++)
			$pass .= $chars[mt_rand(0, $count - 1)];
	 }
	if (!empty($pass))
		echo "<span class='glyphicon glyphicon-ok verde'></span> Tu contrase&ntilde;a generada es:<br /><tt><strong>$pass</strong></tt>";
 }


function show_error()
 {
	global $limit;	

	if ($limit <= abs($_REQUEST['value']))
		$error = "Contrase&ntilde;a mayor o igual que $limit caracteres.";
	elseif( !is_numeric($_REQUEST['value']) && (!in_array($_REQUEST['value'], array('', '0', 'keepalive'))) )
		$error = "No has incluido un valor numerico para el numero de caracteres.";
	elseif ($_REQUEST['value'] == '0')
		$error = "El numero de caracteres es 0.";
	elseif (empty($_REQUEST['value']))
		$error = "El numero de caracteres esta vacio.";
	else
		$error = "Ocurrio un error procesando la informacion.";
	/* Escribe el error */
	echo "<span class='glyphicon glyphicon-remove rojo'></span> Se han producido ciertos errores: <br /><tt><strong>$error</strong></tt>";
	return;
 }



	if (!isset($_REQUEST['usenums']) && !isset($_REQUEST['usecaps']) && !isset($_REQUEST['uselower']) && !isset($_REQUEST['usesymbols']))
	 {
		$_REQUEST['usenums'] = true;
		$_REQUEST['usecaps'] = true;
		$_REQUEST['uselower'] = true;
		$_REQUEST['usesymbols'] = false;
	 }

	if (!isset($_REQUEST['value']))
		$keepalive = true;

echo '
			<span style="font-size: 80%">Rellena el formulario y pulsa en generar contrase&ntilde;a!</span><br /><br />
			<form action="' . $_SERVER['SCRIPT_NAME'] . '" method="post">
				<label><input type="checkbox" name="usenums" ' , ($_REQUEST['usenums'] && !$keepalive) ? 'checked="checked"' : '' , ' /> Incluir numeros?</label>
				<br />
				<label><input type="checkbox" name="usecaps" ' , ($_REQUEST['usecaps'] && !$keepalive) ? 'checked="checked"' : '' , ' /> Incluir mayusculas?</label>
				<br />
				<label><input type="checkbox" name="uselower" ' , ($_REQUEST['uselower'] && !$keepalive) ? 'checked="checked"' : '' , ' /> Incluir minisculas?</label>
				<br />
				<label><input type="checkbox" name="usesymbols" ' , ($_REQUEST['usesymbols'] && !$keepalive) ? 'checked="checked"' : '' , ' /> Incluir simbolos o caracteres especiales?</label>
				<br />
				<label>Numero de caracteres:&nbsp;&nbsp;<input type="text" name="value" value="' . (!empty($_REQUEST['value']) ? $_REQUEST['value'] : '') . '" maxlength="3" size="5" /></label><br />
				<br />
				<input value="Generar" class="btn btn-lg btn-info " type="submit" />
			</form><br />';

		generate_pass();


?>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>&copy; 2014 CadiduchoDev, Desarrollado por <a href="http://twitter.com/Cadiducho"> @Cadiducho</a></p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://www.cadiducho.com/datos/js/bootstrap.min.js"></script>
    <script src="http://www.cadiducho.com/datos/js/docs.min.js"></script>
  </body>
</html>