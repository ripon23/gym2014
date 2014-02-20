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

		<?php echo form_open('farmer/add') ?>
        
       <div class="form-inline">
        <label for="title">Season</label>
        <select name="season" id="season" class="input-medium">         	
			<?php foreach ($season as $season1) : ?>
            <option value="<?php echo $season1->seasonid; ?>"<?php if ($season1->current_season == 1) echo ' selected="selected"'; ?>>
				<?php echo $season1->season_name; ?>
            </option>
			<?php endforeach; ?>        	
        </select>
        
        <label for="title">District</label>
        <select name="district" id="district" class="input-medium"> 
        <option value="">--Select--</option>          	
			<?php foreach ($district as $district1) : ?>
            <option value="<?php echo $district1->l_id; ?>">
				<?php echo $district1->l_name; ?>
            </option>
			<?php endforeach; ?>        	
        </select>
        
        <label for="title">Upazila</label>
        <select name="upazila" id="upazila" class="input-medium"> 
        <option value="">--Select--</option>          				
        </select>
        
        <label for="title">Union</label>
        <select name="union" id="union" class="input-medium"> 
        <option value="">--Select--</option>          				
        </select>
        
        </div><!-- /end form-inline -->
		<br/>
       
      	<table class="table table-bordered table-striped">
			<tr>
                <th>#</th>
                <th>Name</th>
                <th>User Id</th>
                <th>Area</th>
                <th>Group</th>
                <th>Mobile</th>
                <th>Cultivation Area(ha)</th>            
            </tr>
            <?php 
			for($i=1;$i<=10;$i++)
			{
			?>
            <tr>
				<td><?=$i?></td>
                <td><input type="text" name="fname_<?=$i?>" id="fname_<?=$i?>" class="input-medium"/></td>
                <td><input type="text" name="userid_<?=$i?>" id="userid_<?=$i?>" class="input-small" disabled/></td>
                <td><input type="text" name="area_<?=$i?>" id="area_<?=$i?>" class="input-mini"/></td>
                <td><input type="text" name="group_<?=$i?>" id="group_<?=$i?>" class="input-mini"/></td>
                <td><input type="text" name="mobile_<?=$i?>" id="mobile_<?=$i?>" class="input-small"/></td>
                <td><input type="text" name="cultivation_area_<?=$i?>" id="cultivation_area_<?=$i?>" class="input-mini"/></td>
            </tr>
            <?php
			}
			?>
             
    	</table>
        
        <input type="submit" name="submit" value="Add Farmer" class="btn btn-primary" />
        
        </form>

        
        </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>