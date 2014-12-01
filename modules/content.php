<?php
/*
Copyright 2010 utahta (email : labs.ninxit@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * html format
 * 
 * @param string $services
 * @param string $link
 * @param string $title
 */
function gmo_social_connection_output( $services, $link, $title )
{
    $wp = new GmoSocialConnection( $link, $title, get_bloginfo('name') );
    $class_methods = gmo_social_connection_get_class_methods();
    $out = '';
    foreach( explode(",", $services) as $service ){
        $service = trim($service);
        if($service != ''){
            if(in_array($service, $class_methods)){
                $out .= '<div class="wsbl_'.$service.'">'.call_user_func( array( $wp, $service ) ).'</div>'; // GmoSocialConnection method
            }
            else{
                $out .= "<div>[`$service` not found]</div>";
            }
        }
    }
    if( $out == '' ){
        return $out;
    }
    return "<div class='gmo_social_connection'>{$out}</div><br class='gmo_social_connection_clear' />";
}

/**
 * echo html format
 * 
 * @param string $services
 * @param string $link
 * @param string $title
 */
function gmo_social_connection_output_e( $services=null, $link=null, $title=null )
{
    if($services == null){
        $options = gmo_social_connection_options();
        $services = $options['services'];
    }
    echo gmo_social_connection_output( $services, $link, $title );
}

/**
 * add_action wp_head
 */
function gmo_social_connection_wp_head()
{
?>
<!-- BEGIN: GMO Social Connection -->
<?php
    // load options
    $options = gmo_social_connection_options();
    $services = explode(",", $options['services']);
    
    // mixi-check-robots
    if(in_array('mixi', $services)){
?>
<meta name="mixi-check-robots" content="<?php echo $options['mixi']['check_robots'] ?>" />
<?php
    }
    
    // load javascript
    // tumblr
    if(in_array('tumblr', $services)){
        ?><script type="text/javascript" src="http://platform.tumblr.com/v1/share.js"></script><?php
    }
    // facebook
    if(in_array('facebook_like', $services)  || 
       in_array('facebook_share', $services) || 
       in_array('facebook_follow', $services)){
        $version = $options['facebook']['version'];
        if($version == "html5" || $version == "xfbml"){
            $locale = $options['facebook']['locale'];
            $locale = ($locale == '' ? 'en_US' : $locale);
?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $locale ?>/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>   
<?php
        }
    }

    // css
?>
<style type="text/css">
<?php echo $options['styles'] ?>
</style>
<!-- END: GMO Social Connection -->
<?php
}

/**
 * add_filter the_content.
 */
function gmo_social_connection_the_content( $content )
{
	/*
	echo("<pre>");
    print_r($content);
    echo("</pre>");
	*/
	if( is_feed() || is_404() || is_robots() || is_comments_popup() || (function_exists( 'is_ktai' ) && is_ktai()) ){
       
       //echo("*************11");
       
       return $content;
    }
    
    $options = gmo_social_connection_options();
    
    
    //echo($options['is_home']);
    
    if( $options['single_page'] && !is_singular() ){
        //echo("*************22");
        return $content;
    }
    
    if( !$options['is_page'] && is_page() ){
        //echo("*************33");
        return $content;
    }
    
    
    //if( is_front_page() ){
    /*
    if( !$options['is_home'] && is_home() ){
    //if( !$options['is_front_page'] && is_front_page() ){
        
        //echo("*************44");
        return $content;
    }
    */
    
    $out = gmo_social_connection_output( $options['services'], get_permalink(), get_the_title() );
    if( $out == '' ){
       return $content;
    }
    if( $options['position'] == 'top' ){
       return "{$out}{$content}";
    }
    else if( $options['position'] == 'bottom' ){
       return "{$content}{$out}";
    }
    else if( $options['position'] == 'both'){
       return "{$out}{$content}{$out}";
    }
    return $content;
}

/*
function gmo_social_connection_home($content){
	
	if( is_feed() || is_404() || is_robots() || is_comments_popup() || (function_exists( 'is_ktai' ) && is_ktai()) ){
       
       echo("*************11");
       
       return $content;
    }
    
    $options = gmo_social_connection_options();
    
    
    //echo($options['is_home']);
    
    
    
    //if( is_front_page() ){
    //if( !$options['is_home'] && is_home() ){
    if( !is_home() ){
    //if( !$options['is_front_page'] && is_front_page() ){
        
        //echo("*************44");
        return $content;
    }
    
    
    
    
    
    $out = gmo_social_connection_output( $options['services'], get_permalink(), get_the_title() );
    
    echo($out);
    $content['after'] = $out;
    
    
    
    if( $out == '' ){
       //return $content;
       //echo($out);
    }
    if( $options['position'] == 'top' ){
       
       //echo("!!");
       
       //return "{$out}{$content}";
       //echo($out.$content);
    }
    else if( $options['position'] == 'bottom' ){
       //return "{$content}{$out}";
       //echo($content.$out);
    }
    else if( $options['position'] == 'both'){
       //return "{$out}{$content}{$out}";
       //echo($out.$content.$out);
    }
    
    //echo($content);
    
    
    return $content;
	
}
*/


/**
 * wp_footer function
 */
function gmo_social_connection_wp_footer()
{
?>
<!-- BEGIN: GMO Social Connection -->
<?php
    // load options
    $options = gmo_social_connection_options();
    $services = explode(",", $options['services']);
    
    /*
     * load javascript
     */
    // evernote
    if(in_array('evernote', $services)){
        echo '<script type="text/javascript" src="http://static.evernote.com/noteit.js"></script>'."\n";
    }
    // Google +1
    if(in_array('google_plus_one', $services)){
        $lang = $options['google_plus_one']['lang'];
?>
<script type="text/javascript">
  window.___gcfg = {lang: '<?php echo $lang ?>'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<?php
    }
    
?>
<!-- END: GMO Social Connection -->
<?php
}
?>