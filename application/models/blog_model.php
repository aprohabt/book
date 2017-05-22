<?php
class Blog_model extends CI_Model {

    var $id   = '';
    var $nom   = '';


    function Blog_model()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->query('SELECT id, nom FROM blog WHERE del != true LIMIT 10');
        return $query->result();
    }
    
    function set_del($id)
    {
        $query = $this->db->query("UPDATE `book_book`.`blog` SET `del` = 1 WHERE `blog`.`id` =$id ");
        //return $query->result();
    }


    function insert_entry()
    {
        $this->nom   = $_POST['nom']; // please read the below note
        
        $this->db->insert('blog', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}

?>