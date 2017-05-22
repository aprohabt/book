<?php
class Format_model extends CI_Model {

	var $id   	= '';
	var $nom   	= '';
	var $userID	= '';
	
	function Format_model()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get(){
    	$sql = "SELECT id, nom, del FROM format  ";
    	
    	$sql .= (!empty($_POST['del']))? 	"WHERE del = ".$_POST['del']:"WHERE del = FALSE"; // par défaut del = false
    	$sql .= (!empty($_POST['id']))? 	" AND id = ".$_POST['id'] :"";
    	$sql .= (!empty($_POST['nom']))?	" AND nom LIKE '".addslashes($_POST['nom'])."%'":"";
    	$sql .=	" AND format.userID = ".$this->session->userdata('userID');
		$sql .= " ORDER BY nom, id ";

    	return $this->db->query($sql)->result();
		
    	
    }
	
    function getSelect(){
    	$sql = "SELECT id, nom FROM format  WHERE del = FALSE AND userID = ".$this->session->userdata('userID');
    	
    	$sql .= " ORDER BY nom";
    	
    	$query = $this->db->query($sql);
		$return = array();
		$res = $query->result_array();
		$return[null]="Tous les Formats";
    	foreach ($res as $key => $value) {
			$return[$value['id']]=$value['nom'];
		}

    	return $return;
    }
    function get_last_ten_entries()
    {
        $query = $this->db->query('SELECT id, nom FROM format WHERE del != true AND userID = '.$this->session->userdata('userID').' ORDER BY id DESC LIMIT 10');
        return $query->result();
    }
    
    function set_del($id)
    {
        $query = $this->db->query("UPDATE `format` SET `del` = 1 WHERE `id` =$id ");
	}


    function insert_entry()
    {
        $this->nom   	=	$_POST['nom'];
        $this->userID 	=	$this->session->userdata('userID');
        
        return  $this->db->insert('format', $this);
    }

    function update_entry()
    {
        $this->id   	= $_POST['id'];
        $this->nom   	= $_POST['nom'];
        $this->userID 	=	$this->session->userdata('userID');
        $this->del		= false;        
        
        $this->db->update('format', $this, array('id' => $_POST['id']));
		
		return $this;
    }
    
	function get_count(){
		
		$result = $this->db->query("SELECT count(id) as ids FROM format WHERE `del` = 0 AND userID = ".$this->session->userdata('userID'));
		$count = $result->result();
		
		return $count[0]->ids;
	}
	
	function query($query){
		//die($query);
		return $this->db->query($query)->result();
	}
}