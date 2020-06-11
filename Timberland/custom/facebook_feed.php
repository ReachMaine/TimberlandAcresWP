<?php /* facebook feed shortcode */

if ( !function_exists('reach_facebook_feed') ) {
    add_shortcode('fb_feed', 'reach_facebook_feed');
    function reach_facebook_feed($atts) {
        $atts = shortcode_atts( array(
            'fb_id' => '',
            'include_sdk' => 'true',
            'style' => '',
            'title' => 'HERE',
        ), $atts, 'fb_feed' );
        $fb_id = $atts['fb_id'];
        if ($atts['include_sdk'] == 'true') {
            $include_sdk = true;
        } else {
            $include_sdk = false;
        }
        $title = $atts['title'];
        $style = $atts['style'];

        $ret_str = "";
        //$ret_str = "fb_id is: {}".$fb_id."} and include_sdk = {".$include_sdk."}";
        if ($fb_id) {
            $ret_str .= '<div id="fb-root"></div>';
            if ($include_sdk) {
                $ret_str .= "<script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8';
                              fjs.parentNode.insertBefore(js, fjs);
                          }(document, 'script', 'facebook-jssdk'));</script>";
            }
            $ret_str .= '<div class="fb-page"';
            if ($style) {
                $ret_str .= ' style="'.$style.'" ';
            }
            $ret_str .=     'data-href = "https://www.facebook.com/'.$fb_id.'/" ' ;
            $ret_str .=     'data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">';
            $ret_str .=     '<blockquote cite="https://www.facebook.com/timberlandacres/" class="fb-xfbml-parse-ignore">';
            $ret_str .=         '<a href="https://www.facebook.com/'.$fb_id.'" >';
            $ret_str .=             $title;
            $ret_str .=         '</a>';
            $ret_str .=     '</blockquote>';
            $ret_str .= '</div>';
        }
        return $ret_str;
    } // function
}
