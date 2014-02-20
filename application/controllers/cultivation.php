<?php
class Cultivation extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization','form_validation'));
		$this->load->model(array('account/account_model', 'account/ref_season_model','account/ref_location_model','account/ref_farmer_model','farmer_model','cultivation_model' ));		
		
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
		$this->load->view('cultivation', isset($data) ? $data : NULL);	
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
		

		$data['season'] = $this->ref_season_model->get_all_season();
		$data['district']=$this->ref_location_model->get_all_location_by_type('DT');
		$data['title'] = 'View Farmer Cultivation';
		
		$this->load->view('cultivation', isset($data) ? $data : NULL);	
	
	}
	
	
	
	function search_cultivation_farmer()
	{

		if($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));			
		}
		else
		{
			redirect('account/sign_in');
		}
		
		// assign posted valued
		$data['season_id']     = $this->input->post('season');
		$data['district_id']     = $this->input->post('district');
		$data['upazila_id']     = $this->input->post('upazila');
		$data['union_id']     = $this->input->post('union');
		
		$data['sfname']    = $this->input->post('sfname');
		$data['suserid']    = $this->input->post('suserid');
		$data['smobile']    = $this->input->post('smobile');
		
		$data['s_area']    = $this->input->post('area');
		$data['s_group']      = $this->input->post('group');	
				
		
		if($this->input->post("season"))
		{
		$query_string="SELECT members.fname,
       members.mobile,
       season_wise_member_info.season_id,
       season_wise_member_info.dt_id,
       season_wise_member_info.up_id,
       season_wise_member_info.union_id,
       season_wise_member_info.member_area,
       season_wise_member_info.member_group,
	   season_wise_member_info.cultivation_area_hactor,
       members.user_id,
       tbl_growth_condition.*,
       tbl_harvest_purchase.*,
       tbl_pesticide_records.*,
       tbl_growth_condition.season_id,
       tbl_harvest_purchase.season_id,
       tbl_pesticide_records.season_id
  FROM    (   (   (   season_wise_member_info season_wise_member_info
                   INNER JOIN
                      tbl_pesticide_records tbl_pesticide_records
                   ON (season_wise_member_info.season_id =
                          tbl_pesticide_records.season_id))
               RIGHT OUTER JOIN
                  members members
               ON (members.user_id = tbl_pesticide_records.member_id)
                  AND(members.user_id = season_wise_member_info.user_id))
           LEFT OUTER JOIN
              tbl_growth_condition tbl_growth_condition
           ON (members.user_id = tbl_growth_condition.member_id)
              AND(season_wise_member_info.season_id =
                     tbl_growth_condition.season_id))
       INNER JOIN
          tbl_harvest_purchase tbl_harvest_purchase
       ON (season_wise_member_info.season_id = tbl_harvest_purchase.season_id)
          AND(members.user_id = tbl_harvest_purchase.member_id)";	

		$season_id=$this->input->post("season");
		$query_string=$query_string." WHERE (season_wise_member_info.season_id = $season_id)";
	
		if($this->input->post("suserid"))	{$user_id=$this->input->post("suserid"); $query_string=$query_string." AND (members.user_id = '$user_id')";}
		
		if($this->input->post("sfname"))	{$fname=$this->input->post("sfname");	$query_string=$query_string." AND(members.fname LIKE '%$fname%')";}
		
		if($this->input->post("smobile"))	{$mobile=$this->input->post("smobile");	$query_string=$query_string." AND(members.mobile = '$mobile')";}
		
		if($this->input->post("district")){$district=$this->input->post("district");$query_string=$query_string." AND(season_wise_member_info.dt_id = $district)";}
		if($this->input->post("upazila")){$upazila=$this->input->post("upazila");$query_string=$query_string."  AND(season_wise_member_info.up_id = $upazila)";}
		if($this->input->post("union"))	{$union=$this->input->post("union");$query_string=$query_string." AND(season_wise_member_info.union_id = $union)";}
		if($this->input->post("area")){$area=$this->input->post("area");$query_string=$query_string." AND(season_wise_member_info.member_area = '$area')";}
		if($this->input->post("group")){$group=$this->input->post("group");$query_string=$query_string." AND(season_wise_member_info.member_group = '$group')";}
	
		$query_string=$query_string." ORDER BY members.user_id"; 	
		//$query_string=$query_string." LIMIT $start, $limit"; 
		
		$searchterm = $this->farmer_model->searchterm_handler($query_string);
		}
		else
		{
		$searchterm = $this->session->userdata('searchterm');
		}
		//echo "SearchTerm=".$searchterm."-----------------------<br/>";
		
		$this->load->library('pagination');
		
		$data['season'] = $this->ref_season_model->get_all_season();
		$data['district']=$this->ref_location_model->get_all_location_by_type('DT');
		$data['title'] = 'Farmer Cultivation';
		//echo print_r($this->input->post());
		
		//pagination
		$config = array();
        $config["base_url"] = base_url() . "cultivation/search_cultivation_farmer/";
        $config["total_rows"] = $this->farmer_model->search_farmer_count($searchterm);
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
		//$page = ($this->uri->segment(2))? $this->uri->segment(2) : 0;		
		
		//$data['results'] = $this->search_model->fetch_countries($config['per_page'],$page);
		//$data['links'] = $this->pagination->create_links();
		//$this->load->view('example1',$data);
		
		$data["search_farmer"] = $this->farmer_model->search_farmer($searchterm, $config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
 		$data["page"]=$page;
		//$this->load->view("pagination", $data);
		
		//$data['search_farmer']=$this->farmer_model->search_farmer();
		
		$this->load->view('search_cultivation_farmer',$data);	
	}
	
	
	function update_cultivation()
	{
		//echo print_r($this->input->post());
		$this->cultivation_model->update_farmer_cultivation();
	}
	
	
	
	function loadlocation($lid)
	{		
		$data['location']=$this->ref_location_model->get_all_child_location_by_id($lid);
		
		echo '<option value="">--All--</option>';
		foreach ($data['location'] as $location1) : 
		?>
            <option value="<?php echo $location1->l_id; ?>">
				<?php echo $location1->l_name; ?>
            </option>
		<?php endforeach; ?> 
		
	<?php	
	}
	
	
	/**** Ajax function *****/
	function loadarea_in_district_season($district_id,$season_id)
	{
		$data['area']=$this->ref_farmer_model->get_all_area_under_district_season($district_id,$season_id);
		
		echo '<option value="">--All--</option>';
		foreach ($data['area'] as $area1) : 
		?>
            <option value="<?php echo $area1->member_area; ?>">
				<?php echo $area1->member_area; ?>
            </option>
		<?php endforeach; ?> 
		
	<?php					
	}
	
	
	/**** Ajax function *****/
	function loadgroup_in_district_season($district_id,$season_id)
	{
		$data['group']=$this->ref_farmer_model->get_all_group_under_district_season($district_id,$season_id);
		
		echo '<option value="">--All--</option>';
		foreach ($data['group'] as $group1) : 
		?>
            <option value="<?php echo $group1->member_group; ?>">
				<?php echo $group1->member_group; ?>
            </option>
		<?php endforeach; ?> 
		
	<?php					
	}
	
	
}


/* End of file cultivation.php */
/* Location: ./system/application/controllers/cultivation.php */
?>