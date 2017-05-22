<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=$title?></title>
		<link rel="stylesheet" href="<?= $siteRoot; ?>dist/css/typeahead.js-bootstrap.css">
		<link rel="stylesheet" href="<?= $siteRoot; ?>dist/css/bootstrap.css">
		<link rel="stylesheet" href="<?=$siteRoot?>jquery/css/smoothness/jquery-ui-1.10.3.custom.css" />
		<script src="<?=$siteRoot?>jquery/js/jquery-1.9.1.js"></script>
		<script src="<?=$siteRoot?>jquery/js/jquery-ui-1.10.3.custom.js"></script>
		<script src="<?=$siteRoot?>dist/js/bootstrap.js"></script>
	</head>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<body>
	<div align="center" class="alert alert-info" width="33%"><b><?=$message ?></b></div>
		<div class="alert alert-warning" style=" text-align:center; position:absolute; left:33%; right: 33%;  width:33%;">
			<div class="form-group">
				<?php echo form_open('home/connexion', array('id' => 'form_login')); ?>
				<label for="identifiant">Login</label>
				<?php echo form_input($login); ?>
				<label for="identifiant">Mot de Passe</label>
				<?php echo form_input($password); ?>
				<input type="submit" name="submit" class="btn btn-warning" value="log in"/>
				 <?php echo form_close(); ?>
			</div>
		</div>
	</body>
</html>