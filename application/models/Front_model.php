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

    public function get_category_by_slug($slug) {
        return $this->db->get_where('categories', ['seo_url' => $slug])->row(); // assuming `seo_url` is slug
    }
    
    public function count_products_by_category($cate_id, $sortType = null) {
        $this->db->from('products p');
        $this->db->where('p.cate_id', $cate_id);
        $this->db->where('p.status', 0);
    
        if ($sortType == 'popularity') {
            $this->db->join('product_attr_val pav', 'pav.pro_id = p.pro_id', 'left');
            $this->db->where('pav.av_id', 1);
        }
    
        return $this->db->count_all_results();
    }
    
    public function get_filtered_products($cate_id, $sortType = null, $limit = null, $offset = null, $currentId = null) {
        $this->db->select('p.pro_id AS id, p.name, p.price, p.slug_url as product_url,p.quantity as qty');
        $this->db->from('products p');
        $this->db->where('p.cate_id', $cate_id);
        $this->db->where('p.status', 0);

        if ($currentId != null ) {
            $this->db->where('p.pro_id !=', $currentId);
        }
    
        // Handle popularity filter
        if ($sortType === 'popularity') {
            $this->db->join('product_attr_val pav', 'pav.pro_id = p.pro_id AND pav.av_id = 1');
        }
    
        // Handle sorting
        switch ($sortType) {
            case 'price':
                $this->db->order_by('p.price', 'asc');
                break;
            case 'price-desc':
                $this->db->order_by('p.price', 'desc');
                break;
            case 'date':
                $this->db->order_by('p.added_date', 'desc');
                break;
            case 'related_products':
                $this->db->order_by('p.pro_id', 'RANDOM');
                break;
            default:
                $this->db->order_by('p.pro_id', 'desc');
                break;
        }
    
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
    
        $main = $this->db->get()->result();
    
        foreach ($main as $row) {
            $product_condition = [
                ['field' => 'table', 'value' => 'products'],
                ['field' => 'field_id', 'value' => $row->id],
            ];
            $row->images = $this->get_data_with_conditions_and_joins('photo', ['photo_path', 'extension'], [], $product_condition, 2);
        }
    
        return $main;
    }

    public function product_detail($slug) {
        $this->db->select('p.pro_id AS id, p.name, p.price, p.slug_url as product_url,p.quantity as qty,p.description,p.short_description,p.ingredients,p.how_to_use,p.how_to_use,p.cate_id,c.category_second_title as cate_short_name,c.seo_url as cate_url');
        $this->db->from('products p');
        $this->db->where('p.slug_url', trim($slug));
        $this->db->join('categories c', 'c.cate_id=p.cate_id', 'left');
        $this->db->limit(1);
        $q = $this->db->get();
        $main = false;
        if ($q->num_rows() == 1) {
            $main = $q->row();

            // product images
            $product_condition = [
                ['field' => 'table', 'value' => 'products'],
                ['field' => 'field_id', 'value' => $main->id],
            ];
            $main->images =  $this->get_data_with_conditions_and_joins('photo', ['photo_path', 'extension'], [], $product_condition);

            // discount list
            $discount_fields = array('pd.min_item_count','dl.discount_value','dl.discount_type');
            $discount_joins = array(
              array('table' => 'discount_list dl', 'on' => 'dl.id=pd.discount_id', 'type' => 'left'),
            );
            $discount_conditions = array(
              array('field' => 'pd.product_id', 'value' => $main->id),
            );
           
            $main->discountList = $this->get_data_with_conditions_and_joins('product_discount pd',$discount_fields,$discount_joins,$discount_conditions);
        }
        return $main;
    }

    public function getAll($table) {
        $this->db->select('*');
        $this->db->from($table);
        $q = $this->db->get();
        return $q->result();
    }


    // =========================================================================
}