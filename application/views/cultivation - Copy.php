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

<div class="container">
    <div class="row">
        <div class="span12">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit" style="position: relative;">
                <div class="ribbon-wrapper-green">
                    <div class="ribbon-green">v2.0.0</div>
                </div>

                <h2><?php echo lang('website_title'); ?></h2>

                <p><?php echo lang('website_owner'); ?></p>

                <p><a class="btn btn-primary btn-large pull-right" href="http://geamweb.net/"><i class="icon-wrench icon-white"></i> Fork it &raquo;
                </a></p>
            </div>

        </div>
		
        <?php echo $this->load->view('main_nav'); ?>
        
		
        <div class="span12">
               

		<?php echo form_open('cultivation/search_view_farmer') ?>
        
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
              <tr align="left" valign="top">
                <td width="322" height="75">
                <table width="322" border="1" align="left" cellpadding="3" cellspacing="0">
              <tr align="center">
                <td width="12">#</td>
                <td width="150"><span style="text-align:center;">Farmer</span></td>
                <td width="80"><span style="text-align:center;">UserID</span></td>
                <td width="80" height="20"><span style="text-align:center;">Area</span></td>
              </tr>
              <tr align="center">
                <td rowspan="2">&nbsp;</td>
                <td rowspan="2">&nbsp;</td>
                <td rowspan="2">&nbsp;</td>
                <td height="50" rowspan="2" valign="top">Ha</td>
              <tr>  
            </table></td>
                <td width="700" class="col2"><table width="697" border="1" cellspacing="0" cellpadding="3">
                  <tr>
                    <td height="20" colspan="7" align="center" nowrap="nowrap"><span style="text-align:center;">Cultivation</span></td>
                  </tr>
                  <tr>
                    <td width="95" height="50" align="center">Base Fertilizer</td>
                    <td width="95" align="center">Line Sowing</td>
                    <td width="95" align="center"><span style="text-align:center;">Interfiling / Weeding</span></td>
                    <td width="95" align="center"><span style="text-align:center;">Flowering</span></td>
                    <td width="100" align="center"><span style="text-align:center;">Pod</span></td>
                    <td width="114" align="center"><span style="text-align:center;">Harvest</span></td>
                    <td width="118" align="center"><span style="text-align:center;">Purchase</span></td>
                  </tr>
                </table></td>
                <td width="840" class="col1" style="width:auto;" >
                <table width="802" border="1" cellspacing="0" cellpadding="3" style="float:left; display:inherit;" >
                  <tr>
                    <td height="20" colspan="9" align="center" nowrap="nowrap"><span style="text-align:center;">Used Pesticide Serial </span></td>
            
                  </tr>
                  <tr align="center">
                    <td width="50">&nbsp;</td>
                    <td width="94" height="20">1</td>
                    <td width="94">2</td>
                    <td width="94">3</td>
                    <td width="94">4</td>
                    <td width="94">5</td>
                    <td width="94">6</td>
                    <td width="94">7</td>
                    <td width="94">8</td>
                  </tr>
                  <tr>
                    <td height="20" colspan="9" align="center" valign="middle"><span style="text-align:center;"><strong>1&#65306;Sobicron&#12288;2&#65306;Extara&#12288;3&#65306;Spike&#12288;4&#65306;Vertimak 5&#65306;Ecamite&#12288;6&#65306;Ripcord&#12288;7&#65306;Pyrifos&#12288;8&#65306;Chiorocel 9:Others</strong></span></td>
                    </tr>
                  
                </table></td>
                <td width="58" align="center" valign="middle">...</td>
              </tr>
            </table><br />
            
            
            
            <!-- Starttttttttttttttttttttttttttttttt -->
            <table border="0" cellspacing="0" cellpadding="0" align="left" style="float:left;">
            
            <form name="form_new" id="form_new" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
              <tr align="left" valign="top">
                <td width="322" height="65"><table width="322" border="1" align="left" cellpadding="3" cellspacing="0">    
                  <tr align="center">
                    <td width="12">#</td>
                    <td width="152">fname</td>
                    <td width="80"><input name="userid_new" type="text" disabled="disabled" id="userid_new" value="" class="input-small"/></td>
                    <td width="78" height="78">
                    <input name="cultivation_area" type="text" disabled="disabled" id="cultivation_area" value="" class="input-small"/></td>
                  </tr>
                </table></td>
                <td width="700" class="col2"><table width="700" border="1" cellspacing="0" cellpadding="3">
            
            
                  <tr>
            
                    <td width="100" height="78" rowspan="2" align="center">
                    <input name="base_fertilizer_new" type="text" id="base_fertilizer_new" class="input-small" value="" onchange="colorchange('base_fertilizer_new');"/></td>
                    <td width="100" rowspan="2" align="center"><input name="line_sowing_new" type="text" id="line_sowing_new" class="input-small" value="" onchange="colorchange('line_sowing_new');"/></td>
                    <td width="100" rowspan="2" align="center"><input name="interfiling_weeding_new" type="text" id="interfiling_weeding_new" class="input-small" value="" onchange="colorchange('interfiling_weeding_new');"/></td>
                    <td width="100" rowspan="2" align="center"><input name="flowering_new" type="text" id="flowering_new" class="input-small" value="" onchange="colorchange('flowering_new');"/></td>
                    <td width="100" height="70" rowspan="2" align="center"><input name="pod_new" type="text" id="pod_new" class="input-small" value="" onchange="colorchange('pod_new');"/></td>
                   
                    <td width="20" align="center">DT</td>
                    <td width="80" align="center"><input name="harvest_date_new" type="text" id="harvest_date_new" value="" class="input-small" onchange="colorchange('harvest_date_new');"/></td>
                    <td width="20" align="center">DT</td>
                    <td width="80" align="center"><input name="purchase_date_new" type="text" id="purchase_date_new" value="" class="input-small" onchange="colorchange('purchase_date_new');"/></td>
                  </tr>
                  <tr>
                    <td align="center">Kg</td>
                    <td align="center"><input name="harvest_amount_new" type="text" id="harvest_amount_new" value="" class="input-small" onchange="colorchange('harvest_amount_new');"/> </td>
                    <td width="38" align="center">Kg</td>
                    <td width="39" align="center"><input name="purchase_amount_new" type="text" id="purchase_amount_new" value="" class="input-small"onchange="colorchange('purchase_amount_new');" /> </td>
                  </tr>
                </table></td>
            
                <td width="800" class="col1"><table width="802" border="1" cellspacing="0" cellpadding="3" style="float:left; display:inherit;">
                  <tr align="center">
                    <td width="48">Num</td>
                    <td width="94" height="16"><input name="pesticide_1_new" type="text" id="pesticide_1_new" value="" class="input-small" onchange="colorchange('pesticide_1_new');"/></td>
                    <td width="94"><input name="pesticide_2_new" type="text" id="pesticide_2_new" value="" class="input-small" onchange="colorchange('pesticide_2_new');"/></td>
                    <td width="94"><input name="pesticide_3_new" type="text" id="pesticide_3_new" value="" class="input-small" onchange="colorchange('pesticide_3_new');"/></td>
                    <td width="94"><input name="pesticide_4_new" type="text" id="pesticide_4_new" value="" class="input-small" onchange="colorchange('pesticide_4_new');"/></td>
                    <td width="94"><input name="pesticide_5_new" type="text" id="pesticide_5_new" value="" class="input-small" onchange="colorchange('pesticide_5_new');"/></td>
                    <td width="94"><input name="pesticide_6_new" type="text" id="pesticide_6_new" value="" class="input-small" onchange="colorchange('pesticide_6_new');"/></td>
                    <td width="94"><input name="pesticide_7_new" type="text" id="pesticide_7_new" value="" class="input-small" onchange="colorchange('pesticide_7_new');"/></td>
                    <td width="94"><input name="pesticide_8_new" type="text" id="pesticide_8_new" value="" class="input-small" onchange="colorchange('pesticide_8_new');"/></td>
                    <td width="94">&nbsp;</td>
                    </tr>
                  <tr align="center">
                    <td>Date</td>
                    <td height="16"><input name="pesticide_1_date_new" type="text" id="pesticide_1_date_new" value="" class="input-small" onchange="colorchange('pesticide_1_date_new');"/></td>
                    <td width="100"><input name="pesticide_2_date_new" type="text" id="pesticide_2_date_new" value="" class="input-small" onchange="colorchange('pesticide_2_date_new');"/></td>
                    <td width="100"><input name="pesticide_3_date_new" type="text" id="pesticide_3_date_new" value="" class="input-small" onchange="colorchange('pesticide_3_date_new');"/></td>
                    <td width="100"><input name="pesticide_4_date_new" type="text" id="pesticide_4_date_new" value="" class="input-small" onchange="colorchange('pesticide_4_date_new');"/></td>
                    <td width="100"><input name="pesticide_5_date_new" type="text" id="pesticide_5_date_new" value="" class="input-small" onchange="colorchange('pesticide_5_date_new');"/></td>
                    <td width="100"><input name="pesticide_6_date_new" type="text" id="pesticide_6_date_new" value="" class="input-small" onchange="colorchange('pesticide_6_date_new');"/></td>
                    <td width="100"><input name="pesticide_7_date_new" type="text" id="pesticide_7_date_new" value="" class="input-small" onchange="colorchange('pesticide_7_date_new');"/></td>
                    <td width="100"><input name="pesticide_8_date_new" type="text" id="pesticide_8_date_new" value="" class="input-small" onchange="colorchange('pesticide_8_date_new');"/></td>
                    <td width="100">&nbsp;</td>
                  </tr>
                  <tr align="center">
                    <td>MI</td>
                    <td height="17"><input name="pesticide_1_amount_new" type="text" id="pesticide_1_amount_new" value="" class="input-small" onchange="colorchange('pesticide_1_amount_new');"/></td>
                    <td width="100"><input name="pesticide_2_amount_new" type="text" id="pesticide_2_amount_new" value="" class="input-small" onchange="colorchange('pesticide_2_amount_new');"/></td>
                    <td width="100"><input name="pesticide_3_amount_new" type="text" id="pesticide_3_amount_new" value="" class="input-small" onchange="colorchange('pesticide_3_amount_new');"/></td>
                    <td width="100"><input name="pesticide_4_amount_new" type="text" id="pesticide_4_amount_new" value="" class="input-small" onchange="colorchange('pesticide_4_amount_new');"/></td>
                    <td width="100"><input name="pesticide_5_amount_new" type="text" id="pesticide_5_amount_new" value="" class="input-small" onchange="colorchange('pesticide_5_amount_new');"/></td>
                    <td width="100"><input name="pesticide_6_amount_new" type="text" id="pesticide_6_amount_new" value="" class="input-small" onchange="colorchange('pesticide_6_amount_new');"/></td>
                    <td width="100"><input name="pesticide_7_amount_new" type="text" id="pesticide_7_amount_new" value="" class="input-small" onchange="colorchange('pesticide_7_amount_new');"/></td>
                    <td width="100"><input name="pesticide_8_amount_new" type="text" id="pesticide_8_amount_new" value="" class="input-small" onchange="colorchange('pesticide_8_amount_new');"/></td>
                    <td width="100">&nbsp;</td>
                  </tr>
                  </table></td>
                  <td width="58" align="center" valign="middle"><input type="submit" name="update_new" id="update_new" value="Save"/></td>
              </tr>
              </form>
             
            </table>              

        
        </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>