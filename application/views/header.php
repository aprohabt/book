<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?=$title?></title>
		<!--<link rel="icon" href="<?=base_url()?>/favicon.gif" type="image/gif">-->
		<link rel="stylesheet" href="<?=$siteRoot;?>dist/css/typeahead.js-bootstrap.css">
		<link rel="stylesheet" href="<?=$siteRoot;?>dist/css/bootstrap.css">
		<link rel="stylesheet" href="<?=$siteRoot?>jquery/css/smoothness/jquery-ui-1.10.3.custom.css" />
		<script src="<?=$siteRoot?>jquery/js/jquery-1.9.1.js"></script>
		<script src="<?=$siteRoot?>jquery/js/jquery-ui-1.10.3.custom.js"></script>
		<script src="<?=$siteRoot?>dist/js/bootstrap.js"></script>
		<script src="<?=$siteRoot?>dist/js/typeahead.js"></script>
		<script src="<?=$siteRoot?>jquery/js/assoc.js"></script>
		<script>
		$( document ).ready(function() {
			$( "#rechercheForm" ).hide();
			$( ".corrections" ).hide();

			$( "#dialog" ).dialog({
				autoOpen: false,
				draggable:true, 
				position: { my: "center middle" },
				 show: {
					effect: "drop",
					duration: 500
					},
				hide: {
					effect: "drop",
					duration: 500
				}
			});
			$( "#ajout" ).click(function() {
				
				$( "#dialog" ).dialog( "open" );
				
			});		
			
			$( "#recherche" ).click(function() {
				if( $( "#rechercheForm" ).css('display') == 'none'){
					$( "#rechercheForm" ).show( "blind" );
				}else{
					$( "#rechercheForm" ).hide( "blind" );
				}
								
			});
			
			$( "#corrections" ).click(function() { //alert('non');
				if( $( ".corrections" ).css('display') == 'none'){
					$( ".corrections" ).show( "slide" );
				}else{
					$( ".corrections" ).hide( "slide" );
				}
								
			});
			
			$( "#close" ).click(function() {
				close();
				return false;
			});
		});
		
		function close(){
			$( ".notification" ).hide('blind'); 
			$( ".notification" ).css('blind'); 
		}
		</script>
		
	</head>
<body>
	<!--<div role="navigation" class=" navbar navbar-inverse navbar-fixed-top " style="z-index:0;">-->
	<nav class="navbar navbar-inverse  " role="navigation">
      <div class=" container container-fluid">
        <div class="navbar-header ">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle btn-lg" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?=$siteRoot?>" class="navbar-brand">B.O.O.K.</a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?=$homeActive;?>"><a href="<?=$siteRoot?>">Home <span class='glyphicon glyphicon-home'></a></li>
            <li class="<?=$livreActive;?>"><a href="<?=$siteRoot;?>livre">Livres <span class='glyphicon glyphicon-book'></span></a></li>
            <li class="<?=$auteurActive;?>"><a href="<?=$siteRoot;?>auteur">Auteurs <span class='glyphicon glyphicon-user'></span></a></li>
            <li class="<?=$genreActive;?>"><a href="<?=$siteRoot;?>genre">Genres <span class='glyphicon glyphicon-tag'></span></a></li>
            <li class="<?=$formatActive;?>"><a href="<?=$siteRoot;?>format">Formats <span class='glyphicon glyphicon-fullscreen'></span></a></li>
          </ul>
          <div class="navbar-right">
          	<ul class="nav navbar-nav">
            	<li >
            		<?= anchor('home/deconnexion', $this->session->userdata('userLogin')." <span class='glyphicon glyphicon-off'></span> ", 'title="Déconnexion"'); ?>
            		
            		<!--<a href="<?=$siteRoot?>home/deconnexion"><?=$this->session->userdata('userLogin')?> <span class='glyphicon glyphicon-off '></a></li>-->
        	</ul>
          </div>
        </div><!--/.nav-collapse --> 
        
        
      </div>
      </nav>
    <!--</div>-->
