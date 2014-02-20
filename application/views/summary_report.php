<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>
<style>
.chartblock{
width:45%;
float:left;
margin-right:10px;
border:#CCC 1px solid;
padding:20px;
}
</style>

<script>
jQuery(document).ready(function(){

$(".form-submit").click(function()
    {
    $('#season-form').submit();
    //return false;
    });
	
});

function getResult(lid,ltype) 
{
//alert("lid="+lid+"ltype="+ltype);
var season_id = $("#season").val();
var url = "summary/ajax_view/"; 

    $.ajax({
           	type: "POST",
           	url: url,        
	     	data: "lid="+lid+"&ltype="+ltype+"&season_id="+season_id,
           	success: function(response)
		    {
           	$(".report_div").html(response);
           	}
         });
}

//function getResult2() 
//{
////alert("lid="+lid+"ltype="+ltype);
//var season_id = $("#season").val();
//var url = "summary/view/"; 
//
//    $.ajax({
//           	type: "POST",
//           	url: url,        
//	     	data: "season="+season_id,
//           	success: function(response)
//		    {
//           	//$("html").html(response);
//			
//           	}
//         });
//}
</script>

</head>
<body>

<?php echo $this->load->view('header'); ?>

	
        <div class="span12">
        <?php
		$total_farmer_in_a_region= array();
		$z=0;
		$global_total_farmer_number_in_region=0;
		$global_total_area_in_the_region=0;
		$global_total_baseline_fertilizer=0;
		$global_total_baseline_fertilizer_area=0;
		$global_total_line_sowing=0;
		$global_total_line_sowing_area=0;
		$global_total_non_line_sowing=0;
		$global_total_non_line_sowing_area=0;
		$global_total_interfiling_weeding=0;
		$global_total_interfiling_weeding_area=0;
		$global_total_flowering=0;
		$global_total_flowering_area=0;
		$global_total_pods_5cm=0;
		$global_total_pods_5cm_area=0;
		$global_total_harvest=0;
		$global_total_harvest_amount=0;
		$global_estimate_of_harvesting=0;
		$global_total_purchase=0;
		$global_total_purchase_amount=0;
		$global_estimate_of_harvesting=0;
		?>
       

		<?php echo form_open('summary/view') ?>
        
       <table class="table table-bordered">
          <tr class="warning">
            <td>Season: 
              
              
              <select name="season" id="season" class="input-medium">         	
                    <?php foreach ($season as $season1) : ?>
                    <option value="<?php echo $season1->seasonid; ?>" <?php if($season_id) {if($season1->seasonid==$season_id) echo ' selected="selected"';}					else { if ($season1->current_season == 1) echo ' selected="selected"'; }?>> 
                        <?php echo $season1->season_name; ?>
                    </option>
                    <?php endforeach; ?>        	
                </select>
                
              <input type="submit" name="submit" value="<?=lang('website_show_summary_report')?>" class="btn-small btn-primary" />
              </td>
          </tr>
        </table>
        
        </form>
        
        <div class="report_div">
        
        <table class="table table-bordered">
          <tr class="info">
            <td><code><a href="<?=base_url();?>summary"><?=lang('website_total')?></a></code></td>
          </tr>
        </table>
                    	                
		<table class="table table-bordered table-striped" style="font-size:11px;">
          <tr align="center">
            <td rowspan="2"><strong>Region</strong></td>
            <td rowspan="2"><strong>Total<br />
            </strong><strong>Farmers</strong></td>
            <td rowspan="2"><strong>Total<br />
            </strong><strong>Area (ha)</strong></td>
            <td colspan="2"><strong>Baseline Fertilizer</strong></td>
            <td colspan="2"><strong>Line Sowing</strong></td>
            <td colspan="2"><strong>Non Line Sowing</strong></td>
            <td colspan="2"><strong>Interfiling/Weeding</strong></td>
            <td colspan="2"><strong>Flowering</strong></td>
            <td colspan="2"><strong>Pod Development</strong></td>
            <td colspan="3"><strong>Harvest</strong></td>
            <td colspan="3"><strong>Purchase</strong></td>
          </tr>
          <tr>
            <td><strong>Farmers</strong></td>
            <td><strong>Area(ha)</strong></td>
            <td><strong>Farmers</strong></td>
            <td><strong>Area(ha)</strong></td>
            <td><strong>Farmers</strong></td>
            <td><strong>Area(ha)</strong></td>
            <td><strong>Farmers</strong></td>
            <td><strong>Area(ha)</strong></td>
            <td><strong>Farmers</strong></td>
            <td><strong>Area(ha)</strong></td>
            <td><strong>Farmers</strong></td>
            <td><strong>Area(ha)</strong></td>
            <td><strong>Farmers</strong></td>
            <td colspan="2"><strong>Quantity(kg)</strong></td>
            <td><strong>Farmers</strong></td>
            <td colspan="2"><strong>Quantity(kg)</strong></td>
          </tr>
          <?php foreach ($region as $region1) : ?> 
          <tr align="center">
            <td rowspan="2">
            <?php 
			$z=$z+1;
			$ltype=1;
			$language = $this->session->userdata('site_lang');
			if($language)
			{
				if($language=='english')
				$location_name=$region1->region_name;
				
				if($language=='bangla')
				$location_name=$region1->region_name_bn;
			}
			else
			{
			$location_name=$region1->region_name;
			}
			?>
			<?php echo '<a href="javascript:void(0)" onclick="getResult('.$region1->region_id.','.$ltype.');">'.$location_name.'</a>'; ?>			
            </td>
            <td rowspan="2">
			<?php 
			$total_farmer_number_in_region=$this->ref_summaryreport_model->total_farmer_number_in_region($region1->region_id,$season_id,$ltype);	
			echo $total_farmer_number_in_region;
			$total_farmer_in_a_region[$z]=$total_farmer_number_in_region;
			$global_total_farmer_number_in_region=$global_total_farmer_number_in_region+$total_farmer_number_in_region;	
			?>
            </td>
            <td rowspan="2">
            <?php
            $total_area_in_the_region=$this->ref_summaryreport_model->total_area_in_the_region($region1->region_id,$season_id,$ltype);
			echo round($total_area_in_the_region,2);
			$global_total_area_in_the_region=$global_total_area_in_the_region+$total_area_in_the_region;
    		?>
            </td>
            <td>
            <?php
    		$total_baseline_fertilizer= $this->ref_summaryreport_model->get_baseline_fertilizer_info($region1->region_id,$season_id,$ltype);
			echo $total_baseline_fertilizer;
			$global_total_baseline_fertilizer=$global_total_baseline_fertilizer+$total_baseline_fertilizer;
			?>
            </td>
            <td>
            <?php
			$total_baseline_fertilizer_area=$this->ref_summaryreport_model->total_baseline_fertilizer_area($region1->region_id,$season_id,$ltype);
			echo round($total_baseline_fertilizer_area,2);
			$global_total_baseline_fertilizer_area=$global_total_baseline_fertilizer_area+$total_baseline_fertilizer_area;
			?>
            </td>
            <td>
            <?php
    		$total_line_sowing= $this->ref_summaryreport_model->get_line_sowing_info($region1->region_id,$season_id,$ltype);
			echo $total_line_sowing;
			$global_total_line_sowing=$global_total_line_sowing+$total_line_sowing;
			?>
            </td>
            <td>
            <?php
			$total_line_sowing_area=$this->ref_summaryreport_model->total_line_sowing_area($region1->region_id,$season_id,$ltype);
			echo round($total_line_sowing_area,2);
			$global_total_line_sowing_area=$global_total_line_sowing_area+$total_line_sowing_area;
			?>
            </td>
            <td>
            <?php
			$total_non_line_sowing= $this->ref_summaryreport_model->get_non_line_sowing_info($region1->region_id,$season_id,$ltype);
			echo $total_non_line_sowing;
			$global_total_non_line_sowing=$global_total_non_line_sowing+$total_non_line_sowing;
			?>
            </td>
            <td>
            <?php
			$total_non_line_sowing_area=$this->ref_summaryreport_model->total_non_line_sowing_area($region1->region_id,$season_id,$ltype);
			echo round($total_non_line_sowing_area,2);
			$global_total_non_line_sowing_area=$global_total_non_line_sowing_area+$total_non_line_sowing_area;
			?>
            </td>
            <td>
            <?php
    		$total_interfiling_weeding= $this->ref_summaryreport_model->get_interfiling_weeding_info($region1->region_id,$season_id,$ltype);
			echo $total_interfiling_weeding;
			$global_total_interfiling_weeding=$global_total_interfiling_weeding+$total_interfiling_weeding;
			?>
            </td>
            <td>
            <?php
			$total_interfiling_weeding_area=$this->ref_summaryreport_model->total_interfiling_weeding_area($region1->region_id,$season_id,$ltype);
			echo round($total_interfiling_weeding_area,2);
			$global_total_interfiling_weeding_area=$global_total_interfiling_weeding_area+$total_interfiling_weeding_area;
			?>
            </td>
            <td>
            <?php
    		$total_flowering= $this->ref_summaryreport_model->get_flowering_info($region1->region_id,$season_id,$ltype);
			echo $total_flowering;
			$global_total_flowering=$global_total_flowering+$total_flowering;
			?>
            </td>
            <td>
            <?php
			$total_flowering_area=$this->ref_summaryreport_model->total_flowering_area($region1->region_id,$season_id,$ltype);
			echo round($total_flowering_area,2);
			$global_total_flowering_area=$global_total_flowering_area+$total_flowering_area;
			?>
            </td>
            <td>
            <?php
    		$total_pods_5cm= $this->ref_summaryreport_model->get_pods_5cm_info($region1->region_id,$season_id,$ltype);
			echo $total_pods_5cm;
			$global_total_pods_5cm=$global_total_pods_5cm+$total_pods_5cm;
			?>
            </td>
            <td>
            <?php
			$total_pods_5cm_area=$this->ref_summaryreport_model->total_pods_5cm_area($region1->region_id,$season_id,$ltype);
			echo round($total_pods_5cm_area,2);
			$global_total_pods_5cm_area=$global_total_pods_5cm_area+$total_pods_5cm_area;
			?>
            </td>
            <td>
            <?php
    		$total_harvest= $this->ref_summaryreport_model->get_harvest_info($region1->region_id,$season_id,$ltype);
			echo $total_harvest;
			$global_total_harvest=$global_total_harvest+$total_harvest;	
			?>
            </td>
            <td>
            <?php
			$total_harvest_amount=$this->ref_summaryreport_model->total_harvest_amount($region1->region_id,$season_id,$ltype);
			echo round($total_harvest_amount,2);
			$global_total_harvest_amount=$global_total_harvest_amount+$total_harvest_amount;
			?>&nbsp;
            </td>
            <td>
            <?php
			$estimate_of_harvesting=$total_line_sowing_area*1000;
			echo round($estimate_of_harvesting,2);
			$global_estimate_of_harvesting=$global_estimate_of_harvesting+$estimate_of_harvesting;
			?>&nbsp;
            </td>
            <td>
            <?php
			$total_purchase= $this->ref_summaryreport_model->get_purchase_info($region1->region_id,$season_id,$ltype);
			echo $total_purchase;
			$global_total_purchase=$global_total_purchase+$total_purchase;
			?>
            </td>
            <td>
            <?php
			$total_purchase_amount=$this->ref_summaryreport_model->total_purchase_amount($region1->region_id,$season_id,$ltype);
			echo round($total_purchase_amount,2);
			$global_total_purchase_amount=$global_total_purchase_amount+$total_purchase_amount;
			?>
            </td>
            <td>
            <?php
			$estimate_of_harvesting=$total_line_sowing_area*1000;
			echo round($estimate_of_harvesting,2);
			?>&nbsp;
            </td>
          </tr>
          <tr align="center">
            <td>
            <?php
			if($total_farmer_number_in_region)
			{
    		$baseline_in_persent= round((100 * $total_baseline_fertilizer)/$total_farmer_number_in_region,2);
			echo $baseline_in_persent."%";
			//$global_baseline_in_persent=$global_baseline_in_persent+$baseline_in_persent;
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_area_in_the_region)
			{
    		$baseline_in_persent_area= round((100 * $total_baseline_fertilizer_area)/$total_area_in_the_region,2);
			echo $baseline_in_persent_area."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_farmer_number_in_region)
			{
    		$linesowing_in_persent= round((100 * $total_line_sowing)/$total_farmer_number_in_region,2);
			echo $linesowing_in_persent."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_area_in_the_region)
			{
    		$linesowing_in_persent_area= round((100 * $total_line_sowing_area)/$total_area_in_the_region,2);
			echo $linesowing_in_persent_area."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_farmer_number_in_region)
			{
    		$non_linesowing_in_persent= round((100 * $total_non_line_sowing)/$total_farmer_number_in_region,2);
			echo $non_linesowing_in_persent."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_area_in_the_region)
			{
    		$non_linesowing_in_persent_area= round((100 * $total_non_line_sowing_area)/$total_area_in_the_region,2);
			echo $non_linesowing_in_persent_area."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_line_sowing)
			{
			$interfiling_weeding_in_persent= round((100 * $total_interfiling_weeding)/$total_line_sowing,2);
			echo $interfiling_weeding_in_persent."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_area_in_the_region)
			{
			$interfiling_weeding_in_persent_area= round((100 * $total_interfiling_weeding_area)/$total_area_in_the_region,2);
			echo $interfiling_weeding_in_persent_area."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_line_sowing)
			{
			$flowering_in_persent= round((100 * $total_flowering)/$total_line_sowing,2);
			echo $flowering_in_persent."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_area_in_the_region)
			{
			$flowering_in_persent_area= round((100 * $total_flowering_area)/$total_area_in_the_region,2);
			echo $flowering_in_persent_area."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
    		if($total_farmer_number_in_region)
			{
			$pods_5cm_in_persent= round((100 * $total_pods_5cm)/$total_farmer_number_in_region,2);
			echo $pods_5cm_in_persent."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_area_in_the_region)
			{
    		$pods_5cm_in_persent_area= round((100 * $total_pods_5cm_area)/$total_area_in_the_region,2);
			echo $pods_5cm_in_persent_area."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td>
            <?php
			if($total_farmer_number_in_region)
			{
    		$harvest_in_persent= round((100 * $total_harvest)/$total_farmer_number_in_region,2);
			echo $harvest_in_persent."%";
			}
			else
			echo "0%";
			?>
            </td>
            <td colspan="2">
            <?php
			if($estimate_of_harvesting)
			{
			$harvest_amount_in_persent=(100 * $total_harvest_amount)/$estimate_of_harvesting;
			echo round($harvest_amount_in_persent, 2)."%";
			}
			else
			{
			echo "0%";	
			}
			?>
            </td>
            <td>
            <?php
			if($total_farmer_number_in_region)
			{
    		$purchase_in_persent= round((100 * $total_purchase)/$total_farmer_number_in_region,2);
			echo $purchase_in_persent."%";
			}
			else
			echo "0%";	
			?>
            </td>
            <td colspan="2">
            <?php
			if($estimate_of_harvesting)
			{
			$purchase_amount_in_persent=(100 * $total_purchase_amount)/$estimate_of_harvesting;
			echo round($purchase_amount_in_persent, 2)."%";
			}
			else
			{
			echo "0%";	
			}
			?>
            </td>
          </tr>
          	<?php 
			endforeach; 			
			?>
          
          <tr align="center" class="success">
            <td rowspan="2"><strong>GRAND <br /> TOTAL</strong></td>
            <td rowspan="2"><strong><?=$global_total_farmer_number_in_region?></strong></td>
            <td rowspan="2"><strong><?=round($global_total_area_in_the_region,2)?></strong></td>
            <td><strong><?=$global_total_baseline_fertilizer?></strong></td>
            <td><strong><?=round($global_total_baseline_fertilizer_area,2)?></strong></td>
            <td><strong><?=round($global_total_line_sowing,2)?></strong></td>
            <td><strong><?=round($global_total_line_sowing_area,2)?></strong></td>
            <td><strong><?=round($global_total_non_line_sowing,2)?></strong></td>
            <td><strong><?=round($global_total_non_line_sowing_area,2)?> </strong></td>
            <td><strong><?=round($global_total_interfiling_weeding,2)?></strong></td>
            <td><strong><?=round($global_total_interfiling_weeding_area,2)?></strong></td>
            <td><strong><?=round($global_total_flowering,2)?></strong></td>
            <td><strong><?=round($global_total_flowering_area,2)?></strong></td>
            <td><strong><?=round($global_total_pods_5cm,2)?></strong></td>
            <td><strong><?=round($global_total_pods_5cm_area,2)?></strong></td>
            <td><strong><?=round($global_total_harvest,2)?></strong></td>
            <td><strong><?=round($global_total_harvest_amount,2)?></strong></td>
            <td><strong><?=round($global_estimate_of_harvesting,2)?>&nbsp;</strong></td>
            <td><strong><?=round($global_total_purchase,2)?></strong></td>
            <td><strong><?=round($global_total_purchase_amount,2)?></strong></td>
            <td><strong><?=round($global_estimate_of_harvesting,2)?></strong></td>
          </tr>
          <tr align="center">
            <td bgcolor="#DFF0D8">
            <strong>
			<?php
			if($global_total_farmer_number_in_region)
			{
			$global_total_area_in_persent= ($global_total_baseline_fertilizer*100)/$global_total_farmer_number_in_region;
			echo round($global_total_area_in_persent,2)."%";
			}
			else
			echo "0%";
			?>            
            </strong></td>
            <td bgcolor="#DFF0D8">
            <strong>
            <?php
			if($global_total_area_in_the_region)
			echo round(($global_total_baseline_fertilizer_area*100)/$global_total_area_in_the_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
			<?php
			if($global_total_farmer_number_in_region)
    		echo round(($global_total_line_sowing*100)/$global_total_farmer_number_in_region,2)."%";
			else
			echo "0%";
			?></strong>
            </td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_area_in_the_region)
			echo round(($global_total_line_sowing_area*100)/$global_total_area_in_the_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8">
            <strong>
			<?php
			if($global_total_farmer_number_in_region)
    		echo round(($global_total_non_line_sowing*100)/$global_total_farmer_number_in_region,2)."%";
			else
			echo "0%";
			?>            
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_area_in_the_region)
			echo round(($global_total_non_line_sowing_area*100)/$global_total_area_in_the_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_line_sowing) 
			echo round(($global_total_interfiling_weeding*100)/$global_total_line_sowing,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_area_in_the_region)
			echo round(($global_total_interfiling_weeding_area*100)/$global_total_area_in_the_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_line_sowing)
			echo round(($global_total_flowering*100)/$global_total_line_sowing,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_area_in_the_region)
			echo round(($global_total_flowering_area*100)/$global_total_area_in_the_region,2)."%";
			else
			echo "0%";
			?>
           </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_farmer_number_in_region)
    		echo round(($global_total_pods_5cm*100)/$global_total_farmer_number_in_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_area_in_the_region)
			echo round(($global_total_line_sowing_area*100)/$global_total_area_in_the_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_farmer_number_in_region)
    		echo round(($global_total_harvest*100)/$global_total_farmer_number_in_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td colspan="2" bgcolor="#DFF0D8"><strong>
            <?php
			if($global_estimate_of_harvesting)
			echo round(($global_total_harvest_amount*100)/$global_estimate_of_harvesting,2)."%";
			else
			echo "0%";
			?>
            &nbsp;</strong></td>
            <td bgcolor="#DFF0D8"><strong>
            <?php
			if($global_total_farmer_number_in_region)
    		echo round(($global_total_purchase*100)/$global_total_farmer_number_in_region,2)."%";
			else
			echo "0%";
			?>
            </strong></td>
            <td colspan="2" bgcolor="#DFF0D8">
            <strong>
            <?php
			if($global_estimate_of_harvesting)
			echo round(($global_total_purchase_amount*100)/$global_estimate_of_harvesting,2)."%";
			else
			echo "0%";
			?></strong></td>
          </tr>
        </table>
        <div class="row">
		<div class="offset1 span5">

        <strong>Total Farmer</strong>    
        <canvas id="cvs" width="450px" height="250px">chart1</canvas>
        
        <script>
            var pie = new RGraph.Pie('cvs', [<?=$total_farmer_in_a_region[1]?>,<?=$total_farmer_in_a_region[2]?>,<?=$total_farmer_in_a_region[3]?>,<?=$total_farmer_in_a_region[4]?>]);
            pie.Set('chart.tooltips', ['North','West','South','Coastal']);
            pie.Set('chart.labels', ['North(<?=$total_farmer_in_a_region[1]?>)','West(<?=$total_farmer_in_a_region[2]?>)','South(<?=$total_farmer_in_a_region[3]?>)','Coastal(<?=$total_farmer_in_a_region[4]?>)']);
            //pie.Draw();
            RGraph.Effects.Pie.RoundRobin(pie);
        </script>
    </div>
        
    <div class="offset1 span5">
        <strong>Cultivation</strong>
        <canvas id="cvs1" width="450px" height="250px">chart2</canvas>
        <script>       		
                var pie1 = new RGraph.Pie('cvs1', [<?=$global_total_baseline_fertilizer?>,<?=round($global_total_line_sowing,2)?>,<?=round($global_total_non_line_sowing,2)?>,<?=round($global_total_interfiling_weeding,2)?>, <?=round($global_total_flowering,2)?>,<?=round($global_total_pods_5cm,2)?>,<?=round($global_total_harvest,2)?>,<?=round($global_total_purchase,2)?>]);
                pie1.Set('chart.tooltips', ['Baseline Fertilizer','Line Sowing','Non Line Sowing','Interfiling/Weeding','Flowering','Pod Development','Harvest','Purchase']);
                pie1.Set('chart.labels', ['Baseline Fertilizer(<?=$global_total_baseline_fertilizer?>)','Line Sowing(<?=round($global_total_line_sowing,2)?>)','Non Line Sowing(<?=round($global_total_non_line_sowing,2)?>)','Interfiling/Weeding(<?=round($global_total_interfiling_weeding,2)?>)','Flowering(<?=round($global_total_flowering,2)?>)','Pod Development(<?=round($global_total_pods_5cm,2)?>)','Harvest(<?=round($global_total_harvest,2)?>)','Purchase(<?=round($global_total_purchase,2)?>)']);
                //pie1.Draw();
                RGraph.Effects.Pie.RoundRobin(pie1);
        </script>
    </div> 
        
        
        </div> <!-- report_div end-->
        
        </div> <!-- /end span12 -->
        

        

    </div>
    <!-- /end row -->
</div>

<?php echo $this->load->view('footer'); ?>

</body>
</html>