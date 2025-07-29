<?php
class Front_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function fetchPage($id) {
        $this->db->where('page_id', $this->db->escape($id));
        $this->db->where('p.status', 0);
        $this->db->join('photo q', 'q.table="pages" AND q.field_id = p.page_id', 'left outer');
        $this->db->limit(1);
        $query = $this->db->get('pages p');
        return $query->row();
    }

    public function fetchPageManyPics($id,$limits=0) {
        $this->db->select('p.*');
        $this->db->from('photo p');
        $this->db->where('p.table', 'pages');
        $this->db->where('p.field_id', $id);
        $this->db->where('pg.status', 0);
        $this->db->join('pages pg', 'pg.page_id=p.field_id');
        $this->db->order_by('p.photo_order', 'ASC');
        if ($limits != 0) {
            $this->db->limit($limits);
        }
        $q = $this->db->get();
        return $q->result();
    }

    public function insert_me($table,$data){
		$this->db->insert($table, $data); 
		return  $this->db->insert_id();
	}

    // This function is a common function to fetch data from the table. Can join the tables, can check the conditions as well.
    public function get_data_with_conditions_and_joins($main_table, $fields, $joins = array(), $conditions = array(), $limit = null, $orderBy = array()) {
        $this->db->select($fields)->from($main_table);
        if (!empty($joins)) {
            foreach ($joins as $join) {
                $this->db->join($join['table'], $join['on'], $join['type']);
            }
        }
        if (!empty($conditions)) {
            foreach ($conditions as $condition) {
                $this->db->where($condition['field'], $condition['value']);
            }
        }
        if (is_numeric($limit)) {
            $this->db->limit($limit);
        }
        if (!empty($orderBy)) {
            foreach ($orderBy as $order) {
                $this->db->order_by($order['field'], $order['order_by_type']);
            }
        }
        $query = $this->db->get();
        if ($query) {
            return ($limit === 1) ? $query->row() : $query->result();
        } else {
            return false;
        }
    }

    public function load_products($limit=null,$offset=null) {
        $this->db->select('wp.id as productId,wp.title,wp.product_uuid as uuid,wp.slug_url,wp.product_desc,CONCAT_WS("-std.", wp.thum_image, wp.extension) as image');
        $this->db->from('web_products wp');
        $this->db->where('wp.status', 1);
        if($limit != null) {
            $this->db->limit($limit,$offset);
        }
        $q = $this->db->get();
        $main = $q->result();
        foreach ($main as $row) {
            $_fields = array('wpp.*');
            $_condition = array(
                array('field' => 'wpp.web_product_id', 'value' => $row->productId),
            );
            $row->features = $this->get_data_with_conditions_and_joins('web_products_point wpp',$_fields,[],$_condition,3);
        }
        return $main;
    }

    public function load_works($limit=null,$offset=null) {
        $this->db->select('ww.id as workId,ww.title,ww.link,pt.pt_name,CONCAT_WS("-std.", ww.image, ww.extension) as image');
        $this->db->from('web_works ww');
        $this->db->where('ww.status', 1);
        $this->db->join('product_type pt', 'pt.pt_id=ww.work_type', 'left outer');
        if($limit != null) {
            $this->db->limit($limit,$offset);
        }
        $this->db->order_by('ww.id', 'RANDOM');
        $q = $this->db->get();
        return $q->result();
    }

    public function getAll($table) {
        $this->db->select('*');
        $this->db->from($table);
        $q = $this->db->get();
        return $q->result();
    }


    // =========================================================================
}