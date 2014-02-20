<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>

<script>
jQuery(document).ready(function(){	
	
	
});

</script>

</head>
<body>

<?php echo $this->load->view('header'); ?>

        <div class="span12">
		<h4>Sent Item</h4>
       <table class="table table-bordered table-striped">
          <tr align="left">
            <th>No</th>
            <th>From</th>
            <th>To</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date/Time</th>
            <!--<th>View</th>-->
          </tr>
          <?php
		  $i=$page+1;		  
		  foreach ($sentitem as $sentitem1) :
		  ?>
          <tr>
          	<td><?=$i?></td>
            <td><?=$sentitem1->from_user_id?></td>
            <td><?=$sentitem1->to_user_id?></td>
            <td><?=$sentitem1->title?></td>
            <td><?=$sentitem1->message?></td>
            <td><?=$sentitem1->send_time?></td>
            <!--<td><input type="button" name="view_<?=$i?>" id="view_<?=$i?>" value="<?=lang('website_view')?>" onClick="viewclick_id(this.id)" class="btn-small btn-primary" /></td>-->
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