<?php
$activeurl1= $this->uri->segment(1);
$activeurl= $this->uri->segment(2);
$activeurl=$activeurl1."/".$activeurl;
?>
<div class="span12">
            <div class="navbar">
            <div class="navbar-inner">
            <!--<a class="brand" href="#">Title</a>-->
            <ul class="nav">
            <li <?php echo $activeurl=='/'?' class="active"':'' ?>><a href="<?=base_url();?>"><?=lang('mainmenu_home')?></a></li>
            <?php if ($this->authentication->is_signed_in()) : ?>
            <li class="dropdown" >
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?=lang('mainmenu_managefarmer')?><b class="caret"></b></a>
	            <ul class="dropdown-menu">
                 <?php if ($this->authorization->is_permitted('add_farmer')) : ?>  
                    <li <?php echo $activeurl=='farmer/add'?' class="active"':'' ?>><a tabindex="-1" href="<?=base_url();?>farmer/add"><?=lang('mainmenu_addfarmer')?></a></li>
                 <?php endif; ?>   
                    <li><a tabindex="-1" href="<?=base_url();?>farmer/view"><?=lang('mainmenu_viewfarmer')?></a></li>
                 <?php if ($this->authorization->is_permitted('move_farmer_in_season')) : ?>  
                 	<li class="divider"></li>
                    <li><a tabindex="-1" href="<?=base_url();?>farmer/season_farmer"><?=lang('mainmenu_copyfarmer')?></a></li>
                 <?php endif; ?>   
	            </ul>
            </li>
            <li <?php echo $activeurl=='cultivation/view'?' class="active"':'' ?>><a href="<?=base_url();?>cultivation/view"><?=lang('mainmenu_cultivation')?></a></li>  
            
            <?php if ($this->authorization->is_permitted('view_message')) : ?>  
            <li class="dropdown">          
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <?=lang('mainmenu_messages')?><b class="caret"></b></a>
	            <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="<?=base_url();?>messages/message_inbox"><?=lang('mainmenu_inbox')?></a></li>
                    <?php if ($this->authorization->is_permitted('send_message')) : ?> 
                    <li><a tabindex="-1" href="<?=base_url();?>messages/message_sentitem"><?=lang('mainmenu_sentitem')?></a></li>
                    <li><a tabindex="-1" href="<?=base_url();?>messages/message_composer"><?=lang('mainmenu_compose')?></a></li>                    
            		<?php endif; ?>        
	            </ul>
            </li>
            <?php endif; ?>
            
            <?php if ($this->authorization->is_permitted('view_summary_report')) : ?>  
            <li <?php if($activeurl=='summary/') echo 'class="active"'; else if($activeurl=='summary/view') echo 'class="active"';  ?>><a href="<?=base_url();?>summary"><?=lang('mainmenu_summaryreport')?></a></li>
            <?php endif; ?>
            
            <?php else : ?>
            <li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
            <?php endif; ?>
            </ul>
            </div>
            </div>
</div>