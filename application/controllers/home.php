<?php
class Home extends CI_Controller {

	function index() {
		if($this->session->userdata('userID')){

			$header = array(
				'siteRoot' => base_url(),
				'title' => 'B.O.O.K - Home',
				'homeActive'	=>	'active',
				'livreActive'	=>	'',
				'auteurActive'	=>	'',
				'formatActive'	=>	'',
				'genreActive'	=>	''
			);
		
			$footer = array('date' => date('d/m/Y'), 'post' => null);
	
			$data = array(
				'message' 		=> 	'Bienvenue sur ta Bibliothèque Optimisée Ordonnée et "Komplète"',
				'auteurCount'	=> $this->auteur_model->get_count(),
				'genreCount'	=>	$this->genre_model->get_count(),
				'formatCount'	=>	$this->format_model->get_count(),
				'livreCount'		=>	$this->livre_model->get_count()
			);
			
			$this -> load -> view('header', $header);
			
			$this -> load -> view('home', $data);
			$this -> load -> view('footer', $footer);	
		}else{
			$data = array(
				'siteRoot' 	=> base_url(),
				'title'		=> "B.O.O.K. - Identification ",
				'message' 	=> 	'Identification',
				'login' 	=> array(
								'name' => 'login', 
								'id' => 'login', 
								'value' => '', 
								'maxlength' => 50, 
								'size' => 20,
								"class"=>"form-control",
								"placeholder"=>"login",
								"autocomplete"=>"off"),
				'password' 	=> array(
								'name' => 'password', 
								'id' => 'password', 
								'value' => '', 
								'maxlength' => 50,
								'type'=> 'password', 
								'size' => 20,
								"class"=>"form-control",
								"placeholder"=>"mot de passe"),
			);
			$this -> load -> view('login', $data);
		}
	}

		function connexion()
		{
			$this->form_validation->set_rules('login', 'login', 'required');
			$this->form_validation->set_rules('password', 'mot de passe', 'required');

			if ($this->form_validation->run())
			{
				$row = $this -> login_model -> identification();
				if(isset($row->id))
				{
					$this->session->set_userdata('userID', $row->id);
					$this->session->set_userdata('userLogin', $row->login);
					$supp = array(
						'success'	=>	" Bienvenu <b>".$row->login."</b> !"
					);
					$this->load->view('notification',$supp);
					$this->index();
				}else{
					$supp = array(
						'warning'	=>	" échec de votre connexion "
					);
					$this->load->view('notification',$supp);
					$this->index();
				}
			}else{
				$supp = array(
						'danger'	=>	" formulaire incomplet "
				);
				$this->load->view('notification',$supp);
				$this->index();	
			
			}
			
		}
		function deconnexion($err=''){
			$this->session->unset_userdata('userID');
			$notif = array(
							'warning'	=>	((empty($err)) ? " Vous êtes maintenant déconnecté ":FALSE),
							'danger'	=>	((empty($err)) ? FALSE : " Vous n'êtes pas connecté")
						);
			$this->load->view('notification',$notif);
			$this->index();
		}
}
?>
