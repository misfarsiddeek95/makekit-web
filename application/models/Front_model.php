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

    function update($idName,$id,$table,$data){
        $this->db->trans_start();
		$this->db->where($idName, $id);
		$this->db->update($table, $data); 
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
	}

    public function upsert($id,$arr,$table,$whereField) {
        $this->db->trans_start();

        if ($id==0) {
            $this->db->insert($table,$arr);
            $id =  $this->db->insert_id();
        }else{
            $this->db->where($whereField, $id);
            $this->db->update($table, $arr);
        }
        $this->db->trans_complete();
        return $id ; 
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
    
    public function get_filtered_products($cate_id=null, $sortType = null, $limit = null, $offset = null, $currentId = null) {
        $this->db->select('p.pro_id AS id, p.name, p.price, p.slug_url as product_url,p.quantity as qty, p.minimum_eligiblity_value');
        $this->db->from('products p');
        if($cate_id != null) {
            $this->db->where('p.cate_id', $cate_id);
        }
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

    function checkField($table,$id,$value){
		$this->db->select($id);
		$this->db->from($table);
	   	$this->db->where($id, $value);
	   	$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

    function register_external_user($user_id,$add_id,$user_array,$addr_array) {
        $this->db->trans_start();
        if ($user_id==0) {
            $this->db->insert('external_users',$user_array);
            $user_id =  $this->db->insert_id();

            $addr_array['user_id'] = $user_id;
            $this->db->insert('addresses',$addr_array);
        }else{
            $this->db->where('id', $user_id);
            $this->db->update('external_users', $user_array);

            $this->db->where('add_id', $add_id);
            $this->db->update('addresses', $addr_array);
        }
        $this->db->trans_complete();
        return $user_id; 
    }

    public function get_product_for_cart($productId,$qty) {
        $this->db->select('p.pro_id AS id, p.name, p.price, p.slug_url as product_url, p.quantity as qty, q.photo_path, q.extension');
        $this->db->from('products p');
        $this->db->where('p.pro_id', $productId);
        $this->db->join('photo q', 'q.table="products" AND q.field_id = p.pro_id', 'left outer');
        $this->db->limit(1);
        $q = $this->db->get();

        $main = false;

        if ($q->num_rows() === 1) {
            $main = $q->row();

            // Determine applicable discount based on qty
            $this->db->select('dl.discount_value, dl.discount_type, pd.min_item_count');
            $this->db->from('product_discount pd');
            $this->db->join('discount_list dl', 'dl.id = pd.discount_id', 'left');
            $this->db->where('pd.product_id', $main->id);
            $this->db->where('pd.min_item_count <=', $qty);
            $this->db->order_by('pd.min_item_count', 'DESC'); // get highest eligible min_item_count
            $this->db->limit(1); // only one matching record

            $discount = $this->db->get()->row();

            if ($discount) {
                $main->discount_value = $discount->discount_value;
                $main->discount_type = $discount->discount_type;
                $main->min_item_count = $discount->min_item_count; // optional: for reference
            } else {
                $main->discount_value = null;
                $main->discount_type = null;
            }
        }
        return $main;
    }

    /* public function questionaires($class_id, $subject_id, $student_id) {
        $this->db->select("
            q.paper_id,
            q.class_id,
            q.subject_id,
            q.no_of_attempts,
            q.paper_duration,
            q.total_marks_count,
            q.school_name as paper_title,
            q.status,
            q.created_at,
            
            -- Remaining attempts calculation
            (q.no_of_attempts - IFNULL(COUNT(DISTINCT sa.attempt_id), 0)) AS remaining_attempts,
            
            -- Correct answers count
            IFNULL(SUM(CASE WHEN san.is_correct = 1 THEN 1 ELSE 0 END), 0) AS correct_answers
        ");

        $this->db->from('question_paper_main q');

        // Join attempts for this student
        $this->db->join(
            'student_attempts sa',
            "sa.paper_id = q.paper_id AND sa.student_id = {$this->db->escape_str($student_id)}",
            'left'
        );

        // Join answers
        $this->db->join('student_answers san', 'san.attempt_id = sa.attempt_id', 'left');

        $this->db->where('q.class_id', $class_id);
        $this->db->where('q.subject_id', $subject_id);
        $this->db->where('q.status', 1);

        $this->db->group_by('q.paper_id');

        $q = $this->db->get();
        return $q->result();
    } */

    public function questionaires($class_id, $subject_id, $student_id) {
        $student_id = (int)$student_id; // safety

        // 1) Last completed attempt_id per paper for this student
        //    (If you prefer "latest by time", use MAX(end_time) approach noted below)
        $lastAttemptSub = "
            SELECT paper_id, MAX(attempt_id) AS last_attempt_id
            FROM student_attempts
            WHERE student_id = {$student_id}
            AND status = 'completed'
            GROUP BY paper_id
        ";

        // 2) Number of completed attempts per paper (for remaining attempts calc)
        $completedAttemptsSub = "
            SELECT paper_id, COUNT(*) AS completed_attempts
            FROM student_attempts
            WHERE student_id = {$student_id}
            AND status = 'completed'
            GROUP BY paper_id
        ";

        // 3) Correct answers from ONLY the last completed attempt per paper
        $correctOnLastAttemptSub = "
            SELECT sa.paper_id, COUNT(*) AS correct_answers
            FROM student_answers ans
            JOIN student_attempts sa
                ON sa.attempt_id = ans.attempt_id
            JOIN ({$lastAttemptSub}) last
                ON last.last_attempt_id = sa.attempt_id
            WHERE sa.student_id = {$student_id}
            AND ans.is_correct = 1
            GROUP BY sa.paper_id
        ";

        $this->db->select("
            q.paper_id,
            q.class_id,
            q.subject_id,
            q.no_of_attempts,
            q.paper_duration,
            q.total_marks_count,
            q.school_name AS paper_title,
            q.status,
            q.created_at,

            -- Remaining attempts: paper limit minus COMPLETED attempts
            GREATEST(q.no_of_attempts - IFNULL(comp.completed_attempts, 0), 0) AS remaining_attempts,

            -- Correct answers ONLY from the last completed attempt
            IFNULL(correct.correct_answers, 0) AS correct_answers_last_attempt
        ", false);

        $this->db->from('question_paper_main q');

        // Join completed attempts count (1 row per paper)
        $this->db->join("({$completedAttemptsSub}) comp", 'comp.paper_id = q.paper_id', 'left', false);

        // Join correct answers from last attempt (1 row per paper)
        $this->db->join("({$correctOnLastAttemptSub}) correct", 'correct.paper_id = q.paper_id', 'left', false);

        // Filters
        $this->db->where('q.class_id', $class_id);
        $this->db->where('q.subject_id', $subject_id);
        $this->db->where('q.status', 1);

        // No GROUP BY needed because each join is pre-aggregated to 1 row per paper
        $query = $this->db->get();
        return $query->result();
    }



    public function makekit_questions($paper_id) {
        $this->db->select('q.*');
        $this->db->from('question_paper_main q');
        $this->db->where('q.paper_id', $paper_id);
        $this->db->where('q.status', 1);
        $this->db->order_by('q.paper_id', 'DESC');
        $this->db->limit(1);
        $q= $this->db->get();
        $ret = false;
        if ($q->num_rows() > 0) {
            $ret = $q->row_array();
            $queIds = $this->exist_question($paper_id);
            $question_types = $this->getAll('question_type');
            foreach ($question_types as $qt) {
                if (!empty($queIds)) {
                    $ret[strtolower($qt->question_type) . '_ques_ans'] = $this->get_questions_and_answers($queIds, $qt->qt_id);
                } else {
                    $ret[strtolower($qt->question_type) . '_ques_ans'] = [];
                }
            }
        }
        return $ret;
    }

    public function exist_question($paperId=0) {
        $this->db->select('question_id');
        $this->db->from('question_paper_child');
        if ($paperId != 0) {
            $this->db->where('paper_id', $paperId);
        }
        $q = $this->db->get();
        $result = $q->result();
        return array_unique(array_column($result, 'question_id'));
    }

    public function get_questions_and_answers($queIds,$questionType) {
        if (empty($queIds)) {
            return [];  // or return false, whatever fits your logic
        }
        $this->db->select('q.que_id,q.question,q.answer_method,q.qt_id,q.has_img as queHasImg,pq.photo_path as questionImage');
        $this->db->from('questions q');
        $this->db->where_in('q.que_id', $queIds);
        $this->db->where('q.qt_id', $questionType);
        $this->db->join('photo pq','pq.table="questions" AND pq.field_id = q.que_id', 'left outer');
        $this->db->order_by('q.que_id', 'ASC');
        $q = $this->db->get();
        $main = $q->result();
        foreach ($main as $row) {
            $this->db->select('qa.qa_id,qa.answer,qa.has_img as ansHasImg,pa.photo_path as answerImage,qa.correct_answer');
            $this->db->from('question_answers qa');
            $this->db->where('qa.que_id', $row->que_id);
            $this->db->join('photo pa','pa.table="question_answers" AND pa.field_id=qa.qa_id', 'left outer');
            $this->db->order_by('qa.qa_id', 'ASC');
            $qa = $this->db->get();
            $row->answerHasImgs = array_unique(array_column($qa->result(), 'ansHasImg'));
            $row->answers = $qa->result();
        }
        return $main;
    }

    public function start_attempt($student_id, $paper_id) {
        $query = $this->db->where('student_id', $student_id)
                          ->where('paper_id', $paper_id)
                          ->where('status', 'in_progress')
                          ->limit(1)
                          ->get('student_attempts');
        if ($query->num_rows() > 0) {
            return $query->row()->attempt_id;
        }

        $attempt_count = $this->db->where('student_id', $student_id)
                                  ->where('paper_id', $paper_id)
                                  ->where('status', 'completed')
                                  ->count_all_results('student_attempts');

        $paper = $this->db->select('no_of_attempts')
                          ->where('paper_id', $paper_id)
                          ->get('question_paper_main')
                          ->row();

        if ($attempt_count >= $paper->no_of_attempts) {
            return false;
        }

        $max_attempt = $this->db->select_max('attempt_number')
                                ->where('student_id', $student_id)
                                ->where('paper_id', $paper_id)
                                ->get('student_attempts')
                                ->row()->attempt_number;

        $next_attempt_number = ($max_attempt) ? $max_attempt + 1 : 1;

        $this->db->insert('student_attempts', [
            'student_id'     => $student_id,
            'paper_id'       => $paper_id,
            'attempt_number' => $next_attempt_number
        ]);

        return $this->db->insert_id();
    }

    public function is_correct_answer($question_id, $answer_id) {
        $this->db->where('que_id', $question_id);
        $this->db->where('qa_id', $answer_id);
        $this->db->where('correct_answer', 1);
        return $this->db->count_all_results('question_answers') > 0;
    }

    public function save_answer($student_answers) {
        if (empty($student_answers)) {
            return false;
        }
    
        $attempt_id = $student_answers[0]['attempt_id']; // all have same attempt_id
        $question_ids = array_column($student_answers, 'question_id');
    
        // Get existing answers for this attempt + these questions
        $this->db->where('attempt_id', $attempt_id);
        $this->db->where_in('question_id', $question_ids);
        $existing = $this->db->get('student_answers')->result_array();
    
        $existing_map = [];
        foreach ($existing as $row) {
            $existing_map[$row['question_id']] = $row['answer_id']; // store PK
        }
    
        $to_insert = [];
        $to_update = [];
    
        foreach ($student_answers as $ans) {
            if (isset($existing_map[$ans['question_id']])) {
                // update existing
                $ans['answer_id'] = $existing_map[$ans['question_id']];
                $to_update[] = $ans;
            } else {
                // insert new
                $to_insert[] = $ans;
            }
        }
    
        // Insert new answers
        if (!empty($to_insert)) {
            $this->db->insert_batch('student_answers', $to_insert);
        }
    
        // Update existing answers
        if (!empty($to_update)) {
            $this->db->update_batch('student_answers', $to_update, 'answer_id');
        }
    
        return true;
    }

    public function get_student_summary($student_id) {
        // 1️⃣ Get total completed papers and total correct answers (last attempt only)
        $this->db->select("
            COUNT(latest.paper_id) AS total_completed,
            IFNULL(SUM(correct_answers.correct_count), 0) AS total_correct
        ");
        $this->db->from("
            (
                SELECT sa.paper_id, MAX(sa.attempt_id) AS latest_attempt_id
                FROM student_attempts sa
                WHERE sa.student_id = " . (int)$student_id . "
                  AND sa.status = 'completed'
                GROUP BY sa.paper_id
            ) AS latest
        ", NULL, FALSE);
    
        // Join to get correct answers from only the latest attempts
        $this->db->join("
            (
                SELECT sa.attempt_id, COUNT(*) AS correct_count
                FROM student_answers sa
                WHERE sa.is_correct = 1
                GROUP BY sa.attempt_id
            ) AS correct_answers
        ", 'correct_answers.attempt_id = latest.latest_attempt_id', 'left', FALSE);
    
        $summary = $this->db->get()->row_array();
    
        // 2️⃣ Remaining points from students table
        $this->db->select("
            (IFNULL(points_earned, 0) - IFNULL(points_spent, 0)) AS remaining_points
        ");
        $this->db->from('external_users');
        $this->db->where('id', $student_id);
        $points = $this->db->get()->row_array();
    
        return [
            'total_completed'   => (int)$summary['total_completed'],
            'total_correct'     => (int)$summary['total_correct'],
            'remaining_points'  => (int)$points['remaining_points']
        ];
    }    

    public function get_score_list($studentId) {
        $this->db->select('sp.*');
        $this->db->from('student_points sp');
        $this->db->where('sp.student_id', $studentId);
        $this->db->where('sp.attempt_id = (
            SELECT MAX(attempt_id)
            FROM student_points
            WHERE student_id = ' . $this->db->escape_str($studentId) . '
              AND paper_id = sp.paper_id
        )', null, false);
        $q = $this->db->get();
        return $q->result();
    }

    public function get_total_score($studentId) {
        $this->db->select('SUM(points) as total_points');
        $this->db->from('student_points sp');
        $this->db->where('sp.student_id', $studentId);
        $this->db->where('sp.attempt_id = (
            SELECT MAX(attempt_id)
            FROM student_points
            WHERE student_id = ' . $this->db->escape_str($studentId) . '
              AND paper_id = sp.paper_id
        )', null, false);
    
        $row = $this->db->get()->row();
        return $row ? (int)$row->total_points : 0;
    }

    public function my_address($user_id) {
        $primary_addr = $this->fetch_single_address($user_id, 0);
        $secondary_addr = $this->fetch_single_address($user_id, 1);

        return [$primary_addr, $secondary_addr];
    }

    public function fetch_single_address($user_id, $addType) {
        $this->db->select('a.*, c.city_name, c.city_name_hebrew');
        $this->db->from('addresses a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.user_type', 2);
        $this->db->where('a.add_type', $addType);
        $this->db->join('cities c', 'c.city_id=a.city_id');
        $this->db->limit(1);
        $this->db->order_by('a.add_id', 'DESC');
        $q = $this->db->get();
        if ($q->num_rows() == 1) {
            return $q->row();
        } else {
            return false;
        }
    }

        
    // =========================================================================
}