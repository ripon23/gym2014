<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>

<script>
jQuery(document).ready(function(){
	
	$("#expand1").click(function()
	{
	showCol('col1');
	hideCol('col2');
	$("img.expand1").hide(); 
	$("img.collapse1").show(); 
	});
	
	$("#collapse1").click(function()
	{
	hideCol('col1');
	showCol('col2');	
	$("img.expand1").show(); 
	$("img.collapse1").hide(); 
	});
	//Expand Collaps End								
								
hideCol('col1');
$("img.expand1").show();
$("img.collapse1").hide();



	
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



function hideCol(columnClass){
$('table .'+columnClass).each(function(index) {
$(this).hide();
});

$('ul#hiddenCols').append('<li id="'+columnClass
+'"><a href="javascript:;" onclick="showCol(\''
+columnClass+'\');">Show '+columnClass+'</a></li>');
}

function showCol(columnClass){
$('table .'+columnClass).each(function(index) {
$(this).show();
});

$('li#'+columnClass).remove();
}

function colorchange(field_name){
document.getElementById(field_name).style.background = '#FFFF00'; // Reg	
 window.onbeforeunload = 'You will lose data changes.';
}

function originalcolor(field_name){
document.getElementById(field_name).style.background = '#FFFFFF'; // Reg f3f3f3	
//alert(field_name);
window.onbeforeunload = null;

}

function isValidDate(date)
{
	var matches = /^(0?[1-9]|1[0-2])\-(0?[1-9]|[12][0-9]|3[01])$/.exec(date);  //03-20
    if (!matches) 
	return false;
	else
	return true;   
}


function updateclick_id(button_id)
{
var numeric = button_id.replace('update_','');
//alert("hi "+numeric);	

var season_id = document.getElementById('season_id_'+numeric).value;
var user_id = document.getElementById('user_id_'+numeric).value;


var base_fertilizer = document.getElementById('base_fertilizer_date_'+numeric).value;
var line_sowing = document.getElementById('line_sowing_date_'+numeric).value;
var interfiling_weeding = document.getElementById('interfiling_weeding_date_'+numeric).value;
var flowering = document.getElementById('flowerring_date_'+numeric).value;
var pod = document.getElementById('pods_5cm_date_'+numeric).value;	
var harvest_date = document.getElementById('harvest_date_'+numeric).value;
var harvest_amount = document.getElementById('harvest_amount_'+numeric).value;	
var purchase_date = document.getElementById('purchase_date_'+numeric).value;
var purchase_amount = document.getElementById('purchase_amount_'+numeric).value;
	
var pesticide_1 = document.getElementById('pesticide_1_'+numeric).value;
var pesticide_2 = document.getElementById('pesticide_2_'+numeric).value;
var pesticide_3 = document.getElementById('pesticide_3_'+numeric).value;
var pesticide_4 = document.getElementById('pesticide_4_'+numeric).value;
var pesticide_5 = document.getElementById('pesticide_5_'+numeric).value;
var pesticide_6 = document.getElementById('pesticide_6_'+numeric).value;
var pesticide_7 = document.getElementById('pesticide_7_'+numeric).value;
var pesticide_8 = document.getElementById('pesticide_8_'+numeric).value;

var pesticide_1_date = document.getElementById('pesticide_1_date_'+numeric).value;
var pesticide_2_date = document.getElementById('pesticide_2_date_'+numeric).value;
var pesticide_3_date = document.getElementById('pesticide_3_date_'+numeric).value;
var pesticide_4_date = document.getElementById('pesticide_4_date_'+numeric).value;
var pesticide_5_date = document.getElementById('pesticide_5_date_'+numeric).value;
var pesticide_6_date = document.getElementById('pesticide_6_date_'+numeric).value;
var pesticide_7_date = document.getElementById('pesticide_7_date_'+numeric).value;
var pesticide_8_date = document.getElementById('pesticide_8_date_'+numeric).value;

var pesticide_1_amount = document.getElementById('pesticide_1_amount_'+numeric).value;
var pesticide_2_amount = document.getElementById('pesticide_2_amount_'+numeric).value;
var pesticide_3_amount = document.getElementById('pesticide_3_amount_'+numeric).value;
var pesticide_4_amount = document.getElementById('pesticide_4_amount_'+numeric).value;
var pesticide_5_amount = document.getElementById('pesticide_5_amount_'+numeric).value;
var pesticide_6_amount = document.getElementById('pesticide_6_amount_'+numeric).value;
var pesticide_7_amount = document.getElementById('pesticide_7_amount_'+numeric).value;
var pesticide_8_amount = document.getElementById('pesticide_8_amount_'+numeric).value;
//alert(userid_id);	
// Validation start
	
	validation_base_fertilizer=colorchange1('base_fertilizer_date_'+numeric);
	//validation_line_sowing=colorchange1(line_sowing); in line sowing we can put 0000-00-00
	validation_interfiling_weeding=colorchange1('interfiling_weeding_date_'+numeric);
	validation_flowering=colorchange1('flowerring_date_'+numeric);
	validation_pod=colorchange1('pods_5cm_date_'+numeric);
	validation_harvest_date=colorchange1('harvest_date_'+numeric);
	validation_purchase_date=colorchange1('purchase_date_'+numeric);
	
	validation_pesticide_1_date = colorchange1('pesticide_1_date_'+numeric);
	validation_pesticide_2_date = colorchange1('pesticide_2_date_'+numeric);
	validation_pesticide_3_date = colorchange1('pesticide_3_date_'+numeric);
	validation_pesticide_4_date = colorchange1('pesticide_4_date_'+numeric);
	validation_pesticide_5_date = colorchange1('pesticide_5_date_'+numeric);
	validation_pesticide_6_date = colorchange1('pesticide_6_date_'+numeric);
	validation_pesticide_7_date = colorchange1('pesticide_7_date_'+numeric);
	validation_pesticide_8_date = colorchange1('pesticide_8_date_'+numeric);
	// Validation end	
	
	if(validation_base_fertilizer==false)
	{
	alert("Invalid date in Base Fertilizer");
	return false;
	}
	else if(validation_interfiling_weeding==false)
	{
	alert("Invalid date in Interfiling/Weeding");
	return false;	
	}
	else if(validation_flowering==false)
	{
	alert("Invalid date in Flowering");
	return false;	
	}
	else if(validation_pod==false)
	{
	alert("Invalid date in Pod");
	return false;	
	}
	else if(validation_harvest_date==false)
	{
	alert("Invalid date in Harvest");
	return false;	
	}
	else if(validation_purchase_date==false)
	{
	alert("Invalid date in Purchase");
	return false;	
	}
	else if(validation_pesticide_1_date==false)
	{
	alert("Invalid date in Pesticide 1");
	return false;	
	}
	else if(validation_pesticide_2_date==false)
	{
	alert("Invalid date in Pesticide 2");
	return false;	
	}
	else if(validation_pesticide_3_date==false)
	{
	alert("Invalid date in Pesticide 3");
	return false;	
	}
	else if(validation_pesticide_4_date==false)
	{
	alert("Invalid date in Pesticide 4");
	return false;	
	}
	else if(validation_pesticide_5_date==false)
	{
	alert("Invalid date in Pesticide 5");
	return false;	
	}
	else if(validation_pesticide_6_date==false)
	{
	alert("Invalid date in Pesticide 6");
	return false;	
	}
	else if(validation_pesticide_7_date==false)
	{
	alert("Invalid date in Pesticide 7");
	return false;	
	}
	else if(validation_pesticide_8_date==false)
	{
	alert("Invalid date in Pesticide 8");
	return false;	
	}
	else
	{




var url = "cultivation/update_cultivation/"; 

    $.ajax({
           type: "POST",
           url: url,       
		   data: "user_id="+user_id+"&season_id="+season_id+"&base_fertilizer="+base_fertilizer+"&line_sowing="+line_sowing+"&interfiling_weeding="+interfiling_weeding+"&flowering="+flowering+"&pod="+pod+"&harvest_date="+harvest_date+"&harvest_amount="+harvest_amount+"&purchase_date="+purchase_date+"&purchase_amount="+purchase_amount+"&pesticide_1="+pesticide_1+"&pesticide_2="+pesticide_2+"&pesticide_3="+pesticide_3+"&pesticide_4="+pesticide_4+"&pesticide_5="+pesticide_5+"&pesticide_6="+pesticide_6+"&pesticide_7="+pesticide_7+"&pesticide_8="+pesticide_8+"&pesticide_1_date="+pesticide_1_date+"&pesticide_2_date="+pesticide_2_date+"&pesticide_3_date="+pesticide_3_date+"&pesticide_4_date="+pesticide_4_date+"&pesticide_5_date="+pesticide_5_date+"&pesticide_6_date="+pesticide_6_date+"&pesticide_7_date="+pesticide_7_date+"&pesticide_8_date="+pesticide_8_date+"&pesticide_1_amount="+pesticide_1_amount+"&pesticide_2_amount="+pesticide_2_amount+"&pesticide_3_amount="+pesticide_3_amount+"&pesticide_4_amount="+pesticide_4_amount+"&pesticide_5_amount="+pesticide_5_amount+"&pesticide_6_amount="+pesticide_6_amount+"&pesticide_7_amount="+pesticide_7_amount+"&pesticide_8_amount="+pesticide_8_amount,
           success: function(msg)
           {
               //alert(msg); // show response from the php script.
			   
			   // change backgroun color to original color after save
			  	originalcolor('base_fertilizer_date_'+numeric);
				originalcolor('line_sowing_date_'+numeric);
				originalcolor('interfiling_weeding_date_'+numeric);
				originalcolor('flowerring_date_'+numeric);
				originalcolor('pods_5cm_date_'+numeric);
				
				originalcolor('harvest_date_'+numeric);
				originalcolor('harvest_amount_'+numeric);
				originalcolor('purchase_date_'+numeric);
				originalcolor('purchase_amount_'+numeric);
				
				originalcolor('pesticide_1_'+numeric);
				originalcolor('pesticide_2_'+numeric);
				originalcolor('pesticide_3_'+numeric);
				originalcolor('pesticide_4_'+numeric);
				originalcolor('pesticide_5_'+numeric);
				originalcolor('pesticide_6_'+numeric);
				originalcolor('pesticide_7_'+numeric);
				originalcolor('pesticide_8_'+numeric);				
				
				originalcolor('pesticide_1_date_'+numeric);
				originalcolor('pesticide_2_date_'+numeric);
				originalcolor('pesticide_3_date_'+numeric);
				originalcolor('pesticide_4_date_'+numeric);
				originalcolor('pesticide_5_date_'+numeric);
				originalcolor('pesticide_6_date_'+numeric);
				originalcolor('pesticide_7_date_'+numeric);
				originalcolor('pesticide_8_date_'+numeric);
				
				originalcolor('pesticide_1_amount_'+numeric);
				originalcolor('pesticide_2_amount_'+numeric);
				originalcolor('pesticide_3_amount_'+numeric);
				originalcolor('pesticide_4_amount_'+numeric);
				originalcolor('pesticide_5_amount_'+numeric);
				originalcolor('pesticide_6_amount_'+numeric);
				originalcolor('pesticide_7_amount_'+numeric);
				originalcolor('pesticide_8_amount_'+numeric);				
			  			   
           }
         });

    return false; // avoid to execute the actual submit of the form.
	
	}// else validation



}// END updateclick_id


function colorchange1(field_name){
//window.onbeforeunload = 'You will lose data changes.';
fieldvalue=document.getElementById(field_name).value;
if(fieldvalue!="")
	{
		
		if(isValidDate(fieldvalue)==false)
		{
		document.getElementById(field_name).style.background = '#F30701'; // Reg	
		//document.getElementById(field_name).style.background = '#F30701';
		//alert("Date is not valid mm-dd");
		return false;
		}
	}
	else
	return true;
}

function isValidDate(date)
{
	//var matches = /^(0?[1-9]|1[0-2])\-(0?[1-9]|[12][0-9]|3[01])$/.exec(date);  //03-20
	var matches = /^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$/.exec(date);  //2014-03-20	
    if (!matches) 
	return false;
	else
	return true;   
}

</script>

</head>
<body>

<?php echo $this->load->view('header'); ?>
		
        <div class="span12">
               

		<?php echo form_open('cultivation/search_cultivation_farmer') ?>
        
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
            <td colspan="3"> <input type="submit" name="submit" value="<?=lang('mainmenu_viewcultivation')?>" class="btn-small btn-primary" /></td>
          </tr>
        </table>
        
        </form>

		<div class="form-inline">
       <img src="<?php echo base_url().RES_DIR; ?>/img/application_side_expand.png" alt="Expand" name="expand1"  width="16" height="16" border="0" id="expand1" class="expand1" />
       <img src="<?php echo base_url().RES_DIR; ?>/img/collapse.png" alt="Collapse" name="collapse1"  width="16" height="16" border="0" id="collapse1" class="collapse1" />
		</div>
   
        
		<br/>
       
      	<table class="table table-bordered table-striped">
          <tr>
            <th>#</th>
            <th>Farmer Name</th>
            <th>UserID</th>
            <th>Area</th>
            <th>Area(G)</th>
            <th colspan="9" align="center" class="col2">Cultivation</th>
            <th colspan="9" align="center" class="col1">Used Pesticide Serial </th>
            <?php if ($this->authorization->is_permitted('add_edit_farmer_info')) : ?> <th rowspan="3" valign="middle">Save</th> <?php endif; ?>
          </tr>
          <tr>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2">Ha</th>
            <th rowspan="2">&nbsp;</th>
            <th rowspan="2" class="col2">Base Fertilizer </th>
            <th rowspan="2" class="col2">Line Sowing</th>
            <th rowspan="2" class="col2">Interfiling / Weeding</th>
            <th rowspan="2" class="col2">Flowering</th>
            <th rowspan="2" class="col2">Pod</th>
            <th colspan="2" class="col2" rowspan="2">Harvest</th>
            <th colspan="2" class="col2" rowspan="2">Purchase</th>
            <th class="col1">...</th>
            <th class="col1">1</th>
            <th class="col1">2</th>
            <th class="col1">3</th>
            <th class="col1">4</th>
            <th class="col1">5</th>
            <th class="col1">6</th>
            <th class="col1">7</th>
            <th class="col1">8</th>
          </tr>
          <tr>
            <th class="col1">&nbsp;</th>
            <th colspan="8" align="center" class="col1"><p class="text-info"><small>1:Sobicron 2:Extara 3:Spike 4:Vertimak 5:Ecamite 6:Ripcord 7:Pyrifos 8:Chiorocel 9:Others</small></p></th>
          </tr>
          	<?php 
			$i=$page+1;
			?>
            <?php foreach ($search_farmer as $farmer) : ?>
          <tr>
            <td rowspan="3"><?=$i?></td>
            <td rowspan="3"><?=$farmer->fname?></td>
            <td rowspan="3"><?=$farmer->user_id?></td>
            <td rowspan="3"><?=$farmer->cultivation_area_hactor?></td>
            <td rowspan="3"><?php echo $farmer->member_area."(".$farmer->member_group.")";?></td>
            <td rowspan="3" class="col2"><input type="text" name="base_fertilizer_date_<?=$i?>" id="base_fertilizer_date_<?=$i?>" value="<?=$farmer->base_fertilizer_date?>" onChange="colorchange('base_fertilizer_date_<?=$i?>');" class="input-small"/></td>
            <td rowspan="3" class="col2"><input type="text" name="line_sowing_date_<?=$i?>" id="line_sowing_date_<?=$i?>" value="<?=$farmer->line_sowing_date?>" onChange="colorchange('line_sowing_date_<?=$i?>');" class="input-small"/></td>
            <td rowspan="3" class="col2"><input type="text" name="interfiling_weeding_date_<?=$i?>" id="interfiling_weeding_date_<?=$i?>" value="<?=$farmer->interfiling_weeding_date?>" onChange="colorchange('interfiling_weeding_date_<?=$i?>');" class="input-small"/></td>
            <td rowspan="3" class="col2"><input type="text" name="flowerring_date_<?=$i?>" id="flowerring_date_<?=$i?>" value="<?=$farmer->flowerring_date?>" onChange="colorchange('flowerring_date_<?=$i?>');" class="input-small"/></td>
            <td rowspan="3" class="col2"><input type="text" name="pods_5cm_date_<?=$i?>" id="pods_5cm_date_<?=$i?>" value="<?=$farmer->pods_5cm_date?>" onChange="colorchange('pods_5cm_date_<?=$i?>');" class="input-small"/></td>
            <td rowspan="2" class="col2">DT</td>
            <td rowspan="2" class="col2"><input type="text" name="harvest_date_<?=$i?>" id="harvest_date_<?=$i?>" value="<?=$farmer->harvest_date?>" onChange="colorchange('harvest_date_<?=$i?>');" class="input-small"/></td>
            <td rowspan="2" class="col2">DT</td>
            <td rowspan="2" class="col2"><input type="text" name="purchase_date_<?=$i?>" id="purchase_date_<?=$i?>" value="<?=$farmer->purchase_date?>" onChange="colorchange('purchase_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1">Num</td>
            <td class="col1"><input type="text" name="pesticide_1_<?=$i?>" id="pesticide_1_<?=$i?>" value="<?=$farmer->pesticide_1?>" onChange="colorchange('pesticide_1_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_2_<?=$i?>" id="pesticide_2_<?=$i?>" value="<?=$farmer->pesticide_2?>" onChange="colorchange('pesticide_2_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_3_<?=$i?>" id="pesticide_3_<?=$i?>" value="<?=$farmer->pesticide_3?>" onChange="colorchange('pesticide_3_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_4_<?=$i?>" id="pesticide_4_<?=$i?>" value="<?=$farmer->pesticide_4?>" onChange="colorchange('pesticide_4_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_5_<?=$i?>" id="pesticide_5_<?=$i?>" value="<?=$farmer->pesticide_5?>" onChange="colorchange('pesticide_5_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_6_<?=$i?>" id="pesticide_6_<?=$i?>" value="<?=$farmer->pesticide_6?>" onChange="colorchange('pesticide_6_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_7_<?=$i?>" id="pesticide_7_<?=$i?>" value="<?=$farmer->pesticide_7?>" onChange="colorchange('pesticide_7_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_8_<?=$i?>" id="pesticide_8_<?=$i?>" value="<?=$farmer->pesticide_8?>" onChange="colorchange('pesticide_8_<?=$i?>');" class="input-mini right"/></td>
            <?php if ($this->authorization->is_permitted('add_edit_farmer_info')) : ?> 
            <td rowspan="3">
            <input type="hidden" name="user_id_<?=$i?>" id="user_id_<?=$i?>" value="<?=$farmer->user_id?>" />
            <input type="hidden" name="season_id_<?=$i?>" id="season_id_<?=$i?>" value="<?=$season_id?>" />
            <input type="button" name="update_<?=$i?>" id="update_<?=$i?>" value="<?=lang('website_save')?>" onClick="updateclick_id(this.id)" class="btn-small btn-primary" />
            </td>
            <?php endif; ?>
          </tr>
          <tr>
            <td class="col1">Date</td>
            <td class="col1"><input type="text" name="pesticide_1_date_<?=$i?>" id="pesticide_1_date_<?=$i?>" value="<?=$farmer->pesticide_1_date?>" onChange="colorchange('pesticide_1_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1"><input type="text" name="pesticide_2_date_<?=$i?>" id="pesticide_2_date_<?=$i?>" value="<?=$farmer->pesticide_2_date?>" onChange="colorchange('pesticide_2_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1"><input type="text" name="pesticide_3_date_<?=$i?>" id="pesticide_3_date_<?=$i?>" value="<?=$farmer->pesticide_3_date?>" onChange="colorchange('pesticide_3_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1"><input type="text" name="pesticide_4_date_<?=$i?>" id="pesticide_4_date_<?=$i?>" value="<?=$farmer->pesticide_4_date?>" onChange="colorchange('pesticide_4_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1"><input type="text" name="pesticide_5_date_<?=$i?>" id="pesticide_5_date_<?=$i?>" value="<?=$farmer->pesticide_5_date?>" onChange="colorchange('pesticide_5_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1"><input type="text" name="pesticide_6_date_<?=$i?>" id="pesticide_6_date_<?=$i?>" value="<?=$farmer->pesticide_6_date?>" onChange="colorchange('pesticide_6_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1"><input type="text" name="pesticide_7_date_<?=$i?>" id="pesticide_7_date_<?=$i?>" value="<?=$farmer->pesticide_7_date?>" onChange="colorchange('pesticide_7_date_<?=$i?>');" class="input-small"/></td>
            <td class="col1"><input type="text" name="pesticide_8_date_<?=$i?>" id="pesticide_8_date_<?=$i?>" value="<?=$farmer->pesticide_8_date?>" onChange="colorchange('pesticide_8_date_<?=$i?>');" class="input-small"/></td>
          </tr>
          <tr>
            <td class="col2">KG</td>
            <td class="col2"><input type="text" name="harvest_amount_<?=$i?>" id="harvest_amount_<?=$i?>" value="<?=$farmer->harvest_amount?>" onChange="colorchange('harvest_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col2">KG</td>
            <td class="col2"><input type="text" name="purchase_amount_<?=$i?>" id="purchase_amount_<?=$i?>" value="<?=$farmer->purchase_amount?>" onChange="colorchange('purchase_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1">MI</td>
            <td class="col1"><input type="text" name="pesticide_1_amount_<?=$i?>" id="pesticide_1_amount_<?=$i?>" value="<?=$farmer->pesticide_1_amount?>" onChange="colorchange('pesticide_1_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_2_amount_<?=$i?>" id="pesticide_2_amount_<?=$i?>" value="<?=$farmer->pesticide_2_amount?>" onChange="colorchange('pesticide_2_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_3_amount_<?=$i?>" id="pesticide_3_amount_<?=$i?>" value="<?=$farmer->pesticide_3_amount?>" onChange="colorchange('pesticide_3_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_4_amount_<?=$i?>" id="pesticide_4_amount_<?=$i?>" value="<?=$farmer->pesticide_4_amount?>" onChange="colorchange('pesticide_4_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_5_amount_<?=$i?>" id="pesticide_5_amount_<?=$i?>" value="<?=$farmer->pesticide_5_amount?>" onChange="colorchange('pesticide_5_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_6_amount_<?=$i?>" id="pesticide_6_amount_<?=$i?>" value="<?=$farmer->pesticide_6_amount?>" onChange="colorchange('pesticide_6_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_7_amount_<?=$i?>" id="pesticide_7_amount_<?=$i?>" value="<?=$farmer->pesticide_7_amount?>" onChange="colorchange('pesticide_7_amount_<?=$i?>');" class="input-mini right"/></td>
            <td class="col1"><input type="text" name="pesticide_8_amount_<?=$i?>" id="pesticide_8_amount_<?=$i?>" value="<?=$farmer->pesticide_8_amount?>" onChange="colorchange('pesticide_8_amount_<?=$i?>');" class="input-mini right"/></td>
          </tr>
	        <?php 
			$i=$i+1;
			endforeach; 
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