<?php
class Messages extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization','form_validation'));
		$this->load->model(array('account/account_model', 'account/ref_season_model','account/ref_location_model','account/ref_farmer_model','farmer_model','message_model' ));		
		
		$language = $this->session->userdata('site_lang');
		if(!$language)
		{
		$this->lang->load('general', 'english');
		$this->lang->load('mainmenu', 'english');
		}
		else
		{
		$this->lang->load('general', $language);
		$this->lang->load('mainmenu', $language);		
		}
		
	}

	function index()
	{
		maintain_ssl();

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}
		$this->load->view('message_inbox', isset($data) ? $data : NULL);	
	}

	function message_inbox()
	{
	
		if($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			if(!$this->authorization->is_permitted('view_message'))
			{
				redirect('');  // if not permitted "add_farmer" redirect to home page
			}
			
		}
		else
		{
			redirect('account/sign_in');
		}
		$data['title'] = 'Inbox';
		$this->load->view('message_inbox', isset($data) ? $data : NULL);	
	
	}
	
	function message_composer()
	{
	
		if($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			if(!$this->authorization->is_permitted('view_message'))
			{
				redirect('');  // if not permitted "add_farmer" redirect to home page
			}
			
		}
		else
		{
			redirect('account/sign_in');
		}
		$data['title'] = 'Composer';
		$data['season'] = $this->ref_season_model->get_all_season();
		$data['district']=$this->ref_location_model->get_all_location_by_type('DT');
		$this->load->view('message_compose', isset($data) ? $data : NULL);	
	
	}
	
	function message_sent()
	{
	//print_r($_POST);	
		if($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			if(!$this->authorization->is_permitted('send_message'))
			{
				redirect('');  // if not permitted "add_farmer" redirect to home page
			}
			
		}
		else
		{
			redirect('account/sign_in');
		}
	$data['title'] = 'Composer';
	$data['season'] = $this->ref_season_model->get_all_season();
	$data['district']=$this->ref_location_model->get_all_location_by_type('DT');
	
	$this->form_validation->set_rules('message_subject', 'Subject', 'required');
	$this->form_validation->set_rules('message_body', 'Message', 'required');
	
	if ($this->form_validation->run() === FALSE)
		{			
			$this->load->view('message_compose', isset($data) ? $data : NULL);		
		}
	else
		{
	
		if($this->input->post('all_farmer_of')==1)
			{
			$query_string="SELECT members.user_id      
	  FROM    members members
		   INNER JOIN
			  season_wise_member_info season_wise_member_info
		   ON (members.user_id = season_wise_member_info.user_id)";	
	
			$season_id=$this->input->post("season1");
			$query_string=$query_string." WHERE (season_wise_member_info.season_id = $season_id)";	
			//echo $query_string;
			$this->message_model->send_message($query_string);
			$data['save_success'] = 'Message sent';
			$this->load->view('message_compose', isset($data) ? $data : NULL);
			}
			
		if($this->input->post('all_farmer_of')==2)
			{
			$query_string="SELECT members.user_id      
	  FROM    members members
		   INNER JOIN
			  season_wise_member_info season_wise_member_info
		   ON (members.user_id = season_wise_member_info.user_id)";	
	
			$season_id=$this->input->post("season2");
			$query_string=$query_string." WHERE (season_wise_member_info.season_id = $season_id)";			
			
			if($this->input->post("district")){$district=$this->input->post("district");$query_string=$query_string." AND(season_wise_member_info.dt_id = $district)";}
			if($this->input->post("upazila")){$upazila=$this->input->post("upazila");$query_string=$query_string."  AND(season_wise_member_info.up_id = $upazila)";}
			if($this->input->post("union"))	{$union=$this->input->post("union");$query_string=$query_string." AND(season_wise_member_info.union_id = $union)";}
			if($this->input->post("area")){$area=$this->input->post("area");$query_string=$query_string." AND(season_wise_member_info.member_area = '$area')";}
			if($this->input->post("group")){$group=$this->input->post("group");$query_string=$query_string." AND(season_wise_member_info.member_group = '$group')";}
		
			$query_string=$query_string." ORDER BY members.user_id"; 	
			$this->message_model->send_message($query_string);
			$data['save_success'] = 'Message sent';
			$this->load->view('message_compose', isset($data) ? $data : NULL);
			}
		
		if($this->input->post('all_farmer_of')==3)
			{
				if($this->input->post('farmer_id_list')!='')
				{
					$farmer_id_list=explode(',',$this->input->post('farmer_id_list'));
					$this->message_model->send_message_id_list($farmer_id_list);
					$data['save_success'] = 'Message sent';
					$this->load->view('message_compose', isset($data) ? $data : NULL);				
				}
				else
				{
				echo "Please enter the farmer Ids";	
				}
			}
		
		} // Validation else end
	
	}
	
	function message_sentitem()
	{
	if($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
			if(!$this->authorization->is_permitted('send_message'))
			{
				redirect('');  // if not permitted "add_farmer" redirect to home page
			}
			
		}
		else
		{
			redirect('account/sign_in');
		}
	$data['title'] = 'Sent Item';
	$current_user = $this->account_model->get_username_by_id($this->session->userdata('account_id'));		
	
	if($current_user=='admin')
	$current_user='';
	
	$this->load->library('pagination');
	
	//pagination
		$config = array();
        $config["base_url"] = base_url() . "messages/message_sentitem/";
        $config["total_rows"] = $this->message_model->count_all_sent_message($current_user);
        $config["per_page"] = $this->config->item("pagination_perpage");
        //$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		//$config['anchor_class'] = 'follow_link';
		
		$choice = $config['total_rows']/$config['per_page'];
		$config['num_links'] = round($choice);
		
       	$this->pagination->initialize($config);
 		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;		
		//$data["search_farmer"] = $this->farmer_model->search_farmer($searchterm, $config["per_page"], $page);
		$data['sentitem']=$this->message_model->get_all_sent_message_bylimit($current_user,$config["per_page"], $page);	
		
		$data["links"] = $this->pagination->create_links();
 		$data["page"]=$page;
	
	$this->load->view('message_sentitem', isset($data) ? $data : NULL);
	
	}
	
	
}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
?>