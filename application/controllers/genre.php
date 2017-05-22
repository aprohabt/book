<?php
class Genre extends CI_Controller {

	function index() {
				
		if (empty($this->session->userdata('userID'))) {
			redirect("/home/deconnexion/err");
		}
		/*
		 * traitement du formulaire de recherche
		 */
		if (!empty($_POST['submitRecherche'])) {
			$genres = $this -> genre_model -> get();
		} else {
			$genres = $this -> genre_model -> get_last_ten_entries();
		}
		
		/*
		 * mise en forme des données 
		 */
		$header = array('siteRoot' => base_url(), 'title' => 'Books - Genre', 'homeActive' => '', 'livreActive' => '', 'auteurActive' => '', 'formatActive' => '', 'genreActive' => 'active', 'warning' => false);

		$footer = array('date' => date('d/m/Y'), 'post' => $_POST);

		$data = array(
						'siteRoot' => base_url(), 
						'message' => 'Gestion des Genres', 
						'id' => array(
										'name' => 'id', 
										'id' => 'id', 
										'value' => '', 
										'maxlength' => 5, 
										'class' 	=>'form-control',
										'size' => 1
									), 
						'nom' => array(
										'name' => 'nom', 
										'id' => 'nom', 
										'value' => '', 
										'maxlength' => 50, 
										'class' 	=>'form-control',
										'size' => 20), 
						'genres' => $genres);

		/*
		 * Chargement des vues
		 */ 
		$this -> load -> view('header', $header);
		$this -> load -> view('genre', $data);
		$this -> load -> view('footer', $footer);
	}

	function modify()
	{
		/*
		* traitement du formulaire de modification
		*/
		$genre= $this->genre_model->update_entry();

		$supp = array(
		'warning'	=>	false,
		'success'	=>	" ".$genre->nom." modifié",
		'danger'	=>	false
		);

		$this->load->view('notification',$supp);
		$this->index();

			$footer = array(
			'date' 		=>	date('d/m/Y'),
			'post'		=> $_POST
			);
	}

	function add(){
		/*
		 traitement du formulaire d'insertion
		 */
		if (!empty($_POST['submit'])) {// traitement du formulaire d'ajout
			if ($this -> genre_model -> insert_entry()) {
				$notif = array('warning' => false, 'success' => " " . $_POST['nom'] . " ajouté!", 'danger' => false);
				$this -> load -> view('notification', $notif);
			} else {
				$notif = array('warning' => false, 'success' => false, 'danger' => " " . $_POST['prenom'] . " " . $_POST['nom'] . " n'a pas été ajouté.");
				$this -> load -> view('notification', $notif);
			}
		}
		$this->index();
	}

	function erase($id) {

		// on efface,
		$res = $this -> genre_model -> set_del($id);
		
		// on récupère les informations de l'élément effacé
		$_POST['id'] = $id;
		$_POST['del'] = true;
		$genres = $this -> genre_model -> get();
		$genre = $genres[0];
		
		$notif = array('warning' => false, 'success' => " " . $genre->nom . " supprimé !", 'danger' => "");
		$this -> load -> view('notification', $notif);

		$this -> index();
	}
}
?>
