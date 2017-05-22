<?php
class Livre extends CI_Controller {

	public $idAuteur;

	/**
	 *
	 */
	function index()
	{
		if (empty($this->session->userdata('userID'))) {
			redirect("/home/deconnexion/err");
		}

		if (!empty($_POST['submitRecherche'])) {
			$livres = $this -> livre_model -> get();
		} elseif ($this->idAuteur > 0) {
			$livres = $this -> livre_model -> getByAuthorId($this->idAuteur);
		} else {
			$livres = $this -> livre_model -> get_last_ten_entries();
		}

		/*
		vues
		*/
		$header = array (
			'siteRoot' 		=>	base_url(),
			'title'			=>	'Books - Livres',
			'homeActive'	=>	'',
			'livreActive'	=>	'active',
			'auteurActive'	=>	'',
			'formatActive'	=>	'',
			'genreActive'	=>	'',
			'warning'		=>	false
		);

		$data = array (
			'siteRoot' 	=>	base_url(),
			'message' 	=>	'Gestion des Livres',
			'livres'	=>	$livres,
			'id' 		=> array(
							'name' => 'id', 
							'id' => 'id', 
							'value' => '', 
							'maxlength' => 5, 
							'size' => 1,
							'class' 	=>'form-control',
							'placeholder'	=>	'id'
						),
			'titre' 	=> array (
							'name' 			=> 	'titre',
							'id' 			=> 	'titre', 
							'value' 		=> 	'', 
							'size' 			=> 	'100%',
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Titre',
							'class'			=>	"form-control typeahead",
							'type'			=>	"text",
							'data-provide' 	=> 	"typeahead",
							'autocomplete' 	=> 	"off"
						),
			'lien'	 => array (
							'name' => 'lien', 
							'id' => 'lien', 
							'value' => '', 
							'size' => 1,
							'class' 	=>"form-control",
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Lien'
						),
			'auteur' => array (
							'options' => $this->auteur_model->getSelect(), 
							'name' => 'auteur[]', 
							'id' => 'auteur', 							
							'size' => 1,
							'autocomplete'	=>	'off',
							'class' 	=>"form-control",
							'placeholder'	=>	'Auteur'
						),
			'auteurSearch' => array (
							'options' => $this->auteur_model->getSelect(), 
							'name' => 'auteurSearch[]', 
							'id' => 'auteurSearch', 							
							'size' => 1,
							'autocomplete'	=>	'off',
							'class' 	=>"form-control",
							'placeholder'	=>	'Auteur'
						),
			'serie' => array (
							'name' => 'serie', 
							'id' => 'serie', 
							'value' => '', 
							'size' => 1,
							'class' 	=>"form-control",
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Série'
						),
			'folio' => array (
							'name' => 'folio', 
							'id' => 'folio', 
							'value' => '', 
							'size' => 1,
							'autocomplete'	=>	'off',
							'class' 	=>"form-control",
							'placeholder'	=>	'Folio'
						),
			'genre' => array (
							'name' => 'genre', 
							'id' => 'genre', 
							'options' => $this->genre_model->getSelect(), 
							'size' => 1,
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Genre'
						),
			'format' => array (
							'name' => 'format', 
							'id' => 'format', 
							'options' => $this->format_model->getSelect(), 
							'maxlength' => 5, 
							'size' => 1,
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Format'
						),
			'ajout' => array (
							'name' => 'ajout',
							'id' => 'ajout',
							'value' => '',
							'maxlength' => 5,
							'size' => 1,
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Ajout'
						),
		);

		$footer = array (
			'date' 		=>	date('d/m/Y'),
			'post'		=> $_POST
		);

		$this->load->view('header',$header);
		$this->load->view('livre',$data);
		$this->load->view('footer',$footer);
	}

	/**
	 *
	 */
	function search()
	{
		$livres = $this -> livre_model -> get();
		
		$this->index();
	}

	/**
	 * @param $livreId
	 */
	function modify($livreId)
	{
		$_POST['id'] = $livreId ;
		$livre = $this->livre_model->get();
		$livre = $livre[0];
		$header = array(
			'siteRoot' 	=>	base_url(),
			'title' 		=>	'Books - Livres',
			'homeActive'	=>	'',
			'livreActive'	=>	'active',
			'auteurActive'	=>	'',
			'formatActive'	=>	'',
			'genreActive'	=>	'',
			'warning'		=>	false
		);
		$auteur = $this->auteur_model->getByLivre($livre->id);
		//echo "<pre>";var_dump($auteur['selected']);die();
		
		$data = array(
			'id' => array(
							'name' => 'id', 
							'id' => 'id', 
							'value' => $livre->id, 
							'maxlength' => 5, 
							'size' => 1,
							'class' 	=>'form-control',
							'placeholder'	=>	'id'
						),
			'titre' => array(
							'name' 			=> 	'titre', 
							'id' 			=> 	'titre', 
							'value' 		=> 	$livre->titre, 
							'size' 			=> 	'300%',
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Titre',
							'class'			=>	"form-control",
							'type'			=>	"text",
							'data-provide' 	=> 	"typeahead",
							'autocomplete' 	=> 	"off"
						),
			'lien' => array(
							'name' => 'lien', 
							'id' => 'lien', 
							'value' => $livre->lien, 
							'size' => 1,
							'class' 	=>"form-control",
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Lien'
						),
			'auteur' => array(
							'options' => $auteur['unselected'], 
							'name' => 'auteurOut', 
							'id' => 'auteurOut', 							
							'size' => 1,
							'autocomplete'	=>	'off',
							'class' 	=>"form-control",
							'placeholder'	=>	'Auteur'
						),
			'auteurSelected' => array(
							'options' => (isset($auteur['selected'])?$auteur['selected']:array()), 
							'name' => 'auteurIn[]', 
							'id' => 'auteurIn', 							
							'size' => 1,
							'autocomplete'	=>	'off',
							'class' 	=>	"form-control",
							'placeholder'	=>	'Auteur'
						),
			'serie' => array(
							'name' => 'serie', 
							'id' => 'serie', 
							'value' => $livre->serie, 
							'size' => "100%",
							'class' 	=>"form-control",
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Série'
						),
			'folio' => array(
							'name' => 'folio', 
							'id' => 'folio', 
							'value' => $livre->folio, 
							'size' => 1,
							'autocomplete'	=>	'off',
							'class' 	=>"form-control",
							'placeholder'	=>	'Folio'
						),
			'genre' => array(
							'name' => 'genre', 
							'id' => 'genre', 
							'options' => $this->genre_model->getSelect(), 
							'selected' => $livre->genreID,
							'class' 	=>"form-control",
						),
			'format' => array(
							'name' => 'format', 
							'id' => 'format',
							'selected' => $livre->formatID,
							'options' => $this->format_model->getSelect(), 
							'maxlength' => 5, 
							'size' => 1,
							'autocomplete'	=>	'off',
							'placeholder'	=>	'Format'
						),
			'rangement1' => array(
				'name' 			=> 'rangement1',
				'id' 			=> 'rangement1',
				'value' 		=> $livre->rangement1,
				'size' 			=> "100%",
				'class' 		=>"form-control",
				'autocomplete'	=>	'off',
				'placeholder'	=>	'Rangement 1'
			),
			'rangement2' => array(
				'name' 			=> 'rangement2',
				'id' 			=> 'rangement2',
				'value' 		=> $livre->rangement2,
				'size' 			=> "100%",
				'class' 		=>"form-control",
				'autocomplete'	=>	'off',
				'placeholder'	=>	'Rangement 2'
			),
		);	
		$footer = array(
		'date' 		=>	date('d/m/Y'),
		'post'		=> $_POST
		);
		$this->load->view('header',$header);
		$this->load->view('detail',$data);
		$this->load->view('footer',$footer);
	}

	/**
	 *
	 */
	function update()
	{
		if ($this -> livre_model -> update_entry()) {
			$notif = array(	'warning' => false, 
								'success' => " " . $_POST['titre'] . " modifié!",
								'danger' => false);
		} else {
			$notif = array(	'warning' => false, 
								'danger' => " " . $_POST['titre'] . "n'a pas été modifié!", 
								'success' => false);
		}
		$this -> load -> view('notification', $notif);
		$this->index();
	}

	/**
	 *
	 */
	function add()
	{
		/*
		 traitement du formulaire d'insertion
		 */
		 
	 	//form validator
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('titre', 'titre', 'required');
		$this->form_validation->set_rules('genre', 'Genre', 'required');
		$this->form_validation->set_rules('format', 'Format', 'required');
		//$this->form_validation->set_rules('adresse', 'adresse', 'required');
		if ($this->form_validation->run() == FALSE) {// traitement du formulaire d'ajout
			$notif = array(	'warning' => false, 
								'success' => false, 
								'danger' => " le livre n'a pas été ajouté. formulaire incomplet");
			$this -> load -> view('notification', $notif);
		} else {
			if ($this -> livre_model -> insert_entry()) {
				$notif = array(	'warning' => false, 
								'success' => " " . $_POST['titre'] . " ajouté!",
								'danger' => false);
				$this -> load -> view('notification', $notif);
				
			}
		}
		$this->index();
	}

	function erase($id) {

		// on efface,
		$res = $this -> livre_model -> set_del($id);
		
		// on rÃ©cupÃ¨re les informations de l'Ã©lÃ©ment effacÃ©
		$_POST['id'] = $id;
		$_POST['del'] = true;
		
		$notif = array('success' => false, 'warning' => "  supprimé !" , 'danger' => "");
		$this -> load -> view('notification', $notif);

		$this -> index();
	}
	
	function data(){

		$query = 'SELECT titre FROM livre';

		if(isset($_REQUEST['query'])){
			// Add validation and sanitization on $_POST['query'] here

			// Now set the WHERE clause with LIKE query
			$query .= ' WHERE titre LIKE "%'.$_REQUEST['query'].'%" AND del=false';
			
			print_r($query);
		}

		$return = array();

		if($result = $this->livre_model->query($query)){
			
			// fetch object array
			foreach ($result as $obj) {
				
				$return[] = $obj->titre;
			}
		}
		$json = json_encode($return);
		print_r($json);
	}

	function searchByAuteur($idAuteur){
		$this->idAuteur = $idAuteur;
		$this->index();
	}
}
