<?php
	class Crud_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}
		
		function get_all($limit=null, $offset=null){
			// $query = $this->db->query("select * from buku");
			$query=$this->db->get('buku', $limit, $offset);
			return $query->result();
		}
		
		function count_all(){
			$query = $this->db->query("select * from buku");
			return $query->num_rows();
		}
		
		function get_book($id){
			$query = $this->db->query("select * from buku where id=$id");
			return $query->row();
		}
		
		function add_book($judul, $pengarang, $kategori){
			$query = $this->db->query("insert into buku (judul, pengarang, kategori) values ('$judul', '$pengarang', '$kategori')");
		}
		
		function edit_book($id, $judul, $pengarang, $kategori){
			$query = $this->db->query("update buku set judul='$judul', pengarang='$pengarang', kategori='$kategori' where id='$id'");
		}
		
		function delete_book($id){
			$query = $this->db->query("delete from buku where id='$id'");
		}
		
		//memasukkan nama file attachment ke dalam database
		function add_attachment($id, $filename){
			$query = $this->db->query("update buku set file='$filename' where id='$id'");
		}
		
		//searching pada semua field
		function get_search($q, $limit=null, $offset=null){
			$this->db->where("concat(judul, pengarang, kategori) like '%$q%'");
			$query = $this->db->get('buku', $limit, $offset);
			return $query->result();
		}

		//searching ajax
		function get_search_ajax($q){
			$this->db->where("concat(judul, pengarang, kategori) like '%$q%'");
			$query = $this->db->get('buku');
			return $query->result();
		}
		
		function count_search($q){
			$query = $this->db->query("select * from buku where concat(judul, pengarang, kategori) like '%$q%'");
			return $query->num_rows();
		}
	}