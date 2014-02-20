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
	
	var season = $("#season2").val();
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
	
	
});// END document.ready

function disable_two_and_three()
{
		 document.getElementById('season1').disabled=false;
		 
		 document.getElementById('season2').disabled=true;
		 document.getElementById('district').disabled=true;
		 document.getElementById('upazila').disabled=true;
		 document.getElementById('union').disabled=true;
		 document.getElementById('area').disabled=true;
		 document.getElementById('group').disabled=true;
		 document.getElementById('farmer_id_list').disabled=true;
		 //document.getElementById('allf').style.display="none";
		 //document.getElementById('selu').style.display="none";		 		 	
}

function disable_one_and_three()
{
		 document.getElementById('season1').disabled=true;
		 document.getElementById('farmer_id_list').disabled=true;
		 
		 document.getElementById('season2').disabled=false;
		 document.getElementById('district').disabled=false;
		 document.getElementById('upazila').disabled=false;
		 document.getElementById('union').disabled=false;
		 document.getElementById('area').disabled=false;
		 document.getElementById('group').disabled=false;
}

function disable_one_and_two()
{		 
		 document.getElementById('farmer_id_list').disabled=false;
		 
		 document.getElementById('season1').disabled=true;
		 document.getElementById('season2').disabled=true;
		 document.getElementById('district').disabled=true;
		 document.getElementById('upazila').disabled=true;
		 document.getElementById('union').disabled=true;
		 document.getElementById('area').disabled=true;
		 document.getElementById('group').disabled=true;
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
        
		<?php echo form_open('messages/message_sent') ?>
        <h4>Compose Message</h4>
       	<table class="table table-bordered">
          <tr class="error">
            <td>To:</td>
            <td>            
            
            <div class="form-inline">
            <input name="all_farmer_of" type="radio" value="1" id="all_farmer_of"   onchange="disable_two_and_three()" />
        	<label>All farmer of season</label> 
            <select name="season1" id="season1" class="input-medium" disabled>         	
                    <?php foreach ($season as $season1) : ?>
                    <option value="<?php echo $season1->seasonid; ?>" <?php if ($season1->current_season == 1) echo ' selected="selected"';?>> 
                        <?php echo $season1->season_name; ?>
                    </option>
                    <?php endforeach; ?>        	
            </select>
            </div>
            
            <div class="form-inline">
            <input name="all_farmer_of" type="radio" value="2" id="all_farmer_of"  onchange="disable_one_and_three()" />
        	<label>All farmer of season</label>
        	<select name="season2" id="season2" class="input-medium" disabled>
        	  <?php foreach ($season as $season1) : ?>
        	  <option value="<?php echo $season1->seasonid; ?>" <?php if ($season1->current_season == 1) echo ' selected="selected"';?>> <?php echo $season1->season_name; ?> </option>
        	  <?php endforeach; ?>
      	  </select>
        	<label>Location</label> 
            <select name="district" id="district" class="input-small" disabled> 
                <option value="">--District--</option>          	
                <?php foreach ($district as $district1) : ?>
                <option value="<?php echo $district1->l_id; ?>">
                    <?php echo $district1->l_name; ?>
                </option>
			<?php endforeach; ?>        	
        	</select>
            
            <select name="upazila" id="upazila" class="input-small" disabled> 
        		<option value="">--Upazila--</option>          				
        	</select>
            
            <select name="union" id="union" class="input-small" disabled> 
            	<option value="">--Union--</option>          				
            </select>
         
            <select name="area" id="area" class="input-small" disabled> 
            	<option value="">--Area--</option>          				
            </select>
        
            <select name="group" id="group" class="input-small" disabled> 
            <option value="">--Group--</option>          				
            </select>
        
            </div>
            
            <div class="form-inline">
            <input name="all_farmer_of" type="radio" value="3" id="all_farmer_of" checked="checked" onchange="disable_one_and_two()" />
        	<label>Farmers ID</label>
            <input type="text" name="farmer_id_list" id="farmer_id_list" placeholder="Farmers id with comma(,) ex:100001,100002,200001 " class="input-xxlarge" />
            </div>
                        
            </td>
          </tr>
          <tr class="warning">
            <td>Subject:</td>
            <td><input type="text" name="message_subject" id="message_subject" class="input-xxlarge" /> *</td>
          </tr>
          <tr class="success">
            <td>Message</td>
            <td><textarea rows="3" name="message_body" id="message_body" class="input-xxlarge"></textarea> *</td>
          </tr>
          <tr class="success">
            <td colspan="2"><input type="submit" name="submit" value="Send message" class="btn-small btn-primary" /></td>
          </tr>
        </table>

      	 </form>               

        
        </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>