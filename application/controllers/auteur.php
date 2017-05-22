<?php
class Auteur extends CI_Controller {

	function index()
	{
		if (empty($this->session->userdata('userID'))) {
			redirect("/home/deconnexion/err");
		}
		/*
		traitement du formulaire d'insertion
		*/
		if (!empty($_POST['submit'])) { // traitement du formulaire d'ajout
			if($this->auteur_model->insert_entry()){
				$notif = array(
				'warning'	=>	false,
				'success'	=>	" ".$_POST['prenom']." ".$_POST['nom']." ajouté!",
				'danger'	=>	false
				);
				$this->load->view('notification',$notif);
			}else{
				$notif = array(
				'warning'	=>	false,
				'success'	=>	false,
				'danger'	=>	" ".$_POST['prenom']." ".$_POST['nom']." n'a pas été ajouté."
				);	
				$this->load->view('notification',$notif);
			}
		}



		if (!empty($_POST['submitRecherche'])){
			$auteurs = $this->auteur_model->get();
		}else{
			$auteurs = $this->auteur_model->get_last_ten_entries();
		}
		$header = array(
		'siteRoot' 	=>	base_url(),
		'title' 		=>	'Books - Auteur',
		'homeActive'	=>	'',
		'livreActive'	=>	'',
		'auteurActive'	=>	'active',
		'formatActive'	=>	'',
		'genreActive'	=>	'',
		'warning'		=>	false
		);

		$footer = array(
		'date' 		=>	date('d/m/Y'),
		'post'		=> $_POST
		);

		$data = array(
		'siteRoot' 	=>	base_url(),
		'message' 	=>	'Gestion des Auteurs',
		'id' => array(
			'name' => 'id',
			'id' => 'id',
			'value' => '',
			'maxlength' => 5,
			'class' 	=>'form-control',
			'placeholder'	=>	'id',
			'size' => 1
		),
		'nom' => array(
			'name' => 'nom',
			'id' => 'nom',
			'value' => '',
			'class' 	=>'form-control',
			'placeholder'	=>	'nom',
			'maxlength' => 50,
			'size' => 20
		),
		'prenom' => array(
			'name' => 'prenom',
			'id' => 'prenom',
			'value' => '',
			'class' 	=>'form-control',
			'placeholder'	=>	'prénom',
			'maxlength' => 50,
			'size' => 20
		),
		'naissance' => array(
			'name' => 'naissance',
			'id' => 'naissance',
			'value' => '',
			'class' 	=>'form-control',
			'placeholder'	=>	'naissance',
			'maxlength' => 4,
			'size' => 4
		),
		'deces' => array(
			'name' => 'deces',
			'id' => 'deces',
			'value' => '',
			'class' 	=>'form-control',
			'placeholder'	=>	'décès',
			'maxlength' => 4,
			'size' => 4
		),
		'lien' => array(
			'name' => 'lien',
			'id' => 'lien',
			'value' => '',
			'class' 	=>'form-control',
			'placeholder'	=>	'lien',
			//'maxlength' => 50,
			'size' => 20
		),
		'auteurs'		=> $auteurs

		);


		$this->load->view('header',$header);
		$this->load->view('auteur',$data);
		$this->load->view('footer',$footer);
	}

	function modify()
	{
		/*
		* traitement du formulaire de modification
		*/
		$auteur = $this->auteur_model->update_entry();

		$supp = array(
		'warning'	=>	false,
		'success'	=>	" ".$auteur->prenom." ".$auteur->nom." modifié",
		'danger'	=>	false
		);

		$this->load->view('notification',$supp);
		$this->index();

			$footer = array(
			'date' 		=>	date('d/m/Y'),
			'post'		=> $_POST
			);
	}

	function erase($id)
	{
		$this->auteur_model->set_del($id);

		$_POST['id'] = $id;
		$_POST['del'] = true;
		$auteurs = $this->auteur_model->get();
		$auteur = $auteurs[0];
		$supp = array(
		'auteurs' 	=>	$auteurs,
		'warning'	=>	false,
		'success'	=>	" ".$auteur->prenom." ".$auteur->nom." supprimé",
		'danger'	=>	false
		);

		$this->load->view('notification',$supp);
		$this->index();
	}

	function data(){
		
		$query = 'SELECT nom FROM auteur';

		if(isset($_REQUEST['query'])){
			// Add validation and sanitization on $_POST['query'] here

			// Now set the WHERE clause with LIKE query
			$query .= ' WHERE nom LIKE "%'.$_REQUEST['query'].'%" AND del=false';
			
			print_r($query);
			
		}

		$return = array();

		if($result = $this->auteur_model->query($query)){
			
			// fetch object array
			foreach ($result as $obj) {
				
				$return[] = $obj->nom;
			}
		}
		$json = json_encode($return);
		print_r($json);
	}
}
?>
