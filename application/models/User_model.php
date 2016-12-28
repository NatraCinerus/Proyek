<?php
	class User_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function check_login($username, $password){
			$query = $this->db->query("SELECT * FROM user WHERE username = '$username' and password = '$password'");
            if( $query->num_rows() >= 1 ){
                return $query->row();
            }else{
                return false;
            }
		}
	}