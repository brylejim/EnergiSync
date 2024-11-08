<?php
class Login_api_model extends CI_Model {

        public function __construct() {
                parent::__construct();

                $this->esync_dev = $this->load->database('default', TRUE);

        }

        public function validate_creds($args) {

                $email = $args['email'];
                $password = $args['password'];
                $custom_salt = "STIThesis2024";

                $hash = sha1(sha1($email.$custom_salt).$password);

                $wc_args['email'] = $email;
                $wc_args['hash'] = $hash;

                $qry_result = $this->esync_dev
                ->select('email, accountno')
                ->from('webusers')
                ->where($wc_args)
                ->get()
                ->result_array();
                
                if (!count($qry_result)) {
                        $errors['response'] = 401;
                        $errors['message'] = 'Username or Password is incorrect.';
                } else {
                        $result['response'] = 200;
                        $result['details'] = $qry_result;
                }

                return $result;

        }

}