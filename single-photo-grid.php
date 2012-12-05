<?php
/* 
Template Name Posts: Photo Grid
*/
define('NO_SIDEBAR', true);
function add_photogrid_scripts(){
        $path_to_photogrid = 'http://blogs.gwhatchet.com/wp-content/themes/hatchet-blogs/';
        echo '<link rel="stylesheet" type="text/css" href="'.$path_to_photogrid.'photogrid/hatchet-photo-grid.css">'."\n";
        echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>'."\n";
        echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/fancybox/source/jquery.fancybox.js?v=2.1.3"></script>'."\n";
        echo '<link rel="stylesheet" type="text/css" href="'.$path_to_photogrid.'photogrid/fancybox/source/jquery.fancybox.css?v=2.1.2" media="screen" />'."\n";
        echo '<link rel="stylesheet" type="text/css" href="'.$path_to_photogrid.'photogrid/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />'."\n";
        echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>'."\n";
        echo '<link rel="stylesheet" type="text/css" href="'.$path_to_photogrid.'photogrid/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />'."\n";
        echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>'."\n";
        echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>'."\n";
         echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/images-loaded/jquery.imagesloaded.min.js"></script>'."\n";

        echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/masonry/jquery.masonry.min.js"></script>';
        echo '<script type="text/javascript" src="'.$path_to_photogrid.'photogrid/mason-hatchet.js"></script>';
 }
 add_action('wp_head', 'add_photogrid_scripts');

get_header();
?>
<?php
$post_id = get_the_ID();
?>

<div id="photo-grid-header" class="clearfix">
<div class="post photo-grid-title photo-float-left" ><h1 class="photo-grid-header"><?php echo get_the_title($post_id);?></h1>
 <div class="datestamp">
 <?php ap_the_date(); ?> <span class="timestamp"><?php ap_the_time(); ?></span>
 </div>

</div>
<div class="blog-head photo-float-right" style="margin-bottom:0px;width:450px !important">
  	<h3><a style="width:450px !important;" class="no-line-image" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h3>
</div>
<p style="padding-left:20px;width:470px;"><?php echo get_the_content($post_id); ?></p>
</div>
<div id="photo-grid-container">
<?php
$attachments = get_children( array( 'post_parent' => $post_id, 'post_type' => 'attachment' ) );
    foreach ( $attachments as $attachment ) {
        if ( strpos( $attachment->post_mime_type, 'image/' ) !== 0 )
            continue;
        $caption = $attachment->post_content;
        $credit = $attachment->post_excerpt;
        $url = $attachment->guid;
        preg_match('/files\/(\d{4}\/\d{2})/', $url, $matched_dates);
        $data = wp_get_attachment_metadata( $attachment->ID );
        if (isset($matched_dates[1])){
            //var_dump($data['sizes']);
            $grid_thumb_url = $data['sizes']['grid-thumb']['file'];
            $grid_large_url = $data['sizes']['grid-large']['file'];
            $height = $data['sizes']['grid-thumb']['height'];
            $thumb_url = home_url().'/files/'.$matched_dates[1].'/'.$grid_thumb_url;
            if(isset($grid_large_url))
                $large_url = home_url().'/files/'.$matched_dates[1].'/'.$grid_large_url;
            else
                $large_url = $url;
            ?>
            <div style="margin:10px;width:220px;float:left;<?php echo 'height:'.$height.'px;';?>" class="picture"><a class="fancy-img" href="<?php echo $large_url; ?>"><img style="width:220px;<?php echo 'height:'.$height.'px;';?>" src="<?php echo $thumb_url; ?>" alt="<?php echo $caption; ?>" /></a><span class="photo-names" style="display:none"><?php echo $credit; ?></span></div>
            <?php
        }
        //var_dump($data['sizes']['grid-thumb']);
        //echo get_the_post_thumbnail($attachment->ID, array(200, 9999));
        //$width = (int) $data['width'];
        //$height = (int) $data['height'];
        //$hw = "width='$width' height='$height'";
    }
?>
</div>
<div style="height:10px"></div>
<?php
get_footer();

?>
