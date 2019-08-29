<?php
class Scrapper_model extends CI_Model {
	public function __construct() {
	parent::__construct();
	}
	public function insert($data)
	{
		$this->db->select('*');
        $this->db->from('tbl_draw');
        $this->db->where('draw_date', $data['draw_date']);
        $this->db->where('draw', $data['draw']);
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count < 1){
        	$result = $this->db->insert('tbl_draw', $data);
			return $this->db->insert_id();
        }else{
        	return false;
        }
	}
	public function get_last_draw()
	{
		$this->db->select('*');
        $this->db->from('tbl_draw');
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
	}
}