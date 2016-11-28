<?php
class Cron_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    /**
     * @method : get_result
     * @uses : This function is used get result from the table
     * @param : @table, @condition
     * @author : KAP
     */ 
    public function get_result($table,$condition = null) {
        $this->db->select('*');
        if(!is_null($condition)){
            $this->db->where($condition);                
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    /**
     * get_auto_newsletter function
     * get auto newsletter based on cron job
     * @return void
     * @author KAP
     **/
    public function get_auto_newsletter($duration){
        $this->db->select('n.id, n.duration, n.no_of_latest_spots, country_id');
        $this->db->where('duration',$duration);
        $this->db->where('is_auto',1);
        $query = $this->db->get(TBL_NEWSLETTER_SETTINGS.' n');
        return $query->result_array();
    }

    /**
     * get_latest_spots_of_current_month function
     * get latest spots of current month
     * @return void
     * @author KAP
     **/
    public function get_latest_spots_of_current_month($numer_of_spots,$spot_ids) {
        $this->db->select("s.*,i.spot_image_name");
        $this->db->join(TBL_SPOT_IMAGES.' i','i.spot_id = s.id AND i.type = 1','LEFT');
        $this->db->where('YEAR(s.created_date)','YEAR(CURRENT_TIMESTAMP)',FALSE);
        $this->db->where('MONTH(s.created_date)','MONTH(CURRENT_TIMESTAMP)',FALSE);
        if(!empty($spot_ids)){
            $this->db->where_not_in('s.id',$spot_ids);
        }
        $this->db->where('s.status',1);
        $this->db->limit($numer_of_spots);
        $query = $this->db->get(TBL_SPOTS.' s');
        return $query->result_array();
    }

    /**
     * get_users_from_selected_country function
     * get users from selected country
     * @return void
     * @author : KAP
     **/
    public function get_users_from_selected_country($country_id){
        $this->db->select('u.*,IF(us.newsletter IS NULL OR us.newsletter = 0,0,1) AS allow_newsletter');
        if($country_id != 0){
            $this->db->where('u.country_id',$country_id);
        }
        $this->db->join(TBL_USER_SETTINGS.' us','us.user_id = u.id','LEFT');
        $this->db->where('u.email_id IS NOT NULL');
        $query = $this->db->get(TBL_USER.' u');
        return $query->result_array();
    }

    /**
     * spots_log function
     * maintain spots log based on newsletter
     * @return void
     * @author : KAP
     **/
    public function spots_log($spots,$newsletter_id){
        $this->db->query('INSERT INTO '.TBL_NEWSLETTER_SPOTS_LOG.' (spot_ids,newsletter_id) VALUES("'.$spots.'",'.$newsletter_id.') ON DUPLICATE KEY UPDATE spot_ids = concat(spot_ids,"'.$spots.'")');
    }

    /**
     * @method : insert
     * @uses : Insert user record into table
     * @param : @table = table name, @array = array of insert
     * @return : insert_id else 0
     * @author : KAP
     */
    public function insert($table,$array){
        if ($this->db->insert($table, $array)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }
}