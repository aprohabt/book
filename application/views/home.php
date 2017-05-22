<style type="text/css" >
.correction{
	font-color:red;
	text-align: right !important;
	margin-left:auto;
}
</style>

<div>
<h1><?=$message ?></h1>
</div> 
<hr/>
<div align="center">
<div>
	<h3><?= anchor('auteur', "<span class='glyphicon glyphicon-user'></span>", 'title="Consulter les Auteurs"'); ?> Auteurs</h3>
	<div>
	<dd><b><?=$auteurCount?></b> auteurs sont répertoriés dans B.O.O.K.
	</div>
</div>

<hr/>
<div>
	<h3> <?= anchor('livre', "<span class='glyphicon glyphicon-book'></span>", 'title="Consulter les Livres"'); ?> Livres</h3>
	<div>
	<dd><b><?=$livreCount?></b> livres sont répertoriés dans B.O.O.K.
	</div>
</div>


<hr/>
<div>
	<h3><?= anchor('genre', "<span class='glyphicon glyphicon-tag'></span>", 'title="Consulter les Genres"'); ?> Genres</h3>
	<div>
	<dd><b><?=$genreCount?></b> genres sont répertoriés dans B.O.O.K.
	</div>
</div>


<hr/>
<div>
	<h3><?= anchor('format', "<span class='glyphicon glyphicon-fullscreen'></span>", 'title="Consulter les Formats"'); ?> Formats</h3>
	<div>
	<dd><b><?=$formatCount?></b> formats sont répertoriés dans B.O.O.K.
	</div>
</div>
<hr/>
<div id="corrections">
	Historique des modifications apportées à votre <b>BOOK</b> !
	<div class="corrections">
		<ul>
			<li><strong>correction</strong> : ajout du lien de livre lors de l'ajout du livre</li>
			<li><strong>évolution</strong> : les notifications on changé de format !</li>
			<li><strong>évolution</strong> : il est maintenant possible d'ajouter des liens aux livres !</li>
			<li><strong>correction</strong> : un débug s'affichait lors de la modification d'un livre (pas très joli ca ...) , ce n'est plus le cas ! </li>
			<li><strong>correction</strong> : vous n'avez accès qu'a VOS auteurs lors de la modification des livres !"</li>
		</ul>
	</div>
</div>


</div>
