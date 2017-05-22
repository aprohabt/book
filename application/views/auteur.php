<div>
<h1><?=$message?> <span class='glyphicon glyphicon-user'></span></h1>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-plus'></span> Ajout d'Auteur</h4>
      </div>
      <div class="modal-body" align="center">
      	
        <?php echo form_open('auteur', array('id' => 'form_ajout')); ?>
		<table class="table">
	        <tr>
		        <td>
			    <?php echo form_label('Nom<span class="required">*</span>', 'nom'); ?>
			    </td>
			    <td>
			    <?php echo form_input($nom); ?>
			    </td>
		    </tr>
		    <tr>
			    <td>
			    <?php echo form_label('Prénom<span class="required">*</span>', 'prenom'); ?>
			    </td>
			    <td>
			    <?php echo form_input($prenom); ?>
			    </td>
		    </tr>
		    <tr>
			    <td>
			    <?php echo form_label('Naissance', 'naissance'); ?>
			    </td>
			    <td>
			    <?php echo form_input($naissance); ?>
			    </td>
		    </tr>
		    <tr>
			    <td>
			    <?php echo form_label('Décès', 'deces'); ?>
			    </td>
			    <td>
			    <?php echo form_input($deces); ?>
			    </td>
		    </tr>
		    <tr>
			    <td>
			    <?php echo form_label('Lien', 'link'); ?>
			    </td>
			    <td>
			    <?php echo form_input($lien); ?>
			    </td>
		    </tr>
		</table>
	   	<input type="submit" name="submit" class="btn btn-success" value="Envoyer"/>
    <?php echo form_close(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-plus'></span></button>
<button type="button" class="btn btn-primary btn-lg" id="recherche" title="ajouter un auteur"><span class='glyphicon glyphicon-search'></span></button>


<div name="auteur_liste">
<div id="rechercheForm">
	<?php echo form_open('auteur', array('id' => 'form_recherche')); ?>
	<table class="table">
		<tr>
			<td><?php echo form_input($id); ?></td>
			<td><?php echo form_input($nom); ?></td>
			<td><?php echo form_input($prenom); ?></td>
			<td><?php echo form_input($naissance); ?></td>
			<td><?php echo form_input($deces); ?></td>
			<td colspan="2"><input type="submit" name="submitRecherche" class="btn btn-success" value="Envoyer"/></td>
		</tr>
	</table>
	 <?php echo form_close(); ?>
</div>
<table class="table">
<tr>
	<th>#</th>
	<th>Nom</th>
	<th>Prénom</th>
	<th>Naissance</th>
	<th>Décès</th>
	<th><span class='glyphicon glyphicon-list-alt'></span></th>
	<th><span class='glyphicon glyphicon-globe'></span></th>
	<th><span class='glyphicon glyphicon-trash'></span></th>
	<th><span class='glyphicon glyphicon-pencil'></span></th>
</tr>
<?php
foreach ($auteurs as $auteur){
	echo "<tr>
				<td>".$auteur->id."</td>
				<td>".$auteur->nom."</td>
				<td>".$auteur->prenom."</td>
				<td>".$auteur->naissance."</td>
				<td>".$auteur->deces."</td>
				<td><a href=livre/searchByAuteur/".$auteur->id."><span class='glyphicon glyphicon-list-alt' title='livres de cet auteur'></a></td>
				<td>".( 
						(empty($auteur->link))?
						"":  
						"<a target='_blank' href='". $auteur->link ."'><span class='glyphicon glyphicon-globe' title='". $auteur->link ."'></span></a>"
						)
						."</td>
				<td><a href='".$siteRoot."auteur/erase/".$auteur->id."' onclick='return confirm(\" supprimer?\");' )><span class='glyphicon glyphicon-trash' title='supprimer'></span></a></td>
				<td><a data-toggle='modal' data-target='#ModalModify".$auteur->id."' href='#1'><span class='glyphicon glyphicon-pencil' title='modifier'></span></a></td>
		</tr>";
}
?>
</table>
</div>
</div>


<?php
foreach ($auteurs as $auteur){
	
	$prenom["value"]=$auteur->prenom;
	$nom["value"]=$auteur->nom;
	$naissance["value"]=$auteur->naissance;
	$deces["value"]=$auteur->deces;
	$lien["value"]=$auteur->link;
?>
<!-- Modal -->
<div class="modal fade" id="ModalModify<?=$auteur->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-pencil'></span> Modification d'Auteur</h4>
      </div>
      <div class="modal-body" align="center">
  		 <?=form_open('auteur/modify', array('id' => 'form_ajout')); ?>
	<table class="table" width="30%">
		<tr>
			<th>
			<?=form_label('Nom<span class="required">*</span>', 'nom'); ?>
			</th>
		    <td>
		    <?=form_input($nom,$auteur->nom); ?>
		    </td>
		</tr>
		<tr>
			<th>
		    <?=form_label('Prénom<span class="required">*</span>', 'prenom'); ?>
		    </th>
		    <td>
		    <?=form_input($prenom,$auteur->prenom); ?>
		    </td>
		</tr>
		<tr>
			<th>		
		    <?=form_label('Naissance', 'naissance'); ?>
		    </th>
		    <td>
		    <?=form_input($naissance,$auteur->naissance); ?>
		    </td>
		</tr>
		<tr>
			<th>
		    <?=form_label('Décès', 'deces'); ?>
		    </th>
		    <td>
	    	<?=form_input($deces,$auteur->deces); ?>
	    	</td>
	    </tr>
	    	<th>
		    <?=form_label('Lien', 'lien'); ?>
		    </th>
		    <td>
	    	<?=form_input($lien,$auteur->link); ?>
	    	</td>
	    </tr>
	</table>
	<input type="submit" name="modify" class="btn btn-default" value="Envoyer"/>
    <?=form_hidden("id", $auteur->id); ?>
    <?=form_close(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
}
?>





<script type="text/javascript">
$(document).ready(function() {
	$('#typeahead').typeahead({
		prefetch: '<?=$siteRoot?>auteur/data',
		limit:10
		})	
});
</script>