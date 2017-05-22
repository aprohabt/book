<?php
class Auteur_model extends CI_Model {

    var $id   			= '';
    var $nom  			= '';
    var $prenom   		= '';
    var $naissance   	= '';
    var $deces   		= '';
    var $del			= '';
	var $UserID 		= '';


    function Auteur_model()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get(){
    	$sql = "SELECT id, nom, prenom, naissance, deces, del, link FROM auteur WHERE  ";
    	
	$sql .= (!empty($_POST['del']))? " del = ".$_POST['del']:" del = FALSE"; // par défaut del = false
    	$sql .= (!empty($_POST['id']))? " AND id = ".$_POST['id'] :"";
    	$sql .= (!empty($_POST['nom']))? " AND nom LIKE '".addslashes($_POST['nom'])."%'":"";
    	$sql .= (!empty($_POST['prenom']))? " AND prenom LIKE '".addslashes($_POST['prenom'])."%'":"";
    	$sql .= (!empty($_POST['naissance']))? " AND naissance = ".$_POST['naissance']:"";
    	$sql .= (!empty($_POST['deces']))? " AND deces = ".$_POST['deces']:"";
    	
    	
    	$sql .= " AND auteur.userID = ". $this->session->userdata('userID') ." ORDER BY nom, prenom";
    	
    	$query = $this->db->query($sql);
    	//die(var_dump($sql));
    	return $query->result();
    }
	
	function getSelect(){
    	$sql = "SELECT id, CONCAT(nom,' ',prenom) as nom FROM auteur WHERE del = FALSE ";
    	
    	$sql .= " AND auteur.userID = ". $this->session->userdata('userID') ." ORDER BY nom";
    	
    	$query = $this->db->query($sql);
		$return = array();
		$res = $query->result_array();
    	//$return[null]="Tous les Auteurs";
    	foreach ($res as $key => $value) {
			$return[$value['id']]=$value['nom'];
		}
		
    	return $return;
    }
	
	function getByLivre($idLivre){
		$return = array();
		$in ="";
		/* SELECTED */
		$sql = "SELECT auteur_livre.auteur as id, CONCAT(nom,' ',prenom) as nom
				FROM auteur_livre
				INNER JOIN auteur ON ( auteur_livre.auteur = auteur.id )
				WHERE auteur_livre.livre =". $idLivre . "
				ORDER BY nom";
			
		$query = $this->db->query($sql);
		$res = $query->result_array();

    	//$return[null]="Tous les Auteurs";
    	$return['selected'] = array();
    	foreach ($res as $key => $value) {
			$return['selected'][$value['id']]=$value['nom'];
			$in .= $value['id'].",";
		}
		/* non SELECTED */
		
	$sql = "SELECT id, CONCAT(nom,' ',prenom) as nom FROM auteur WHERE del = FALSE AND id NOT IN ($in 0)  
		AND auteur.userID = ". $this->session->userdata('userID') ;
    	
    	$sql .= " ORDER BY nom";
    	
    	$query = $this->db->query($sql);
		$res = $query->result_array();
    	//$return[null]="Tous les Auteurs";
    	$return['unselected'] =array();
    	foreach ($res as $key => $value) {
			$return['unselected'][$value['id']]=$value['nom'];
		}
		
    	return $return;
		
		
		
	}
    
    function get_last_ten_entries()
    {
        $query = $this->db->query('SELECT id, nom, prenom, naissance, deces, link FROM auteur WHERE del != true 
        AND auteur.userID = '. $this->session->userdata('userID') .'
        ORDER BY id DESC LIMIT 10');
        return $query->result();
    }
    
    function set_del($id)
    {
        $query = $this->db->query("UPDATE `auteur` SET `del` = 1 WHERE `id` =$id ");
	}


    function insert_entry()
    {
        $this->nom   = $_POST['nom'];       
        $this->prenom   = $_POST['prenom'];       
        $this->naissance   = $_POST['naissance'];       
        $this->deces   = $_POST['deces'];
        $this->link   = $_POST['lien'];  
        $this->UserID   =  $this->session->userdata('userID');       
        return $this->db->insert('auteur', $this);
    }

    function update_entry()
    {
        $this->id   	= $_POST['id'];
        $this->nom   	= $_POST['nom'];
        $this->prenom   = $_POST['prenom'];
        $this->naissance= $_POST['naissance'];
        $this->deces   	= $_POST['deces'];
		$this->link   	= $_POST['lien'];
        $this->del		= false;
		$this->UserID   =  $this->session->userdata('userID');    
        
        $this->db->update('auteur', $this, array('id' => $_POST['id']));
		
		return $this;
    }
    
	function get_count(){
		
		$result = $this->db->query("SELECT count(id) as ids FROM auteur 
		WHERE `del` = 0
		AND auteur.userID = ". $this->session->userdata('userID') );
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
