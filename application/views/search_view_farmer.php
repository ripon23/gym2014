<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>

<script>
jQuery(document).ready(function(){
	
	<!-- Start -->
	$("#district").change(function()
	{
	var id=$(this).val();
	var dataString = 'id='+ id;	
	$.ajax
		({
			type: "POST",
			url: "farmer/loadlocation/"+id,
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#upazila").html(html);
			$('#union').removeAttr('selected').find('option:first').attr('selected', 'selected');
			}
		});
	
	var season = $("#season").val();
	var dataString = 'id='+ id+'&season='+season;	
	
	$.ajax
		({
			type: "POST",
			url: "farmer/loadarea_in_district_season/"+id+"/"+season,
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#area").html(html);			
			}
		});	
		
		
	$.ajax
		({
			type: "POST",
			url: "farmer/loadgroup_in_district_season/"+id+"/"+season,
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#group").html(html);			
			}
		});	
		
	
	});
	
	
	<!-- End -->
	
	<!-- Start -->
	$("#upazila").change(function()
	{
	var id=$(this).val();
	var dataString = 'id='+ id;	
	$.ajax
		({
			type: "POST",
			url: "farmer/loadlocation/"+id,
			data: dataString,
			cache: false,
			success: function(html)
			{
			$("#union").html(html);			
			}
		});
	
	});
	<!-- End -->
	
});


function updateclick_id(button_id)
{
var numeric = button_id.replace('update_','');
//alert("hi "+numeric);	

var season = $("#season").val();
var fullname = document.getElementById('fname_'+numeric).value;
var userid = document.getElementById('userid_'+numeric).value;
var farmer_area = document.getElementById('area_'+numeric).value;
var farmer_group = document.getElementById('group_'+numeric).value;
var mobile = document.getElementById('mobile_'+numeric).value;
var cultivation_area = document.getElementById('cultivation_area_'+numeric).value;

	if(!fullname)
	{
	alert("Name is required field");	
	return;
	}

	
	//alert("Name"+fullname+",user id"+userid+",season"+season+",farmer_area"+farmer_area+",cultivation_area"+cultivation_area+"farmer_group"+farmer_group);
	var url = "farmer/update_farmer_profile/"; 
	
    $.ajax({
           type: "POST",
           url: url,           
		   data: "user_id="+userid+"&fullname="+fullname+"&farmer_area="+farmer_area+"&farmer_group="+farmer_group+"&mobile="+mobile+"&cultivation_area="+cultivation_area+"&season="+season,
           success: function(msg)
           {
               	//alert(msg); // show response from the php script.
			   	originalcolor('fname_'+numeric);
			   	originalcolor('mobile_'+numeric);
			  	originalcolor('cultivation_area_'+numeric);
				originalcolor('group_'+numeric);
				originalcolor('area_'+numeric);
           }
         });

    return false; // avoid to execute the actual submit of the form.

}// END updateclick_id


function updatesiteclick_id(button_id)
{
var numeric = button_id.replace('site_update_','');

	//need to check site_union_show select or not
	var union_id =  $("#union").val();
	if(union_id>0) 
		{

		var season = $("#season").val();		
		var district_id = $("#district").val();
		var upazila_id = $("#upazila").val();
 								
		var userid = document.getElementById('userid_'+numeric).value;
		
		var url = "farmer/update_farmer_season_profile/"; 
		
		$.ajax({
			   type: "POST",
			   url: url,			  
			   data: "user_id="+userid+"&district_id="+district_id+"&upazila_id="+upazila_id+"&union_id="+union_id+"&season="+season,
			   success: function(msg)
			   {
				   	alert(msg); // show response from the php script.
				   	
			   }
			 });
	
		return false; // avoid to execute the actual submit of the form.
		
		}
		else
		{
		alert("Please select upto union from the top");
		return false; // avoid to execute the actual submit of the form.
		}
}// END updatesiteclick_id



function deleteclick_id(button_id)
{
	var numeric = button_id.replace('delete_','');
	var agree=confirm("Are you sure you want to delete this farmer?");
	if(agree)
	{
	var season = $("#season").val();
	var userid = document.getElementById('userid_'+numeric).value;
	//var trId= document.getElementById('row_'+numeric); // $("#row_"+numeric).html;
	var url = "farmer/delete_farmer/"; 

    $.ajax({
           type: "POST",
           url: url,           
		   data: "user_id="+userid+"&season="+season,
           success: function(msg)
           {               	
			   	//removeTableRow(button_id);
			   	$('#row_' + numeric).addClass('error');			  
				//document.getElementById('row_' + numeric).style.backgroundColor = 'red';
				$('#row_' + numeric).fadeOut(2000, function(){   				
				//$("#row_"+ numeric).remove();
				$('#row_' + numeric).removeClass('error');
				});
			alert(msg); // show response from the php script.			      	
           }
         });

    return false; // avoid to execute the actual submit of the form.
	}// END IF
	else
	{
		return false; // avoid to execute the actual submit of the form.
	}
			
}// END deleteclick_id

function colorchange(field_name){
document.getElementById(field_name).style.background = '#FFFF00'; // Reg	
 window.onbeforeunload = 'You will lose data changes.';
}

function originalcolor(field_name){
document.getElementById(field_name).style.background = '#f3f3f3'; // Reg	
//alert(field_name);
window.onbeforeunload = null;

}
</script>

</head>
<body>

<?php echo $this->load->view('header'); ?>        
		
        <div class="span12">
        
       <?php
	   if(isset($save_success))
	   {	   
	   ?>
       <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert">&times;</button>
       <h4>Success!</h4>
       <?=$save_success?>
       </div> 
       <?php
	   }
		?>
        
        <?php if(validation_errors()) 
		{
		?>
		<div class="alert alert-error">
       <button type="button" class="close" data-dismiss="alert">&times;</button>
       <h4>Error!</h4>
       <?=validation_errors()?>
       </div> 
		<?php 
		}
		?>

		<?php echo form_open('farmer/search_view_farmer') ?>
        
       <table class="table table-bordered">
        <tr class="warning">
          <td>Season</td>
          <td>District</td>
          <td>Upazila</td>
          <td>Union</td>
          <td>Area</td>
          <td>Group</td>
        </tr>
        <tr class="success">
            <td><select name="season" id="season" class="input-medium">         	
                    <?php foreach ($season as $season1) : ?>
                    <option value="<?php echo $season1->seasonid; ?>" <?php if($season_id) {if($season1->seasonid==$season_id) echo ' selected="selected"';}					else { if ($season1->current_season == 1) echo ' selected="selected"'; }?>> 
                        <?php echo $season1->season_name; ?>
                    </option>
                    <?php endforeach; ?>        	
                </select></td>
            <td><select name="district" id="district" class="input-small"> 
                <option value="">--All--</option>          	
                    <?php foreach ($district as $district1) : ?>
                    <option value="<?php echo $district1->l_id; ?>" <?php if($district_id) {if($district1->l_id==$district_id) echo ' selected="selected"';}?>>
                        <?php echo $district1->l_name; ?>
                    </option>
                    <?php endforeach; ?>        	
                </select></td>
            <td><select name="upazila" id="upazila" class="input-small"> 
                <?php 
                if($district_id)
                {
                $data['location1']=$this->ref_location_model->get_all_child_location_by_id($district_id);
                
                echo '<option value="">--All--</option>';
                foreach ($data['location1'] as $location1) : 
                ?>
                    <option value="<?php echo $location1->l_id; ?>" <?php if($upazila_id) {if($location1->l_id==$upazila_id) echo ' selected="selected"';}?>>
                        <?php echo $location1->l_name; ?>
                    </option>
                <?php endforeach; ?> 
                <?php	
                }		
                ?>                				
                </select></td>
            <td><select name="union" id="union" class="input-small"> 
                <?php 
                if($upazila_id)
                {
                $data['location2']=$this->ref_location_model->get_all_child_location_by_id($upazila_id);
                
                echo '<option value="">--All--</option>';
                foreach ($data['location2'] as $location1) : 
                ?>
                    <option value="<?php echo $location1->l_id; ?>" <?php if($union_id) {if($location1->l_id==$union_id) echo ' selected="selected"';}?>>
                        <?php echo $location1->l_name; ?>
                    </option>
                <?php endforeach; ?> 
                <?php	
                }		
                ?>        				
                </select> </td>
            <td><select name="area" id="area" class="input-small"> 
                <?php 
                if($district_id)
                {
                $data['area1']=$this->ref_farmer_model->get_all_area_under_district_season($district_id,$season_id);
                
                echo '<option value="">--All--</option>';
                foreach ($data['area1'] as $area1) : 
                ?>
                    <option value="<?php echo $area1->member_area; ?>" <?php if($s_area) {if($area1->member_area==$s_area) echo ' selected="selected"';}?>>
                        <?php echo $area1->member_area; ?>
                    </option>
                <?php endforeach; ?>
                <?php	
                }		
                ?>          				
                </select> </td>
            <td><select name="group" id="group" class="input-small"> 
                <?php 
                if($district_id)
                {
                $data['group1']=$this->ref_farmer_model->get_all_group_under_district_season($district_id,$season_id);
                
                echo '<option value="">--All--</option>';
                foreach ($data['group1'] as $group1) : 
                ?>
                    <option value="<?php echo $group1->member_group; ?>" <?php if($s_group) {if($group1->member_group==$s_group) echo ' selected="selected"';}?>>
                        <?php echo $group1->member_group; ?>
                    </option>
                <?php endforeach; ?> 
                <?php	
                }		
                ?>         				
                </select></td>
          </tr>
          <tr class="warning">
            <td>Name</td>
            <td> Farmer ID</td>
            <td>Mobile</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="success">
            <td><input type="text" name="sfname" id="sfname" value="<?php echo $sfname;?>" class="input-medium"/></td>
            <td><input type="text" name="suserid" id="suserid" value="<?php echo $suserid;?>" class="input-small"/></td>
            <td><input type="text" name="smobile" id="smobile" value="<?php echo $smobile;?>" class="input-small"/> </td>
            <td colspan="3"> <input type="submit" name="submit" value="<?=lang('mainmenu_viewfarmer')?>" class="btn-small btn-primary" /></td>
          </tr>
        </table>
        
        </form>
        
		<br/>
       
      	<table class="table table-bordered table-striped">
			<tr>
                <th>#</th>
                <th>District</th>
                <th>Upazila</th>
                <th>Union</th>
                <th>Name</th>
                <th>User Id</th>
                <th>Area</th>
                <th>Group</th>
                <th>Mobile</th>
                <th>Cultivation Area(ha)</th> 
                <?php if ($this->authorization->is_permitted('add_edit_farmer_info')) : ?> 
                <th>Update</th>  
                <th>Site Update</th> 
                <th>Delete</th>  
                <?php endif; ?>
            </tr>
            <?php 
			//if($this->input->post("season"))
			//{
			$i=$page+1;
			?>
            <?php foreach ($search_farmer as $farmer) : ?>
            <tr id="row_<?=$i?>">
				<td><?=$i?></td>
                <td><?php echo $this->ref_farmer_model->get_location_name_by_id($farmer->dt_id); //echo $farmer->dt_id;?></td>
                <td><?php echo $this->ref_farmer_model->get_location_name_by_id($farmer->up_id); //echo $farmer->up_id;?></td>
                <td><?php echo $this->ref_farmer_model->get_location_name_by_id($farmer->union_id); //echo $farmer->union_id;?></td>
                <td><input type="text" name="fname_<?=$i?>" id="fname_<?=$i?>" value="<?=$farmer->fname?>" onChange="colorchange('fname_<?=$i?>');" class="input-medium"/></td>
                <td><input type="text" name="userid_<?=$i?>" id="userid_<?=$i?>" value="<?=$farmer->user_id?>" class="input-small center" disabled/></td>
                <td><input type="text" name="area_<?=$i?>" id="area_<?=$i?>" value="<?=$farmer->member_area?>" onChange="colorchange('area_<?=$i?>');" class="input-mini center"/></td>
                <td><input type="text" name="group_<?=$i?>" id="group_<?=$i?>" value="<?=$farmer->member_group?>" onChange="colorchange('group_<?=$i?>');" class="input-mini center"/></td>
                <td><input type="text" name="mobile_<?=$i?>" id="mobile_<?=$i?>" value="<?=$farmer->mobile?>" onChange="colorchange('mobile_<?=$i?>');" class="input-small center"/></td>
                <td><input type="text" name="cultivation_area_<?=$i?>" id="cultivation_area_<?=$i?>" value="<?=$farmer->cultivation_area_hactor?>" onChange="colorchange('cultivation_area_<?=$i?>');" class="input-mini right"/></td>
                 <?php if ($this->authorization->is_permitted('add_edit_farmer_info')) : ?> 
                <td><input type="button" name="update_<?=$i?>" id="update_<?=$i?>" value="<?=lang('website_update')?>" onClick="updateclick_id(this.id)" class="btn-small btn-primary" /></td>
                <td><input type="button" name="site_update_<?=$i?>" id="site_update_<?=$i?>" value="<?=lang('website_siteupdate')?>" onClick="updatesiteclick_id(this.id)" class="btn-small btn-warning" /></td>
                <td><input type="button" name="delete_<?=$i?>" id="delete_<?=$i?>" value="<?=lang('website_delete')?>" onClick="deleteclick_id(this.id)" class="btn-small btn-danger" /></td>
                <?php endif; ?>
            </tr>
            <?php 
			$i=$i+1;
			endforeach; 
			//}
			?> 
             
    	</table>                
		<div style="text-align:left"><?php echo $links; ?></div>
        
        
        
        </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>