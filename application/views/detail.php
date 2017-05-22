<br /><br />
<div>
	<?=validation_errors(); ?>
	<?=form_open('livre/update', array('id' => 'form_ajout', 'name' => "fform")); ?>
	<table class="table">
		<tr>
			<th colspan="3"><?=form_label('Titre<span class="required">*</span>', 'titre'); ?></th>
		</tr>
	    	<tr >
			<th colspan="3"><?=form_input($titre); ?></th>
		</tr>
		<tr >
			<th colspan="3"><?=form_input($lien); ?></th>
		</tr>
		<tr>
			<th ><?=form_label('Série', 'serie'); ?></th>
			<th ></th>
			<th ><?=form_label('Folio', 'folio'); ?></th>
		</tr>
		<tr>	
			<th><?=form_input($serie); 	?></th>
			<th ></th>
			<th><?= form_input($folio); 	?></th>
		</tr>
		<tr>
			<th colspan="3"><?= form_label('Auteur<span class="required">*</span>', 'auteur'); ?></th>
		</tr>
		<tr>
			<th width='48%' ><?php 	echo form_multiselect($auteurSelected['name'],$auteurSelected['options'], $auteurSelected['id'].'class="form-control"'); 	?></th>
			<th width = '4%'>
				<div><a class="btn btn-success" onclick="assocAdd(document.fform.auteurOut, true);"><span class="glyphicon glyphicon-arrow-left"></span></a></div>
				<div><a class="btn btn-danger" onclick="assocDel(document.fform.auteurIn, true)"><span class="glyphicon glyphicon-arrow-right"></a></span>
</button></div>
			</th>			
			<th width='48%' ><?= form_multiselect($auteur['name'],$auteur['options'],"id='".$auteur['id']."'"); 	?></th>
		</tr>
		<tr>
			<th><?=form_label('Genre<span class="required">*</span>', 'genre'); ?></th>
			<th ></th>
			<th><?=form_label('Format<span class="required">*</span>', 'format'); ?></th>
		</tr>
		<tr>
			<th><?=form_dropdown($genre['name'],$genre['options'],$genre['selected']); 	?></th>
			<th ></th>
			<th><?=form_dropdown($format['name'],$format['options'],$format['selected']); 	?></th>
		</tr>
		<tr>
			<th><?=form_label('Rangement 1', 'rangement1'); ?></th>
			<th ></th>
			<th><?=form_label('Rangement 2', 'rangement1'); ?></th>
		</tr>
		<tr>
			<th><?=form_textarea($rangement1); ?></th>
			<th></th>
			<th><?=form_textarea($rangement2); ?></th>
		</tr>
		<tr >
			<th colspan="3" ><input type="submit" name="submit" class="btn btn-primary" value="Modifier"/></th>
		</tr>
		<tr>
			<th colspan="3" ><a href="<?=$siteRoot?>livre" class="btn btn-warning">Retour</a></th>
		</tr>
	</table>
	<input type="hidden" name="last_selected" id="mail_destinataire_last_selected"/>
	<!--<input type="hidden" name="auteurInHide" id="auteurInHide"/>-->
	<input type="hidden" name="id"  value="<?=$id['value']?>"/>
	<?=form_close(); ?>
 </div>
 <script type="text/javascript">
$(document).ready(function() {
	$('#titre').typeahead({
		prefetch: '<?=$siteRoot?>livre/data',
		limit:10
		});
		
	$("#auteurInHide").val();
	$("#form_ajout").submit(
		function(){
			$("#auteurIn option").each(
				function(){
					$( this ).attr("selected","selected");
				}
			);
		}
	);
});

function getSelected(idSelect){
	var values = $('#auteurIn').val();
	alert(values);
}
</script>
