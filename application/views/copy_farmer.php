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

</script>

</head>
<body>

<?php echo $this->load->view('header'); ?>

		
        <div class="span12">
        
       

		<?php echo form_open('farmer/farmer_copy_to_new_season') ?>
        
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
                <th>Copy Farmer</th>
            </tr>
            
             
    	</table>                

        
        </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>