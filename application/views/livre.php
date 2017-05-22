<div>
<h1><?=$message ?> <span class='glyphicon glyphicon-book'></span></h1>
</div>

<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-plus'></span></button>
<button type="button" class="btn btn-primary btn-lg" id="recherche" title="ajouter un livre"><span class='glyphicon glyphicon-search'></span></button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-plus'></span> Ajout de Livre</h4>
      </div>
      <div class="modal-body" align="center">
      	<?php echo validation_errors(); ?>
        <?php echo form_open('livre/add', array('id' => 'form_ajout')); ?>
		<table class="table">
			<tr>
				<th colspan="2"><?php echo form_label('Titre<span class="required">*</span>', 'titre'); ?></th>
			</tr>
	        	<tr >
				<th colspan="2"><?php echo form_input($titre); ?></th>
			</tr>
			
			
	        	<tr>
				<th colspan="2"><?=form_input($lien); ?></th>
			</tr>

			<tr>
				<th ><?php echo form_label('Série', 'serie'); ?></th>
				<th ><?php echo form_label('Folio', 'folio'); ?></th>
			</tr>
			<tr>	
				<th><?php 	echo form_input($serie); 	?></th>
				<th><?php 	echo form_input($folio); 	?></th>
			</tr>
			<tr>
				<th colspan="2"><?php echo form_label('Auteur<span class="required">*</span>', 'auteur'); ?></th>
			</tr>
			<tr>
				<th colspan="2"><?php 	echo form_multiselect($auteur['name'],$auteur['options']); 	?></th>
			</tr>
			<tr>
				<th><?php echo form_label('Genre<span class="required">*</span>', 'genre'); ?></th>
				<th><?php echo form_label('Format<span class="required">*</span>', 'format'); ?></th>
			</tr>
			<tr>
				<th><?php echo form_dropdown($genre['name'],$genre['options']); 	?></th>
				<th><?php echo form_dropdown($format['name'],$format['options']); 	?></th>
			</tr>
		</table>
	   	<input type="submit" name="submit" class="btn btn-success" value="Envoyer"/>
    <?php echo form_close(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div name="liste">
<div id="rechercheForm">
	<?php echo form_open('livre', array('id' => 'form_recherche')); ?>
	<table class="table">
		<tr >
			<th><?php 	echo form_input($titre); 	?></th>
			<th><?php 	echo form_input($serie); 	?></th>
			<th><?php 	echo form_input($folio); 	?></th>
			
		</tr>
		<tr>
			<th rowspan="2"><?php 	echo form_multiselect($auteurSearch['name'],$auteurSearch['options']); 	?></th>
			<th><?php 	echo form_dropdown($genre['name'],$genre['options']); 	?></th>
			<th><?php 	echo form_input($id); 		?></th>
		</tr>
		<tr>
			<th><?php 	echo form_dropdown($format['name'],$format['options']); 	?></th>
			<th><input type="submit" name="submitRecherche" class="btn btn-success" value="Envoyer"/></th>
		</tr>
	</table>
	<?php echo form_close(); ?>
</div>
<table class="table">
<tr>
	<th class="hidden-xs hidden-sm">#</th>
	<th>Titre</th>
	<th >Série</th>
	<th class="hidden-xs">Folio</th>
	<th class="hidden-xs">Genre</th>
	<th class="hidden-xs">Format</th>
	<th><span class='glyphicon glyphicon-globe'></span></th>
	<th class="hidden-xs"><span class='glyphicon glyphicon-trash'></span></th>
	<th><span class='glyphicon glyphicon-pencil'></span></th>
</tr>
<?php 
foreach ($livres as $livre){
echo "<tr>
<td class='hidden-xs'>".$livre->id."</td>
<td>".$livre->titre."</td>
<td>".$livre->serie."</td>
<td class='hidden-xs'>".$livre->folio."</td>
<td class='hidden-xs'>".$livre->genre."</td>
<td class='hidden-xs'>".$livre->format."</td>
<td>".	( 
		(empty($livre->lien))?
		"":  
		"<a target='_blank' href='". $livre->lien ."'><span class='glyphicon glyphicon-globe'></span></a>"
	)."
</td>
<td class='hidden-xs'><a href='".$siteRoot."livre/erase/".$livre->id."' onclick='return confirm(\" supprimer?\");' ><span class='glyphicon glyphicon-trash'></span></a></td>
<td><a href='".$siteRoot."livre/modify/".$livre->id."'><span class='glyphicon glyphicon-pencil'></span></a></td>
</tr>";
}
?>
</table>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#titre').typeahead({
		prefetch: '<?=$siteRoot?>livre/data',
		limit:10
		})	
});
</script>
