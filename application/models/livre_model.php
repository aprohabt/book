<?php
class Livre_model extends CI_Model {

	var $id   	= '';
	var $titre  	= '';
	var $lien  	= '';
	var $serie  	= '';
	var $folio  	= '';
	var $genre  	= '';
	var $format	= '';
	var $pret	= '';
	var $rangement1	= '';
	var $rangement2	= '';
	var $ajout	= '';
	var $tags	= '';
	var $del	= '';
	var $userId	= '';

    function Livre_model()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function get(){
    	$sql = "SELECT livre.`id` , `titre`, `lien` , `serie` , `folio` , g.id AS genreID, g.nom AS genre, f.id AS formatID, f.nom AS format , `pret` , `rangement1` , `rangement2` , `ajout` , `tags`
    			FROM `livre` 
    			INNER JOIN genre g ON (g.id = livre.genre)
    			INNER JOIN format f ON (f.id = livre.format)";
    	//condition supplémentaire pour l'auteur
    	$sql .= (!empty($_POST['auteurSearch']))		? " INNER JOIN auteur_livre al ON (al.livre = livre.id) WHERE ":" WHERE ";
    	
    	//conditions
		$sql .= (!empty($_POST['del']))			? " livre.del = ".$_POST['del'] :" livre.del = FALSE"; // par dÃ©faut del = false
    	$sql .= (!empty($_POST['id']))			? " AND livre.id = ".$_POST['id'] :"";
    	$sql .= (!empty($_POST['titre']))		? " AND titre LIKE '%".addslashes($_POST['titre'])."%'":"";
    	$sql .= (!empty($_POST['serie']))		? " AND serie LIKE '%".addslashes($_POST['serie'])."%'":"";
    	$sql .= (!empty($_POST['folio']))		? " AND folio LIKE  \"".addslashes($_POST['folio'])."%\"":"";
    	$sql .= (!empty($_POST['genre']))		? " AND genre = ".$_POST['genre']:"";
		$sql .= (!empty($_POST['format']))		? " AND format = ".$_POST['format']:"";
		$sql .= (!empty($_POST['pret']))		? " AND pret LIKE '".addslashes($_POST['pret'])."%'":"";
		$sql .= (!empty($_POST['rangement1']))	? " AND rangement1 LIKE ".addslashes($_POST['rangement1'])."%'":"";
		$sql .= (!empty($_POST['rangement2']))	? " AND rangement2 = ".addslashes($_POST['rangement2'])."%'":"";
		$sql .= (!empty($_POST['ajout']))		? " AND ajout = '".$_POST['ajout']."'":"";
		$sql .= (!empty($_POST['tags']))		? " AND tags IN ('".implode("','", $_POST['tags'])."')":"";
		$sql .= (!empty($_POST['auteurSearch']))		? " AND auteur IN ('".implode("','", $_POST['auteurSearch'])."')":"";
    	    	
    	$sql .= " AND livre.userID = ". $this->session->userdata('userID') ." ORDER BY titre, id"; 
    	$query = $this->db->query($sql);
    	
    	return $query->result();
    }
    
    function getByAuthorId($authorId){

    	$sql = "SELECT livre.`id` , `titre`, `lien` , `serie` , `folio` , g.id AS genreID, g.nom AS genre, f.id AS formatID, f.nom AS format , `pret` , `rangement1` , `rangement2` , `ajout` , `tags`
    			FROM `livre` 
    			INNER JOIN genre g ON (g.id = livre.genre)
    			INNER JOIN format f ON (f.id = livre.format)
    			INNER JOIN auteur_livre al ON (al.livre = livre.id) WHERE ";	
    	//conditions
		$sql .= " livre.del = FALSE" ; // par dÃ©faut del = false
		$sql .= " AND auteur = " .$authorId ;
    	    	
    	$sql .= " AND livre.userID = ". $this->session->userdata('userID') ." ORDER BY titre, id";
    	$query = $this->db->query($sql);
    	
    	return $query->result();
    }

    function get_last_ten_entries()
    {
        $query = $this->db->query('SELECT livre.`id` , `titre`, `lien` , `serie` , `folio` , g.nom AS genre, f.nom AS format , `pret` , `rangement1` , `rangement2` , `ajout` , `tags`
    			FROM `livre` 
    			INNER JOIN genre g ON (g.id = livre.genre)
    			INNER JOIN format f ON (f.id = livre.format)
    			WHERE livre.del!=1 
    			AND livre.userID = '. $this->session->userdata('userID') .' ORDER BY id DESC LIMIT 10');
        return $query->result();
    }
    
    function set_del($id)
    {
        $query = $this->db->query("UPDATE `livre` SET `del` = 1 WHERE `id` =$id ");
	}

    function insert_entry()
    {
        $this->id   		= (!empty($_POST['id']))? $_POST['id']: null;
	$this->titre  		= (!empty($_POST['titre']))? $_POST['titre']: null;
	$this->lien  		= (!empty($_POST['lien']))? $_POST['lien']: null;
	$this->serie  		= (!empty($_POST['serie']))? $_POST['serie']: null;
	$this->folio  		= (!empty($_POST['folio']))? $_POST['folio']: null;
	$this->genre  		= (!empty($_POST['genre']))? $_POST['genre']: null;
	$this->format		= (!empty($_POST['format']))? $_POST['format']: null;
	$this->pret		= (!empty($_POST['pret']))? $_POST['pret']: null;
	$this->rangement1	= (!empty($_POST['rangement1']))? $_POST['rangement1']: null;
	$this->rangement2	= (!empty($_POST['rangement2']))? $_POST['rangement2']: null;
	$this->ajout		= (!empty($_POST['ajout']))? $_POST['ajout']: null;

	$this->tags		= (!empty($_POST['tags']))? $_POST['tags']: null;
	$this->del		= (!empty($_POST['del']))? $_POST['del']: 0;
	$this->userId		= (!empty($this->session->userdata('userID')))? $this->session->userdata('userID'): 0;
	
        if($this->db->insert('livre', $this)){//retourne 1 si ok 
			// on ajoute dans la table de link auteur et livres
			$aLivreAdd = $this->get();
			$aLivreAdd = $aLivreAdd[0];
			
			$this->auteur		= (!empty($_POST['auteur']))? $_POST['auteur']: null;

			if (is_array($this->auteur)) {
				foreach ($this->auteur as $auteur){
					$this->db->query("	INSERT INTO `book_book`.`auteur_livre` (
										`livre` ,
										`auteur`
										)
										VALUES (".
										$aLivreAdd->id  .", $auteur
										);");	// ajouter l'enregistrement des auteurs 		
				}
			}			
        } 
    }

    function update_entry()
    { 
    	$this->id   		= $_POST['id'];
	    $this->titre  		= $_POST['titre'];
	    $this->lien			= $_POST['lien'];
	    $this->serie  		= $_POST['serie'];
	    $this->folio  		= $_POST['folio'];
	    $this->genre  		= $_POST['genre'];
	    $this->format		= $_POST['format'];
	    $this->userId		= $this->session->userdata('userID');
		/*$this->pret			= $_POST['pret'];
		$this->rangement1	= $_POST['rangement1'];
		$this->rangement2	= $_POST['rangement2'];
		$this->ajout		= $_POST['ajout'];
		$this->tags			= $_POST['tags'];
		$this->del			= $_POST['del'];*/

        $this->db->update('livre', $this, array('id' => $_POST['id']));
        
        // supprimer tous les liens livre auteur pour l'id $this-> id
		$this->db->query("DELETE FROM `book_book`.`auteur_livre` WHERE livre =".  $this->id);
        
        //foreach sur le tableau auteur selected
		if(is_array($_POST['auteurIn']) ){

			foreach ($_POST['auteurIn'] as $auteur){
	        	//ajout des id auteur pour le livre this-> id dans auteur_livre
	        	$this->db->query("	INSERT INTO `book_book`.`auteur_livre` (
									`livre` ,
									`auteur`
									)
									VALUES (".
									$this->id  .", $auteur
									);");	// ajouter l'enregistrement des auteurs 
	        }
		}else{
			die('erreur');
		}
		return $this;
    }
    
	function get_count(){
		
		$result = $this->db->query("SELECT count(id) as ids FROM livre WHERE `del` = 0 AND livre.userID = ". $this->session->userdata('userID'));
		$count = $result->result();
		return $count[0]->ids;
	}
	
	function query($query){
		//die($query);
		$result = $this->db->query($query);
		return $result->result();
	}
}
?>
