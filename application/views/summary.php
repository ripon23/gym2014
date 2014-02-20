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
        
       

		<?php echo form_open('summary/view') ?>
        
       <table class="table table-bordered">
          <tr class="warning">
            <td>Season: 
              <select name="season" id="season" class="input-medium">
                <?php foreach ($season as $season1) : ?>
                <option value="<?php echo $season1->seasonid; ?>"<?php if ($season1->current_season == 1) echo ' selected="selected"'; ?>> <?php echo $season1->season_name; ?> </option>
                <?php endforeach; ?>
              </select>
              <input type="submit" name="submit" value="<?=lang('website_show_summary_report')?>" class="btn-small btn-primary" />
              </td>
          </tr>
        </table>
        
        </form>
        
		<br/>             	                

        
        </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>