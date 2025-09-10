<?php
class Send extends CI_Controller{
    public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
      //  $this->load->model('Send_model', '', TRUE);
	}
    
    function index(){
        // $getmail = $this->Send_model->get_mail();
        // $getname = $this->Send_model->get_name();
        // $getspeed = $this->Send_model->get_speed();
        // $getspeedlimit = $this->Send_model->get_speedlimit();
        $mulai = 1;
        if($mulai > 0){
            $this->load->library('email');
            $this->email->set_newline("\r\n");
        
            $this->email->from('rindra.yudha@gmail.com', 'Rindra');
            $this->email->to('rindra.yudha@gmail.com');
            //$this->email->cc('hadikusyanto@gmail.com');
            
            $this->email->subject('tes reminder3');
            $body	= $this->load->view('invoicing/mail_schedule_invoice.php');
            $this->email->message($body);
        
            if($this->email->send()){
                echo 'Your email was sent.';
            }
            else{
                $this->email->print_debugger();
            }
        }
    }
}