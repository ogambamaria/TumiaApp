<?php
class Login extends CI_Controller{
  public function index(){
    if(isset($_POST['log'])){
      $this->form_validation->set_rules('username','Username','required');
      $this->form_validation->set_rules('password','Password','required');
      if($this->form_validation->run() == TRUE){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $this->load->model('Login_Model');
        if($this->Login_Model->login($username,$password)){
          $newdata = array('username' => $username);
          $this->session->set_userdata($newdata);
          $type = $this->Login_Model->gettype($username,$password);
          if($type == "User"){
            redirect("../request","refresh");
          }else if($type == "Rider"){
            redirect("../Rider","refresh");
          }else if($type == "Admin"){
            redirect("../Admin","refresh");
          }else{
            $this->session->set_flashdata('error','The Account Details you entered seem to have an issue. Please Contact an administrator');
          }

        }else{
          $this->session->set_flashdata('error','The Account Details you entered do not exist');
        }
      }
    }
    $this->load->view('login');
  }
}
 ?>
