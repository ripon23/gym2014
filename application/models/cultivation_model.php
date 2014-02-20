<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cultivation_model extends CI_Model {	
			
	
	// --------------------------------------------------------------------
	/*
	* update farmer	 (farmer/search_view_farmer)
	*/
	function update_farmer_cultivation()
	{
	$edit_user = $this->account_model->get_username_by_id($this->session->userdata('account_id'));
	
	$this->load->helper('date');		
	
	/***** We need to put NULL if the post value is blank *****/
	$base_fertilizer=$this->input->post('base_fertilizer');			$base_fertilizer  = empty($base_fertilizer) ? NULL : $base_fertilizer;
	$line_sowing=$this->input->post('line_sowing');					$line_sowing  = empty($line_sowing) ? NULL : $line_sowing;
	$interfiling_weeding=$this->input->post('interfiling_weeding');	$interfiling_weeding  = empty($interfiling_weeding) ? NULL : $interfiling_weeding;
	$flowering=$this->input->post('flowering');						$flowering  = empty($flowering) ? NULL : $flowering;
	$pod= $this->input->post('pod');								$pod  = empty($pod) ? NULL : $pod;		
	
	/********** Update tbl_growth_condition table *********************/
	$this->db->set('base_fertilizer_date', $base_fertilizer);
	$this->db->set('line_sowing_date', $line_sowing);
	$this->db->set('interfiling_weeding_date',$interfiling_weeding );
	$this->db->set('flowerring_date',$flowering );
	$this->db->set('pods_5cm_date',$pod);	
	$this->db->set('last_update', mdate('%Y-%m-%d %H:%i:%s', now()));
	$this->db->set('edit_username', $edit_user);
	$this->db->where('member_id',$this->input->post('user_id'));
	$this->db->where('season_id',$this->input->post('season_id'));
	$this->db->update('tbl_growth_condition');
	
	$harvest_date=$this->input->post('harvest_date');				$harvest_date  = empty($harvest_date) ? NULL : $harvest_date;
	$harvest_amount=$this->input->post('harvest_amount');			$harvest_amount  = empty($harvest_amount) ? NULL : $harvest_amount;
	$purchase_date=$this->input->post('purchase_date');				$purchase_date  = empty($purchase_date) ? NULL : $purchase_date;
	$purchase_amount=$this->input->post('purchase_amount');			$purchase_amount  = empty($purchase_amount) ? NULL : $purchase_amount;
	
	/********** Update  tbl_harvest_purchase table *********************/
	$this->db->set('harvest_date', $harvest_date);
	$this->db->set('harvest_amount', $harvest_amount);
	$this->db->set('purchase_date', $purchase_date);
	$this->db->set('purchase_amount', $purchase_amount);
	$this->db->set('last_update', mdate('%Y-%m-%d %H:%i:%s', now()));
	$this->db->set('edit_username', $edit_user);
	$this->db->where('member_id',$this->input->post('user_id'));
	$this->db->where('season_id',$this->input->post('season_id'));
	$this->db->update('tbl_harvest_purchase');
	
	$pesticide_1=$this->input->post('pesticide_1');					$pesticide_1  = empty($pesticide_1) ? NULL : $pesticide_1;
	$pesticide_1_amount=$this->input->post('pesticide_1_amount');	$pesticide_1_amount  = empty($pesticide_1_amount) ? NULL : $pesticide_1_amount;
	$pesticide_1_date=$this->input->post('pesticide_1_date');		$pesticide_1_date  = empty($pesticide_1_date) ? NULL : $pesticide_1_date;
	
	$pesticide_2=$this->input->post('pesticide_2');					$pesticide_2  = empty($pesticide_2) ? NULL : $pesticide_2;
	$pesticide_2_amount=$this->input->post('pesticide_2_amount');	$pesticide_2_amount  = empty($pesticide_2_amount) ? NULL : $pesticide_2_amount;
	$pesticide_2_date=$this->input->post('pesticide_2_date');		$pesticide_2_date  = empty($pesticide_2_date) ? NULL : $pesticide_2_date;
	
	$pesticide_3=$this->input->post('pesticide_3');					$pesticide_3  = empty($pesticide_3) ? NULL : $pesticide_3;
	$pesticide_3_amount=$this->input->post('pesticide_3_amount');	$pesticide_3_amount  = empty($pesticide_3_amount) ? NULL : $pesticide_3_amount;
	$pesticide_3_date=$this->input->post('pesticide_3_date');		$pesticide_3_date  = empty($pesticide_3_date) ? NULL : $pesticide_3_date;
	
	$pesticide_4=$this->input->post('pesticide_4');					$pesticide_4  = empty($pesticide_4) ? NULL : $pesticide_4;
	$pesticide_4_amount=$this->input->post('pesticide_4_amount');	$pesticide_4_amount  = empty($pesticide_4_amount) ? NULL : $pesticide_4_amount;
	$pesticide_4_date=$this->input->post('pesticide_4_date');		$pesticide_4_date  = empty($pesticide_4_date) ? NULL : $pesticide_4_date;
	
	$pesticide_5=$this->input->post('pesticide_5');					$pesticide_5  = empty($pesticide_5) ? NULL : $pesticide_5;
	$pesticide_5_amount=$this->input->post('pesticide_5_amount');	$pesticide_5_amount  = empty($pesticide_5_amount) ? NULL : $pesticide_5_amount;
	$pesticide_5_date=$this->input->post('pesticide_5_date');		$pesticide_5_date  = empty($pesticide_5_date) ? NULL : $pesticide_5_date;
	
	$pesticide_6=$this->input->post('pesticide_6');					$pesticide_6  = empty($pesticide_6) ? NULL : $pesticide_6;
	$pesticide_6_amount=$this->input->post('pesticide_6_amount');	$pesticide_6_amount  = empty($pesticide_6_amount) ? NULL : $pesticide_6_amount;
	$pesticide_6_date=$this->input->post('pesticide_6_date');		$pesticide_6_date  = empty($pesticide_6_date) ? NULL : $pesticide_6_date;
	
	$pesticide_7=$this->input->post('pesticide_7');					$pesticide_7  = empty($pesticide_7) ? NULL : $pesticide_7;
	$pesticide_7_amount=$this->input->post('pesticide_7_amount');	$pesticide_7_amount  = empty($pesticide_7_amount) ? NULL : $pesticide_7_amount;
	$pesticide_7_date=$this->input->post('pesticide_7_date');		$pesticide_7_date  = empty($pesticide_7_date) ? NULL : $pesticide_7_date;
	
	$pesticide_8=$this->input->post('pesticide_8');					$pesticide_8  = empty($pesticide_8) ? NULL : $pesticide_8;
	$pesticide_8_amount=$this->input->post('pesticide_8_amount');	$pesticide_8_amount  = empty($pesticide_8_amount) ? NULL : $pesticide_8_amount;
	$pesticide_8_date=$this->input->post('pesticide_8_date');		$pesticide_8_date  = empty($pesticide_8_date) ? NULL : $pesticide_8_date;
	
	/********** Update  tbl_pesticide_records table *********************/
	$this->db->set('pesticide_1', $pesticide_1);
	$this->db->set('pesticide_1_amount', $pesticide_1_amount);
	$this->db->set('pesticide_1_date', $pesticide_1_date);
	$this->db->set('pesticide_2', $pesticide_2);
	$this->db->set('pesticide_2_amount', $pesticide_2_amount);
	$this->db->set('pesticide_2_date', $pesticide_2_date);
	$this->db->set('pesticide_3', $pesticide_3);
	$this->db->set('pesticide_3_amount', $pesticide_3_amount);
	$this->db->set('pesticide_3_date', $pesticide_3_date);
	$this->db->set('pesticide_4', $pesticide_4);
	$this->db->set('pesticide_4_amount', $pesticide_4_amount);
	$this->db->set('pesticide_4_date', $pesticide_4_date);
	$this->db->set('pesticide_5', $pesticide_5);
	$this->db->set('pesticide_5_amount', $pesticide_5_amount);
	$this->db->set('pesticide_5_date', $pesticide_5_date);
	$this->db->set('pesticide_6', $pesticide_6);
	$this->db->set('pesticide_6_amount', $pesticide_6_amount);
	$this->db->set('pesticide_6_date', $pesticide_6_date);
	$this->db->set('pesticide_7', $pesticide_7);
	$this->db->set('pesticide_7_amount', $pesticide_7_amount);
	$this->db->set('pesticide_7_date', $pesticide_7_date);
	$this->db->set('pesticide_8', $pesticide_8);
	$this->db->set('pesticide_8_amount', $pesticide_8_amount);
	$this->db->set('pesticide_8_date', $pesticide_8_date);
	$this->db->set('last_update', mdate('%Y-%m-%d %H:%i:%s', now()));
	$this->db->set('edit_username', $edit_user);
	$this->db->where('member_id',$this->input->post('user_id'));
	$this->db->where('season_id',$this->input->post('season_id'));
	$this->db->update('tbl_pesticide_records');
	
	//return $this->db->affected_rows();	
	//return true;
	}
	
	
	

}


/* End of file account_model.php */
/* Location: ./application/account/models/cultivation_model.php */