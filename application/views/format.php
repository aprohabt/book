<div>
<h1><?=$message?> <span class='glyphicon glyphicon-fullscreen'></span></h1>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-plus'></span> Ajout de Format</h4>
      </div>
      <div class="modal-body" align="center">
      	
        <?php echo form_open('format/add', array('id' => 'form_ajout')); ?>
		<table class="table">
	        <tr>
		        <td>
			    <?php echo form_label('Nom<span class="required">*</span>', 'nom'); ?>
			    </td>
			    <td>
			    <?php echo form_input($nom); ?>
			    <input style="display:none" id="typeahead" type="text" data-provide="typeahead" autocomplete="off">
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
<button type="button" class="btn btn-primary btn-default btn-lg" id="recherche" title="Ajouter un Format"><span class='glyphicon glyphicon-search'></span></button>


<div name="liste">
<div id="rechercheForm">
	<?php echo form_open('format', array('id' => 'form_recherche')); ?>
	<table class="table">
		<tr>
			<td><?php echo form_input($id); ?></td>
			<td><?php echo form_input($nom); ?></td>
			<td colspan="2"><input type="submit" name="submitRecherche" class="btn btn-success" value="Envoyer"/></td>
		</tr>
	</table>
	 <?php echo form_close(); ?>
</div>
<table class="table">
<tr>
	<th>#</th>
	<th>Nom</th>
	<th><span class='glyphicon glyphicon-trash'></span></th>
	<th><span class='glyphicon glyphicon-pencil'></span></th>
</tr>
<?php
foreach ($formats as $format){
	echo "<tr>
				<td>".$format->id."</td>
				<td>".$format->nom."</td>
				<td><a href='".$siteRoot."format/erase/".$format->id."' onclick='return confirm(\" supprimer?\");' ><span class='glyphicon glyphicon-trash'></span></a></td>
				<td><a data-toggle='modal' data-target='#ModalModify".$format->id."' href='#1'><span class='glyphicon glyphicon-pencil'></span></a></td>
		</tr>";
}
?>
</table>
</div>
</div>


<?php
foreach ($formats as $format){
	$nom["value"]=$format->nom;
?>
<!-- Modal -->
<div class="modal fade" id="ModalModify<?=$format->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><span class='glyphicon glyphicon-pencil'></span> Modification de Format</h4>
      </div>
      <div class="modal-body" align="center">
  		 <?=form_open('format/modify', array('id' => 'form_ajout')); ?>
	<table class="table" width="30%">
		<tr>
			<th>
			<?=form_label('Nom<span class="required">*</span>', 'nom'); ?>
			</th>
		    <td>
		    <?=form_input($nom,$format->nom); ?>
		    </td>
		</tr>
	</table>
	<input type="submit" name="modify" class="btn btn-default" value="Envoyer"/>
    <?=form_hidden("id", $format->id); ?>
    <?=form_close(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
}
?>