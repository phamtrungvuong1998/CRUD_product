<?php
class M_product extends CI_Model
{
    protected $_table = 'product';
    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

    public function get_list($page)
    {   
        $data = [];
        $data['total'] =  $this->db->select('id')->get('product')->num_rows();  
        $data['list'] = $this->db->select()->limit(3,$page)->order_by('id','DESC')->get('product')->result_array();

        return $data;
    }

    public function delete_product($id)
    {
        $data = [
            'id' => $id
        ];
        $this->db->delete('product', $data);
    }

    public function add_product($data)
    {
        $this->db->select()->like('code', $data['code']);
        $check = $this->db->get('product')->num_rows();
        if($check > 0){
            return json_encode([
                'result' => false
            ]);
        }else{
            $this->db->insert('product', $data);
            return json_encode([
                'result' => true
            ]);
        }
    }

    public function get_product($id)
    {
        $this->db->select()->where('id', $id);
        return $this->db->get('product')->row_array();
    }

    public function edit_product($data, $id)
    {
        $this->db->select()->like('code', $data['code']);
        $check = $this->db->get('product')->num_rows();
        if($check > 0){
            return json_encode([
                'result' => false
            ]);
        }else{
            $this->db->where('id', $id);
            $this->db->update('product', $data);
            return json_encode([
                'result' => true
            ]);
        }
    }
}
?>