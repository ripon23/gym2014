<?php
class Summary extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization','form_validation'));
		$this->load->model(array('account/account_model', 'account/ref_season_model','account/ref_location_model','account/ref_farmer_model','account/ref_summaryreport_model','farmer_model','cultivation_model' ));		
		
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
		else
		{
			redirect('account/sign_in');
		}
		
		$data['season'] = $this->ref_season_model->get_all_season();
		$data['title'] = 'Summary report';
		$this->load->view('summary', isset($data) ? $data : NULL);	
	}
					
	
	function view()
	{

		if($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));			
		}
		else
		{
			redirect('account/sign_in');
		}
		
		$data['season_id']     = $this->input->post('season');
		$data['season'] = $this->ref_season_model->get_all_season();
		$data['region']=$this->ref_summaryreport_model->get_all_region();
		$data['title'] = 'Summary report';
		
		$this->load->view('summary_report', isset($data) ? $data : NULL);	
	
	}
					
	function ajax_view()
	{
	//echo print_r($this->input->post());	
	if($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));			
		}
		else
		{
			redirect('account/sign_in');
		}
		
		//$data['season_id']     = $this->input->post('season');
		//$data['season'] = $this->ref_season_model->get_all_season();
		//$data['region']=$this->ref_summaryreport_model->get_all_region();
		//$data['title'] = 'Summary report';
		$data['season_id']     = $this->input->post('season_id');
		$data['lid']     = $this->input->post('lid');
		$data['ltype']     = $this->input->post('ltype');
		$data['disrtict_under_region']=$this->ref_summaryreport_model->get_all_district_by_region_and_lid($this->input->post('lid'),$this->input->post('ltype'));
		
		$this->load->view('summary_report_ajax', isset($data) ? $data : NULL);
	}
	
}


/* End of file cultivation.php */
/* Location: ./system/application/controllers/cultivation.php */
?>