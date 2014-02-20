<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Farmer_model extends CI_Model {	
	
	
	// --------------------------------------------------------------------
	/*
	* Add new farmer	
	*/
	
	function add_newfarmer()
	{		
		$this->load->helper('date');
		
		for($i=1;$i<=10;$i++)
		{
			if($this->input->post("fname_$i"))
			{
			$user_id= $this->farmer_model->generate_user_id($this->input->post('district'));
			$user_id=$this->input->post('district').$user_id;

			$fname= $this->input->post("fname_$i");
			$area= $this->input->post("area_$i");
			$group= $this->input->post("group_$i");
			$mobile= $this->input->post("mobile_$i");
			$cultivation_area= $this->input->post("cultivation_area_$i");
			
			$edit_user = $this->account_model->get_username_by_id($this->session->userdata('account_id'));			
			//echo $edit_user;
			
				
			$this->db->insert('members', array('user_id' => $user_id, 'fname' =>$fname, 'mobile' => $mobile, 'reg_date' => mdate('%Y-%m-%d %H:%i:%s', now()),'last_update' => mdate('%Y-%m-%d %H:%i:%s', now()),'edit_username' => $edit_user,'status' => 1 ));
				
			$this->db->insert('season_wise_member_info', array('user_id' => $user_id, 'season_id' => $this->input->post('season'), 'union_id' => $this->input->post('union'),'up_id' => $this->input->post('upazila'),'dt_id' => $this->input->post('district'),'member_area' => $area,'member_group' => $group,'cultivation_area_hactor' => $cultivation_area,'last_update' => mdate('%Y-%m-%d %H:%i:%s', now()),'edit_username' => $edit_user));
			
			$this->db->insert('tbl_growth_condition', array('member_id' => $user_id, 'season_id' =>$this->input->post('season')));
			
			$this->db->insert('tbl_harvest_purchase', array('member_id' => $user_id, 'season_id' =>$this->input->post('season')));
			
			$this->db->insert('tbl_pesticide_records', array('member_id' => $user_id, 'season_id' =>$this->input->post('season')));
			}
		}
		
	}
	
	// --------------------------------------------------------------------
	/*
	* update farmer	 (farmer/search_view_farmer)
	*/
	function update_farmer()
	{
	$edit_user = $this->account_model->get_username_by_id($this->session->userdata('account_id'));
	
	$this->load->helper('date');		
	
	/********** Update members table *********************/
	$this->db->set('fname', $this->input->post('fullname'));
	$this->db->set('mobile', $this->input->post('mobile'));
	$this->db->set('last_update', mdate('%Y-%m-%d %H:%i:%s', now()));
	$this->db->set('edit_username', $edit_user);
	$this->db->where('user_id',$this->input->post('user_id'));
	$this->db->update('members');
	
	/********** Update season_wise_member_info table *********************/
	$this->db->set('member_area', $this->input->post('farmer_area'));
	$this->db->set('member_group', $this->input->post('farmer_group'));
	$this->db->set('cultivation_area_hactor', $this->input->post('cultivation_area'));
	$this->db->set('last_update', mdate('%Y-%m-%d %H:%i:%s', now()));
	$this->db->set('edit_username', $edit_user);
	$this->db->where('user_id',$this->input->post('user_id'));
	$this->db->where('season_id',$this->input->post('season'));
	$this->db->update('season_wise_member_info');
	
	//return $this->db->affected_rows();	
	//return true;
	}
	
	
	// --------------------------------------------------------------------
	/*
	* update farmer	 (farmer/search_view_farmer)
	*/
	function copy_farmer()
	{
	$edit_user = $this->account_model->get_username_by_id($this->session->userdata('account_id'));
	
	$this->load->helper('date');		
	
	$user_id= $this->input->post('user_id');
	
	$district_id=$this->input->post('district_id'); // come from hidden field
	$upazila_id=$this->input->post('upazila_id');	// come from hidden field
	$union_id=$this->input->post('union_id');		// come from hidden field

	
	/********** new insert season_wise_member_info table *********************/			
	$this->db->insert('season_wise_member_info', array('user_id' => $user_id, 'season_id' => $this->input->post('new_season'), 'union_id' => $union_id,'up_id' => $upazila_id,'dt_id' => $district_id, 'member_area' => $this->input->post('farmer_area'),'member_group' => $this->input->post('farmer_group'),'cultivation_area_hactor' => $this->input->post('cultivation_area'),'last_update' => mdate('%Y-%m-%d %H:%i:%s', now()),'edit_username' => $edit_user));
	
	$this->db->insert('tbl_growth_condition', array('member_id' => $user_id, 'season_id' =>$this->input->post('new_season')));
			
	$this->db->insert('tbl_harvest_purchase', array('member_id' => $user_id, 'season_id' =>$this->input->post('new_season')));
			
	$this->db->insert('tbl_pesticide_records', array('member_id' => $user_id, 'season_id' =>$this->input->post('new_season')));
			
	return $this->db->affected_rows();	
	//return true;
	}
	
	
	// --------------------------------------------------------------------
	/*
	* update farmer	site (farmer/search_view_farmer)
	*/
	function update_farmer_site()
	{
	$edit_user = $this->account_model->get_username_by_id($this->session->userdata('account_id'));	
	$this->load->helper('date');	
	
	/********** Update season_wise_member_info table *********************/
	$this->db->set('dt_id', $this->input->post('district_id'));
	$this->db->set('up_id', $this->input->post('upazila_id'));
	$this->db->set('union_id', $this->input->post('union_id'));
	$this->db->set('last_update', mdate('%Y-%m-%d %H:%i:%s', now()));
	$this->db->set('edit_username', $edit_user);
	$this->db->set('note', "Site updated");
	$this->db->where('user_id',$this->input->post('user_id'));
	$this->db->where('season_id',$this->input->post('season'));
	$this->db->update('season_wise_member_info');
	
	return $this->db->affected_rows();
	}
	
	
	// --------------------------------------------------------------------
	/*
	* delete farmer	site (farmer/search_view_farmer)
	*/
	function delete_farmer_season_wise($userid,$season)
	{		
		$this->db->delete('season_wise_member_info', array('user_id' => $userid,'season_id' => $season));		
		$this->db->delete('tbl_growth_condition', array('member_id' => $userid,'season_id' => $season));
		$this->db->delete('tbl_harvest_purchase', array('member_id' => $userid,'season_id' => $season));
		$this->db->delete('tbl_pesticide_records', array('member_id' => $userid,'season_id' => $season));
		//$this->db->delete('members', array('user_id' => $userid));
	}
	
	function delete_farmer($userid)
	{		
		$this->db->delete('season_wise_member_info', array('user_id' => $userid));		
		$this->db->delete('tbl_growth_condition', array('member_id' => $userid));
		$this->db->delete('tbl_harvest_purchase', array('member_id' => $userid));
		$this->db->delete('tbl_pesticide_records', array('member_id' => $userid));
		$this->db->delete('members', array('user_id' => $userid));
	}
	
	
	function check_farmer_in_other_season($userid,$season)
	{
	//SELECT count(*) as  other_season_row FROM season_wise_member_info WHERE `season_id`<>2 and `user_id`=500001
	$this->db->select('count(*) as other_season_row');
	$this->db->from('season_wise_member_info');
	$this->db->where('user_id',$userid);
	$this->db->where('season_id <> ',$season);
	$result = $this->db->get();
	return $result->row()->other_season_row;	
	}
	
	function check_farmer_exists_in_other_season($userid,$season)
	{
	//SELECT count(*) as  other_season_row FROM season_wise_member_info WHERE `season_id`<>2 and `user_id`=500001
	$this->db->select('count(*) as other_season_row');
	$this->db->from('season_wise_member_info');
	$this->db->where('user_id',$userid);
	$this->db->where('season_id =',$season);
	$result = $this->db->get();
	return $result->row()->other_season_row;	
	}
	
	// --------------------------------------------------------------------
	/*
	* count farmer	 (farmer/search_view_farmer)
	*/
	function search_farmer_count($searchterm)
	{
	$result = $this->db->query($searchterm);
	return $result->num_rows();
	}
	
	
	// --------------------------------------------------------------------
	/*
	* Search farmer	 (farmer/search_view_farmer)
	*/
	function search_farmer($searchterm, $limit, $start)
	{		
	$query_string=$searchterm." LIMIT $start, $limit"; 
	//echo $query_string;
	$resultSet = $this->db->query($query_string);
	return $resultSet->result();	
	}
	
	
	// --------------------------------------------------------------------
	/*
	* Session handler
	*/	
	function searchterm_handler($searchterm)
	{
		if($searchterm)
		{
			$this->session->set_userdata('searchterm', $searchterm);
			return $searchterm;
		}
		elseif($this->session->userdata('searchterm'))
		{
			$searchterm = $this->session->userdata('searchterm');
			return $searchterm;
		}
		else
		{
			$searchterm ="";
			return $searchterm;
		}
	}
	
	// --------------------------------------------------------------------
	/*
	* Generate user id for farmer.
	*/
	function generate_user_id($district_id)
	{
		
		$query = $this->db->query("SELECT MAX(CONVERT(SUBSTRING(user_id, -4),UNSIGNED INTEGER)) as temp_id FROM  members  WHERE user_id LIKE '$district_id%' ORDER BY user_id ASC");
		
		foreach ($query->result() as $row)
		{
			$temp_user_id=$row->temp_id;			
		}		

		$temp_user_id= $temp_user_id+1;
		
		//Make 4 digit farmer id
		if(strlen($temp_user_id)==4)
		{	
		return $temp_user_id;
		}
		elseif(strlen($temp_user_id)==3)
		{
			return "0".$temp_user_id;
		}
		elseif(strlen($temp_user_id)==2)
		{
			return "00".$temp_user_id;		
		}
		else
		{
			return "000".$temp_user_id;
		}
		
		
	}
	
	// --------------------------------------------------------------------

	/**
     should be deleted
	 */
	function create($username, $email = NULL, $password = NULL)
	{
		// Create password hash using phpass
		if ($password !== NULL)
		{
			$this->load->helper('account/phpass');
			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
			$hashed_password = $hasher->HashPassword($password);
		}

		$this->load->helper('date');
		$this->db->insert('a3m_account', array('username' => $username, 'email' => $email, 'password' => isset($hashed_password) ? $hashed_password : NULL, 'createdon' => mdate('%Y-%m-%d %H:%i:%s', now())));

		return $this->db->insert_id();
	}

	// --------------------------------------------------------------------

	/**
	 should be deleted
	*/
	
	function update_username($account_id, $new_username)
	{
		$this->db->update('a3m_account', array('username' => $new_username), array('id' => $account_id));
	}


}


/* End of file account_model.php */
/* Location: ./application/account/models/farmer_model.php */