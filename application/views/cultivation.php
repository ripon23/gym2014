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
//document.getElementById(field_name).style.background = '#F30701'; // Reg	
document.getElementById(field_name).style.background = '#FFFF00'; // Reg
window.onbeforeunload = 'You will lose data changes.';
//alert(field_name.substring(0,5));
//fieldvalue=document.getElementById(field_name).value;
}

function colorchange1(field_name){
//document.getElementById(field_name).style.background = '#F30701'; // Reg	

window.onbeforeunload = 'You will lose data changes.';
//alert(field_name.substring(0,5));
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
	var matches = /^(0?[1-9]|1[0-2])\-(0?[1-9]|[12][0-9]|3[01])$/.exec(date);  //03-20
    if (!matches) 
	return false;
	else
	return true;   
}

function originalcolor(field_name){
document.getElementById(field_name).style.background = '#f3f3f3'; // Reg	
window.onbeforeunload = null;
//alert(field_name);
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
                    <option value="<?php echo $season1->seasonid; ?>"<?php if ($season1->current_season == 1) echo ' selected="selected"'; ?>>
                        <?php echo $season1->season_name; ?>
                    </option>
                    <?php endforeach; ?>        	
                </select></td>
            <td> <select name="district" id="district" class="input-small"> 
                <option value="">--Select--</option>          	
                    <?php foreach ($district as $district1) : ?>
                    <option value="<?php echo $district1->l_id; ?>">
                        <?php echo $district1->l_name; ?>
                    </option>
                    <?php endforeach; ?>        	
                </select></td>
            <td>
                <select name="upazila" id="upazila" class="input-small"> 
                <option value="">--Select--</option>          				
                </select></td>
            <td>
                <select name="union" id="union" class="input-small"> 
                <option value="">--Select--</option>          				
                </select></td>
            <td> 
                <select name="area" id="area" class="input-small"> 
                <option value="">--Select--</option>          				
                </select></td>
            <td>
                <select name="group" id="group" class="input-small"> 
                <option value="">--Select--</option>          				
                </select></td>
          </tr>
          <tr class="warning"> 
            <td>Name</td>
            <td>Farmer ID</td>
            <td>Mobile</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="success">
            <td><input type="text" name="sfname" id="sfname" class="input-medium"/></td>
            <td><input type="text" name="suserid" id="suserid" class="input-small"/></td>
            <td> <input type="text" name="smobile" id="smobile" class="input-small"/></td>
            <td colspan="3"> <input type="submit" name="submit" value="<?=lang('mainmenu_viewfarmer')?>" class="btn-small btn-primary" /></td>
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
            <th>Area(Group)</th>
            <th colspan="9" align="center" class="col2">Cultivation</th>
            <th colspan="9" align="center" class="col1">Used Pesticide Serial </th>
            <th rowspan="3" valign="middle">Save</th>
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
          
         
        </table>           

        
      </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>