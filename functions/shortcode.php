<?php 
    $cidades = $wpdb->get_results( "SELECT * FROM city_weather" );
?>
<div class="row meteorologia">
    <div class="col-xs-4">
        <?php 
            foreach ($cidades as $cidade) :
                if ($cidade->search_for == 'Salvador, Bahia') :
                    $icon_ssa = $cidade->icon_name;
                endif;
            endforeach;
        ?>
        <img src="<?php bloginfo('template_url'); ?>/assets/img/tempo/<?php echo $icon_ssa; ?>" id='icon2' />
    </div>
    <div class="col-xs-7">
        <select id="selectCities">
            <?php 
                foreach ($cidades as $cidade) :
                    if ($cidade->search_for == 'Salvador, Bahia') : 
                        $selected = 'selected';
                        $min_ssa = $cidade->temp_min;
                        $max_ssa = $cidade->temp_max;
                    else :
                        $selected = '';
                    endif;
                    echo '<option value="'.$cidade->temp_min.', '.$cidade->temp_max.','.$cidade->icon_name.'" '.$selected.'>'.$cidade->name_display.'</option>';
                endforeach;
            ?>
        </select>
        <div class="temp-min col-xs-5"><span id='temp2-min'><?php echo $min_ssa; ?></span> min</div>
        <div class="temp-min col-xs-5"><span id='temp2-max'><?php echo $max_ssa; ?></span> máx</div>
    </div>
</div>

<script>
jQuery(document).ready(function() {
    jQuery('#selectCities').change(function(){
        var selectedValue = this.value;
        var valueArray = selectedValue.split(',');
        var image = "<?php bloginfo('template_url'); ?>/assets/img/tempo/";
        jQuery('#temp2-min').html(valueArray[0]);
        jQuery('#temp2-max').html(valueArray[1]);
        jQuery('#icon2').attr('src',image+valueArray[2]);
    });
});
</script>