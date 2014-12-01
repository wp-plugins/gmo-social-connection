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
 * default option
 */
function gmo_social_connection_default_options()
{
    $styles = <<<EOT
.gmo_social_connection{
    border: 0 !important;
    padding: 10px 0 20px 0 !important;
    margin: 0 !important;
    text-align: right !important;
}
.gmo_social_connection div{
    float: left !important;
    border: 0 !important;
    padding: 0 !important;
    margin: 0 5px 0px 0 !important;
    min-height: 30px !important;
    line-height: 18px !important;
    text-indent: 0 !important;
}
.gmo_social_connection img{
    border: 0 !important;
    padding: 0;
    margin: 0;
    vertical-align: top !important;
}
.gmo_social_connection_clear{
    clear: both !important;
}
#fb-root{
    display: none;
}
.wsbl_twitter{
    width: 100px;
}
.wsbl_facebook_like iframe{
    max-width: none !important;
}
EOT;
    
    return array( "services" => "facebook_like",
                  "styles" => $styles,
                  "position" => "top",
                  "single_page" => true,
                  "is_page" => true,
                  //"is_home" => true,
                  "mixi" => array('check_key' => '',
                                   'check_robots' => 'noimage',
                                   'button' => 'button-3'),
                  'mixi_like' => array('width' => '65'),
                  "twitter" => array('lang' => "ja"),
                  'twitter_share' => array('showCount' => false,
                                           'largeButton' => false,
                                           'via' => '',
                                           'recommend' => '',
                                           'hashtag' => ''),
                  'twitter_follow' => array('user' => '',
                                           'showUsername' => false,
                                           'largeButton' => false,
                                           'showCount' => false),
                  "hatena_button" => array('layout' => 'simple-balloon'),
                  'facebook' => array('locale' => 'ja_JP',//en_US
                                      'version' => 'xfbml'),
                  'facebook_like' => array('action' => 'like',
                                            'layout' => 'standard',
                                            'FriendsFaces' => false,
                                            'share' => false,
                                            'width' => '100'),
                  'facebook_share' => array('layout' => '',
                                            'width' => ''),
                  'facebook_follow' => array('layout' => 'standard',
                                           'ShowFaces' => false,
                                           'ProfileURL' => '',
                                           'width' => '',
                                           'height' => ''),
                  'gree' => array('button_type' => '4',
                                    'button_size' => '16'),
                  'evernote' => array('button_type' => 'article-clipper'),
                  'tumblr' => array('button_type' => '1'),
                  'atode' => array('button_type' => 'iconsja'),
                  'google_plus_one' => array('lang' => 'en-US'),
                  'google_plus_one_plus1button' => array('size' => 'standard',
                                             'style' => 'inline',
                                             'width' => '100'),
                  'google_plus_one_share' => array('size' => 'medium',
                                             'style' => 'none',
                                             'width' => '100'),
                  'line' => array('button_type' => 'line88x20'),
                  'pocket' => array('button_type' => 'none'),
    );
}

/**
 * option
 */
function gmo_social_connection_options()
{
    $options = get_option("gmo_social_connection_options", array());
    
    // array merge recursive overwrite (1 depth)
    $default_options = gmo_social_connection_default_options();
    foreach( $default_options as $key => $val ){
        if(is_array($default_options[$key])){
            if(!array_key_exists($key, $options) || !is_array($options[$key])){
                $options[$key] = array();
            }
            $options[$key] = array_merge($default_options[$key], $options[$key]);
        }
    }
    return array_merge( gmo_social_connection_default_options(), $options );
}

/**
 * save options
 * 
 * @param array $data ($_POST)
 */
function gmo_social_connection_save_options($data)
{
    $options = array("services" => $data["services"],
                      "styles" => $data["styles"],
                      "position" => $data["position"],
                      "single_page" => $data["single_page"] == 'true',
                      "is_page" => $data["is_page"] == 'true',
                      //"is_home" => $data["is_home"] == 'true',
                      "mixi" => array('check_key' => $data["mixi_check_key"],
                                       'check_robots' => $data["mixi_check_robots"],
                                       'button' => $data['mixi_button']),
                      'mixi_like' => array('width' => $data["mixi_like_width"],),
                      "twitter" => array('lang' => $data['twitter_lang']),
                      'twitter_share' => array('showCount' => $data['twitter_share_showCount'],
                                           'largeButton' => $data['twitter_share_largeButton'],
                                           'via' => $data['twitter_share_via'],
                                           'recommend' => $data['twitter_share_recommend'],
                                           'hashtag' => $data['twitter_share_hashtag']),
                      'twitter_follow' => array('user' => $data['twitter_follow_user'],
                                           'showUsername' => $data['twitter_follow_showUsername'],
                                           'largeButton' => $data['twitter_follow_largeButton'],
                                           'showCount' => $data['twitter_follow_showCount']),
                      'hatena_button' => array('layout' => $data['hatena_button_layout']),
                      'facebook' => array('locale' => trim($data['facebook_locale']),
                                          'version' => $data['facebook_version'],
                                          'fb_root' => $data['facebook_fb_root'] == 'true'),
                      'facebook_like' => array('layout' => $data['facebook_like_layout'],
                                                'action' => $data['facebook_like_action'],
                                                'share' => $data['facebook_like_share'] == 'true',
                                                'FriendsFaces' => $data['facebook_like_FriendsFaces'] == 'true',
                                                'width' => $data['facebook_like_width']),
                      'facebook_share' => array('type' => $data['facebook_share_type'],
                                                'width' => $data['facebook_share_width']),
                      'facebook_follow' => array('layout' => $data['facebook_follow_layout'],
                                               'ShowFaces' => $data['facebook_follow_ShowFaces'] == 'true',
                                               'ProfileURL' => $data['facebook_follow_ProfileURL'],
                                               'width' => $data['facebook_follow_width'],
                                               'height' => $data['facebook_follow_height']),
                      'gree' => array('button_type' => $data['gree_button_type'],
                                        'button_size' => $data['gree_button_size']),
                      'evernote' => array('button_type' => $data['evernote_button_type']),
                      'tumblr' => array('button_type' => $data['tumblr_button_type']),
                      'atode' => array('button_type' => $data['atode_button_type']),
                      'google_plus_one' => array('lang' => $data['google_plus_one_lang']),
                      'google_plus_one_plus1button' => array('size' => $data['google_plus_one_plus1button_size'],
                                                  'style' => $data['google_plus_one_plus1button_style'],
                                                  'width' => $data['google_plus_one_plus1button_width']),
                      'google_plus_one_share' => array('size' => $data['google_plus_one_share_size'],
                                                  'style' => $data['google_plus_one_share_style'],
                                                  'width' => $data['google_plus_one_share_width']),
                      'line' => array('button_type' => $data['line_button_type']),
                      'pocket' => array('button_type' => $data['pocket_button_type']),
    );
    update_option( 'gmo_social_connection_options', $options );
    return $options;
}

/**
 * restore default options
 */
function gmo_social_connection_restore_default_options()
{
    $options = gmo_social_connection_default_options();
    update_option( 'gmo_social_connection_options', $options );
    return $options;
}
