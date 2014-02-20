<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>

        
        <div class="offset1 span5">
            <h3> <?=lang('website_overview_title')?>
                <!--<small>customize this stuff?</small>-->
            </h3>            
            <?=lang('website_overview')?>
        </div>

        <div class="offset1 span5">
            <h3>Contact </h3>
			<h4 class="media-heading">Adddress:</h4>
<code>Grameen Yukiguni Maitake Ltd.<br/>
14 fl, Grameen Bank Bhaban<br/>
Mirpur 2, Dhaka 1216<br/>
Bangladesh</code>
<br/><br/>
<h4 class="media-heading">Contact Person:</h4>
<code>Tomoyasu Ebana<br/>
Email: info@gymlimited.com</code>
      

        </div>

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>