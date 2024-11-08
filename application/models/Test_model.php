<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model {

   function __construct() {
      parent::__construct();


      //instanciate
      $this->load->model('test_model');
   }

   public function db_test_connect() {

      $db_obj =  $this->load->database('default', TRUE);

      if($db_obj->conn_id) {
         return 'Database is successfully connected';

      }

   }

   public function sample_select_qry($email) {


      $slct_qry = $this->db
      ->select('user_id, accountno, email, active, is_deactivated')
      ->from('webusers')
      ->where(array('accountno' => $email))
      ->get();

      $slct_qry_count = $slct_qry->num_rows(1);
      $slct_qry_reslt = $slct_qry->result();

      //check if query has result
      if ($slct_qry_count) {
         return $slct_qry_reslt;
      } else {
         $resultset['errorcode'] = 'ERRRESP001';
         $resultset['errormsg'] = 'accountno does not exists.';
         return $resultset;
      }

   }

   public function sample_update_qry($hash, $password_recovery_key) {


      $this->db->set('hash', $hash);
      $this->db->where(array('password_recovery_key' => $password_recovery_key));
      $rusult = $this->db->update('webusers'); // gives UPDATE mytable SET field = field+1 WHERE id = 2

      //check if query has result
      if ($rusult) {
         return "UPDATE SUCCESSFUL";
      } else {
         $resultset['errorcode'] = 'ERRDBx001';
         $resultset['errormsg'] = 'UPDATING TO DATABASE WAS UNSUCCESSFUL';
         return $resultset;
      }

   }

}