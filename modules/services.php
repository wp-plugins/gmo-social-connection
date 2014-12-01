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
 * Services
 */
class GmoSocialConnection
{
    var $url;
    var $title;
    var $encode_url;
    var $encode_title;
    var $encode_blogname;
    
    function GmoSocialConnection( $url, $title, $blogname )
    {
        $title = $this->to_utf8( $title );
        $this->blogname = $this->to_utf8( $blogname );
        $this->url = $url;
        $this->title = $title;
        $this->encode_url = rawurlencode( $url );
        $this->encode_title = rawurlencode( $title );
        $this->encode_blogname = rawurlencode( $this->blogname );
    }
    
    function to_utf8( $str )
    {
        $charset = get_option( 'blog_charset' );
        if( strcasecmp( $charset, 'UTF-8' ) != 0 && function_exists('mb_convert_encoding') ){
            $str = mb_convert_encoding( $str, 'UTF-8', $charset );
        }
        return $str;
    }
    
    function link_raw( $url ){
        return $url;
    }
    function link( $url, $alt, $icon, $width, $height ){
        $width = $width ? "width='$width'" : "";
        $height = $height ? "height='$height'" : "";
        return "<a href='{$url}' title='{$alt}' rel=nofollow class='gmo_social_connection_a' target=_blank>"
               ."<img src='{$icon}' alt='{$alt}' title='{$alt}' $width $height class='gmo_social_connection_img' />"
               ."</a>";
    }
    
    /**
     * @brief Hatena Bookmark
     */
     
    /*
    function hatena()
    {
        $url = "http://b.hatena.ne.jp/add?mode=confirm&url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Bookmark this on Hatena Bookmark", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/hatena.gif";
        return $this->link( $url, $alt, $icon, 16, 12 );
    }
    function hatena_users()
    {
        $url = "http://b.hatena.ne.jp/entry/{$this->url}";
        $alt = sprintf( __("Hatena Bookmark - %s", GMO_SOCIAL_CONNECTION_DOMAIN), $this->title );
        $icon = "http://b.hatena.ne.jp/entry/image/{$this->url}";
        return $this->link( $url, $alt, $icon, null, null );
    }
    function hatena_button()
    {
        $options = gmo_social_connection_options();
        $url = "http://b.hatena.ne.jp/entry/{$this->url}";
        $title = $this->title;
        $alt = __( "Bookmark this on Hatena Bookmark", GMO_SOCIAL_CONNECTION_DOMAIN );
        return $this->link_raw('<a href="'.$url.'"'
                                .' class="hatena-bookmark-button"'
                                .' data-hatena-bookmark-title="'.$title.'"'
                                .' data-hatena-bookmark-layout="'.$options['hatena_button']['layout'].'"'
                                .' title="'.$alt.'">'
                                .' <img src="//b.hatena.ne.jp/images/entry-button/button-only@2x.png"'
                                .' alt="'.$alt.'" width="20" height="20" style="border: none;" /></a>'
                                .'<script type="text/javascript" src="//b.hatena.ne.jp/js/bookmark_button.js" charset="utf-8" async="async"></script>');
    }
    */
    
    /**
     * @brief twib
     */
    /*
    function twib()
    {
        $url = "http://twib.jp/share?url={$this->encode_url}";
        $alt = __( "Post to Twitter", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/twib.gif";
        return $this->link( $url, $alt, $icon, 18, 18 );
    }
    function twib_users()
    {
        $url = "http://twib.jp/url/{$this->url}";
        $alt = sprintf( __("Tweets - %s", GMO_SOCIAL_CONNECTION_DOMAIN), $this->title );
        $icon = "http://image.twib.jp/counter/{$this->url}";
        return $this->link( $url, $alt, $icon, null, null );
    }
    */
    
    /**
     * @brief tweetmeme
     */
    /*
    function tweetmeme()
    {
        return $this->link_raw( "<script type='text/javascript'>"
                               ."tweetmeme_style = 'compact';"
                               ."tweetmeme_url='{$this->url}';"
                               ."</script>"
                               ."<script type='text/javascript' src='http://tweetmeme.com/i/scripts/button.js'></script>" );
    }
    */
    
    

    /**
     * @brief Livedoor Clip
     */
    /*
    function livedoor()
    {
        $url = "http://clip.livedoor.com/redirect?link={$this->encode_url}&title={$this->encode_blogname}%20-%20{$this->encode_title}&ie=utf-8";
        $alt = __( "Bookmark this on Livedoor Clip", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/livedoor.gif";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    function livedoor_users()
    {
        $url = "http://clip.livedoor.com/page/{$this->url}";
        $alt = sprintf( __("Livedoor Clip - %s", GMO_SOCIAL_CONNECTION_DOMAIN), $this->title );
        $icon = "http://image.clip.livedoor.com/counter/{$this->url}";
        return $this->link( $url, $alt, $icon, null, null );
    }
    */
    
    /**
     * @brief Yahoo!JAPAN Bookmark
     */
    /*
    function yahoo()
    {
        $url = "http://bookmarks.yahoo.co.jp/bookmarklet/showpopup?t={$this->encode_title}&u={$this->encode_url}&ei=UTF-8";
        $alt = __( "Bookmark this on Yahoo Bookmark", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/yahoo.gif";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    function yahoo_users()
    {
        return $this->link_raw( "<script src='http://num.bookmarks.yahoo.co.jp/numimage.js?disptype=small'></script>" );
    }
    */
    
    /**
     * @brief Yahoo Buzz
     */
    /*
    function yahoo_buzz()
    {
        $url = "http://buzz.yahoo.com/buzz?targetUrl={$this->encode_url}&headline={$this->encode_title}";
        $alt = __( "Buzz This", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/yahoo_buzz.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief BuzzURL
     */
    /*
    function buzzurl()
    {
        $url = "http://buzzurl.jp/entry/{$this->url}";
        $alt = __( "Bookmark this on BuzzURL", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/buzzurl.gif";
        return $this->link( $url, $alt, $icon, 21, 15 );
    }
    function buzzurl_users()
    {
        $url = "http://buzzurl.jp/entry/{$this->url}";
        $alt = sprintf( __("BuzzURL - %s", GMO_SOCIAL_CONNECTION_DOMAIN), $this->title );
        $icon = "http://api.buzzurl.jp/api/counter/v1/image?url={$this->encode_url}";
        return $this->link( $url, $alt, $icon, null, null );
    }
    */
    
    /**
     * @brief nifty clip
     */
    /*
    function nifty()
    {
        $url = "http://clip.nifty.com/create?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Bookmark this on @nifty clip", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/nifty.gif";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    function nifty_users()
    {
        $url = '#';
        $alt = sprintf( __("@nifty clip - %s", GMO_SOCIAL_CONNECTION_DOMAIN), $this->title );
        $icon = "http://api.clip.nifty.com/api/v1/image/counter/{$this->url}";
        return $this->link( $url, $alt, $icon, null, null );
    }
    */
    
    /**
     * @brief Tumblr
     */
    /*
    function tumblr()
    {
        $options = gmo_social_connection_options();
        $type = $options['tumblr']['button_type'];
        $width = 'width:81px;';
        switch($type){
            case '1' : $width = 'width:81px;'; break;
            case '2' : $width = 'width:61px;'; break;
            case '3' : $width = 'width:129px;'; break;
            case '4' : $width = 'width:20px;'; break;
        }
        return $this->link_raw('<a href="http://www.tumblr.com/share?v=3&u='.$this->encode_url.'&t='.$this->encode_title.'" '
                            .'title="'.__ll("Share on Tumblr").'" '
                            .'style="display:inline-block; text-indent:-9999px; overflow:hidden; '
                            .$width.' height:20px; '
                            .'background:url(\'http://platform.tumblr.com/v1/share_'.$type.'.png\')'
                            .' top left no-repeat transparent;">'
                            .__ll("Share on Tumblr")
                            .'</a>');
    }
    */
    
    /**
     * @brief FC2 Bookmark
     */
    /*
    function fc2()
    {
        $url = "http://bookmark.fc2.com/user/post?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Bookmark this on FC2 Bookmark", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/fc2.gif";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    function fc2_users()
    {
        $url = "http://bookmark.fc2.com/search/detail?url={$this->encode_url}";
        $alt = sprintf( __("FC2 Bookmark - %s", GMO_SOCIAL_CONNECTION_DOMAIN), $this->title );
        $icon = "http://bookmark.fc2.com/image/users/{$this->url}";
        return $this->link( $url, $alt, $icon, null, null );
    }
    */
    
    /**
     * @brief newsing
     */
    /*
    function newsing()
    {
        $url = "http://newsing.jp/nbutton?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Newsing it!", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/newsing.gif";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Choix
     */
    /*
    function choix()
    {
        $url = "http://www.choix.jp/bloglink/{$this->url}";
        $alt = __( "Choix it!", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/choix.gif";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Google Bookmarks
     */
    /*
    function google()
    {
        $url = "http://www.google.com/bookmarks/mark?op=add&bkmk={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Bookmark this on Google Bookmarks", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/google.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Google Buzz
     */
    /*
    function google_buzz()
    {
        $url = "http://www.google.com/buzz/post?url={$this->encode_url}&message={$this->encode_title}";
        $alt = __( "Post to Google Buzz", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/google-buzz.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    

    /**
     * @brief Delicious
     */
    /*
    function delicious()
    {
        $url = "http://delicious.com/save?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Bookmark this on Delicious", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/delicious.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Digg
     */
    /*
    function digg()
    {
        $url = "http://digg.com/submit?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Bookmark this on Digg", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/digg.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Friend feed
     */
    /*
    function friendfeed()
    {
        $url = "http://friendfeed.com/?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Share on FriendFeed", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/friendfeed.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Facebook
     */
    /*
    function facebook()
    {
        $url = "http://www.facebook.com/share.php?u={$this->encode_url}&t={$this->encode_title}";
        $alt = __( "Share on Facebook", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/facebook.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Facebook Like Button
     */
    
    function facebook_like()
    {
        $options = gmo_social_connection_options();
        $layout = $options['facebook_like']['layout'];
        $action = $options['facebook_like']['action'];
        $share = $options['facebook_like']['share'] ? 'true' : 'false';
        $FriendsFaces = $options['facebook_like']['FriendsFaces'] ? 'true' : 'false';
        //$width = $options['facebook_like']['width'];
        $locale = $options['facebook']['locale'];
        $version = $options['facebook']['version'];
        $fb_root = $options['facebook']['fb_root'] ? '<div id="fb-root"></div>' : '';
        
        if($version == "html5"){
            return $this->link_raw( $fb_root
                                    .'<div class="fb-like" '
                                    .'data-href="'.$this->url.'" '
                                    .'data-layout="'.$layout.'" '
                                    .'data-action="'.$action.'" '
                                    //.($width != "" ? 'data-width="'.$width.'" ' : '')
                                    .'data-share="'.$share.'" '
                                    .'data-show_faces="'.$FriendsFaces.'" >'
                                    .'</div>');
        }
        elseif($version == "xfbml"){
            return $this->link_raw( $fb_root
                                    .'<fb:like '
                                    .'href="'.$this->url.'" '
                                    .'layout="'.$layout.'" '
                                    .'action="'.$action.'" '
                                    //.($width != "" ? 'width="'.$width.'" ' : '')
                                    .'share="'.$share.'" '
                                    .'show_faces="'.$FriendsFaces.'" >'
                                    .'</fb:like>');
        }
        else{
            return $this->link_raw('<iframe src="//www.facebook.com/plugins/like.php?href='.$this->encode_url
                    .'&amp;layout='.$layout
                    .'&amp;show_faces=false'
                    .'&amp;width='.$width
                    .'&amp;action='.$action
                    .'&amp;share='.$share
                    .($locale == '' ? '' : '&amp;locale='.$locale)
                    .'&amp;height=35"'
                    .' scrolling="no" frameborder="0"'
                    .' style="border:none; overflow:hidden; width:'.$width.'px; height:35px;"'
                    .' allowTransparency="true"></iframe>');
        }
        
    }
    /**
     * @brief Facebook Share
     */
    function facebook_share()
    {
        $options = gmo_social_connection_options();
        $url = $this->url;
        $version = $options['facebook']['version'];
        $fb_root = $options['facebook']['fb_root'] ? '<div id="fb-root"></div>' : '';
        //$width = $options['facebook_share']['width'];
        $type = $options['facebook_share']['type'];
        
        if($version == "html5"){
            return $this->link_raw( $fb_root
                                    .'<div class="fb-share-button" '
                                    .'data-href="'.$url.'" '
                                    //.($width != "" ? 'data-width="'.$width.'" ' : '')
                                    .'data-type="'.$type.'">'
                                    .'</div>');
        }else{
            return $this->link_raw( $fb_root
                                    .'<fb:share-button '
                                    .'href="'.$url.'" '
                                    //.($width != "" ? 'width="'.$width.'" ' : '')
                                    .'data-type="'.$type.'" >'
                                    .'</fb:share-button>');
        }
    }
    
    
    
    
    /**
     * @brief Facebook Follow
     */
    function facebook_follow()
    {
        $options = gmo_social_connection_options();
        //$url = $this->url;
        $version = $options['facebook']['version'];
        $fb_root = $options['facebook']['fb_root'] ? '<div id="fb-root"></div>' : '';
        $layout = $options['facebook_follow']['layout'];
        $ShowFaces = $options['facebook_follow']['ShowFaces'] ? 'true' : 'false';
        $ProfileURL = $options['facebook_follow']['ProfileURL'];
        //$width = $options['facebook_follow']['width'];
        //$height = $options['facebook_follow']['height'];
        
        if($version == "html5"){
            return $this->link_raw( $fb_root
                                    .'<div class="fb-follow" '
                                    .'data-href="'.$ProfileURL.'" '
                                    .'data-layout="'.$layout.'" '
                                    .'data-show-faces="'.$ShowFaces.'" '
                                    //.($width != "" ? 'data-width="'.$width.'" ' : '')
                                    //.($height != "" ? 'data-height="'.$height.'" ' : '').'>'
                                    .'</div>');
        }else{
            return $this->link_raw( $fb_root
                                    .'<fb:follow '
                                    .'data-href="'.$ProfileURL.'" '
                                    .'data-layout="'.$layout.'" '
                                    .'data-show-faces="'.$ShowFaces.'" '
                                    //.($width != "" ? 'data-width="'.$width.'" ' : '')
                                    //.($height != "" ? 'data-height="'.$height.'" ' : '').'>'
                                    .'</fb:send>');
        }
    }
    
    /**
     * @brief Facebook Send
     */
    /*
    function facebook_send()
    {
        $options = gmo_social_connection_options();
        $url = $this->url;
        $version = $options['facebook']['version'];
        $fb_root = $options['facebook']['fb_root'] ? '<div id="fb-root"></div>' : '';
        $colorscheme = $options['facebook_send']['colorscheme'];
        $width = $options['facebook_send']['width'];
        $height = $options['facebook_send']['height'];
        
        if($version == "html5"){
            return $this->link_raw( $fb_root
                                    .'<div class="fb-send" '
                                    .'data-href="'.$url.'" '
                                    .($width != "" ? 'data-width="'.$width.'" ' : '')
                                    .($height != "" ? 'data-height="'.$height.'" ' : '')
                                    .'data-colorscheme="'.$colorscheme.'">'
                                    .'</div>');
        }else{
            return $this->link_raw( $fb_root
                                    .'<fb:send '
                                    .'href="'.$url.'" '
                                    .($width != "" ? 'width="'.$width.'" ' : '')
                                    .($height != "" ? 'height="'.$height.'" ' : '')
                                    .'colorscheme="'.$colorscheme.'" >'
                                    .'</fb:send>');
        }
    }
    */
	
	/**
     * @brief twitter Share
     */
    function twitter_share()
    {
        $options = gmo_social_connection_options();
        
        //echo($options['twitter_share']['vertical']);
        
        return $this->link_raw('<a href="https://twitter.com/share" class="twitter-share-button"'
                                .($options['twitter_share']['via'] != '' ? 'data-via="'.$options['twitter_share']['via'].'" ' : '')
                                .($options['twitter_share']['showCount'] == 'on' ? '' : '')
                                .($options['twitter_share']['showCount'] == 'off' ? 'data-count="none" ' : '')
                                .($options['twitter_share']['showCount'] == 'vertical' ? 'data-count="vertical" ' : '')
                                .($options['twitter_share']['largeButton'] != 'off' ? 'data-size="large" ' : '')
                                .($options['twitter_share']['recommend'] != '' ? 'data-related="'.$options['twitter_share']['recommend'].'" ' : '')
                                .($options['twitter_share']['hashtag'] != '' ? 'data-hashtags="'.$options['twitter_share']['hashtag'].'" ' : '')
                                .' data-lang="'.$options['twitter']['lang'].'"'
                                . '></a>'
                                . '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>');
        /*
        $twitter = $options['twitter_share'];
        return $this->link_raw('<iframe allowtransparency="true" frameborder="0" scrolling="no"'
                                .' src="//platform.twitter.com/widgets/tweet_button.html'
                                .'?url='.$this->encode_url
                                .'&amp;text='.$this->encode_title
                                .($twitter['via'] != '' ? '&amp;via='.$twitter['via'] : '')
                                .'&amp;lang='.$twitter['lang']
                                .'&amp;count='.$twitter['count']
                                .'" style="width:130px; height:20px;">'
                                .'</iframe>');
    	*/
    }
    
    /**
     * @brief twitter Follow
     */
    function twitter_follow()
    {
        $options = gmo_social_connection_options();
        return $this->link_raw('<a href="https://twitter.com/'.$options['twitter_follow']['user'].'" class="twitter-follow-button"'
                               .' data-lang="'.$options['twitter']['lang'].'"'
                               .($options['twitter_follow']['largeButton'] == 'on' ? ' data-size="large" ' : '')
                               .($options['twitter_follow']['showUsername'] == 'off' ? 'data-show-screen-name="false" ' : '')
                               .($options['twitter_follow']['showCount'] == 'on' ? 'data-show-count="true" ' : ' data-show-count="false" ')
                               .'></a>'
                                . '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>');
    }
    /**
     * @brief twitter follow
     */
    /*
    function twitter_follow()
    {
        $options = gmo_social_connection_options();
        $twitter = $options['twitter_follow'];
        return $this->link_raw('<iframe allowtransparency="true" frameborder="0" scrolling="no"'
                                .' src="//platform.twitter.com/widgets/tweet_button.html'
                                .'?url='.$this->encode_url
                                .'&amp;text='.$this->encode_title
                                .($twitter['via'] != '' ? '&amp;via='.$twitter['via'] : '')
                                .'&amp;lang='.$twitter['lang']
                                .'&amp;count='.$twitter['count']
                                .'" style="width:130px; height:20px;">'
                                .'</iframe>');
    }
	*/
	
	/**
     * @brief Google +1
     */
    /*
    function google_plus_one()
    {
        $options = gmo_social_connection_options();
        $button_size = $options['google_plus_one']['button_size'];
        $annotation = $options['google_plus_one']['annotation'];
        $width = $annotation == 'inline' ? 'width="'.$options['google_plus_one']['inline_size'].'"' : "";
        $raw = '<g:plusone size="'.$button_size.'" annotation="'.$annotation.'" href="'.$this->url.'" '.$width.'></g:plusone>';
        return $this->link_raw($raw);
    }
    */
    
    /**
     * @brief Google +1 +1button
     */
    function google_plus_one()
    {
        $options = gmo_social_connection_options();
        return $this->link_raw('<script src="https://apis.google.com/js/platform.js" async defer>{lang: \''.$options['google_plus_one']['lang'].'\'}</script>'
                               .'<div class="g-plusone" '
                               .'data-size="'.$options['google_plus_one_plus1button']['size'].'"'
                               .($options['google_plus_one_plus1button']['style'] != 'balloon' ? 'data-annotation="'.$options['google_plus_one_plus1button']['style'].'" ' : '')
                               .'data-width="'.$options['google_plus_one_plus1button']['width'].'" '
                               .'></div>');
        /*
        
        $button_size = $options['google_plus_one']['button_size'];
        $annotation = $options['google_plus_one']['annotation'];
        $width = $annotation == 'inline' ? 'width="'.$options['google_plus_one']['inline_size'].'"' : "";
        $raw = '<g:plusone size="'.$button_size.'" annotation="'.$annotation.'" href="'.$this->url.'" '.$width.'></g:plusone>';
        return $this->link_raw($raw);
        */
    }
    
    /**
     * @brief Google +1 Share
     */
    function google_plus_one_share()
    {
        $options = gmo_social_connection_options();
        return $this->link_raw('<script src="https://apis.google.com/js/platform.js" async defer>{lang: \''.$options['google_plus_one']['lang'].'\'}</script>'
                               .'<div class="g-plus" data-action="share" '
                               .'data-width="'.$options['google_plus_one_share']['width'].'" '
                               .($options['google_plus_one_share']['style'] == 'inline' ? 'data-annotation="'.$options['google_plus_one_share']['style'].'" ' : '')
                               .($options['google_plus_one_share']['style'] == 'horizontal-bubble' ? 'data-annotation="bubble" ' : '')
                               .($options['google_plus_one_share']['style'] == 'vertical-bubble' ? 'data-annotation="'.$options['google_plus_one_share']['style'].'" data-height="60" ' : '')
                               .($options['google_plus_one_share']['style'] == 'none' ? 'data-annotation="'.$options['google_plus_one_share']['style'].'" ' : '')
                               .'></div>');
        
        /*
        $button_size = $options['google_plus_one']['button_size'];
        $annotation = $options['google_plus_one']['annotation'];
        $width = $annotation == 'inline' ? 'width="'.$options['google_plus_one']['inline_size'].'"' : "";
        $raw = '<g:plusone size="'.$button_size.'" annotation="'.$annotation.'" href="'.$this->url.'" '.$width.'></g:plusone>';
        return $this->link_raw($raw);
        */
    }
	
	
   /**
    * @brief reddit
    */
    /*
    function reddit()
    {
        $url = "http://www.reddit.com/submit?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Share on reddit", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/reddit.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief LinkedIn
     */
    /*
    function linkedin()
    {
        $url = "http://www.linkedin.com/shareArticle?mini=true&url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Share on LinkedIn", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/linkedin.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief Evernote
     */
    /*
    function evernote()
    {
        $options = gmo_social_connection_options();
        $type = $options['evernote']['button_type'];
        
        return $this->link_raw('<a href="#" onclick="Evernote.doClip({ title:\''.$this->title.'\', url:\''.$this->url.'\' });return false;">'
                                .'<img src="http://static.evernote.com/'.$type.'.png" />'
                                .'</a>');
    }
    */
    
    /**
     * @brief Instapaper
     */
    /*
    function instapaper()
    {
        return $this->link_raw('<iframe border="0" scrolling="no" width="78" height="17" allowtransparency="true" frameborder="0" '
                                .'style="margin-bottom: -3px; z-index: 1338; border: 0px; background-color: transparent; overflow: hidden;" '
                                .'src="http://www.instapaper.com/e2?url='.$this->encode_url.'&title='.$this->encode_title.'&description="'
                                .'></iframe>');
    }
    */
    
    /**
     * @brief StumbleUpon
     */
    /*
    function stumbleupon()
    {
        $url = "http://www.stumbleupon.com/submit?url={$this->encode_url}&title={$this->encode_title}";
        $alt = __( "Share on StumbleUpon", GMO_SOCIAL_CONNECTION_DOMAIN );
        $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/stumbleupon.png";
        return $this->link( $url, $alt, $icon, 16, 16 );
    }
    */
    
    /**
     * @brief mixi Check
     */
    /*
    function mixi()
    {
        $options = gmo_social_connection_options();
        $data_button = $options['mixi']['button'];
        $data_key = $options['mixi']['check_key'];
        
        return $this->link_raw( '<a href="http://mixi.jp/share.pl" class="mixi-check-button"'
                                 ." data-url='{$this->url}'"
                                 ." data-button='{$data_button}'"
                                 ." data-key='{$data_key}'>Check</a>"
                                 .'<script type="text/javascript" src="http://static.mixi.jp/js/share.js"></script>' );
    }
    */
    
    /**
     * @brief mixi Like
     */
    /*
    function mixi_like()
    {
        $options = gmo_social_connection_options();
        $data_key = $options['mixi']['check_key'];
        $width = $options['mixi_like']['width'];
        
        return $this->link_raw('<iframe src="http://plugins.mixi.jp/favorite.pl?href='.$this->encode_url.'&service_key='.$data_key.'&show_faces=false" '
                                .'scrolling="no" '
                                .'frameborder="0" '
                                .'allowTransparency="true" '
                                .'style="border:0; overflow:hidden; width:'.$width.'px; height:20px;"></iframe>');
    }
    */
    
    /**
     * @brief GREE Social Feedback
     */
    /*
    function gree()
    {
        $options = gmo_social_connection_options();
        $url = $this->encode_url;
        $type = $options['gree']['button_type'];
        $size = $options['gree']['button_size'];
        switch($type){
            case '0': $btn_type = 'btn_iine'; break;
            case '1': $btn_type = 'btn_kininaru'; break;
            case '2': $btn_type = 'btn_osusume'; break;
            case '3': $btn_type = 'btn_share'; break;
            case '4': $btn_type = 'btn_logo'; break;
            default: $btn_type = 'btn_logo';
        }
        $alt = __( "Share on GREE", GMO_SOCIAL_CONNECTION_DOMAIN );
        return $this->link_raw('<a href="http://gree.jp/?mode=share&act=write'
                                 .'&url='.$url
                                 .'&button_type='.$type
                                 .'&button_size='.$size
                                 .'&guid=ON" '
                                 .'title="'.$alt.'" target=_blank>'
                                 .'<img alt="'.$alt.'" title="'.$alt.'" '
                                 .'src="http://i.share.gree.jp/img/share/button/'.$btn_type.'_'.$size.'.png">'
                                 .'</a>');
    }
    */
    
    /**
     * @brief atode
     */
    /*
    function atode()
    {
        $options = gmo_social_connection_options();
        $type = $options['atode']['button_type'];
        switch($type){
            case 'iconsja': return $this->link_raw('<a href=\'http://atode.cc/\' onclick=\'javascript:(function(){var s=document.createElement("scr"+"ipt");s.charset="UTF-8";s.language="javascr"+"ipt";s.type="text/javascr"+"ipt";var d=new Date;s.src="http://atode.cc/bjs.php?d="+d.getMilliseconds();document.body.appendChild(s)})();return false;\'><img src="http://atode.cc/img/iconsja.gif" alt="email this" border="0" align="absmiddle" width="16" height="16"></a>');
            case 'iconnja': return $this->link_raw('<a href=\'http://atode.cc/\' onclick=\'javascript:(function(){var s=document.createElement("scr"+"ipt");s.charset="UTF-8";s.language="javascr"+"ipt";s.type="text/javascr"+"ipt";var d=new Date;s.src="http://atode.cc/bjs.php?d="+d.getMilliseconds();document.body.appendChild(s)})();return false;\'><img src="http://atode.cc/img/iconnja.gif" alt="email this" border="0" align="absmiddle" width="66" height="20"></a>');
            case 'iconnen': return $this->link_raw('<a href=\'http://atode.cc/\' onclick=\'javascript:(function(){var s=document.createElement("scr"+"ipt");s.charset="UTF-8";s.language="javascr"+"ipt";s.type="text/javascr"+"ipt";var d=new Date;s.src="http://atode.cc/bjs.php?d="+d.getMilliseconds();document.body.appendChild(s)})();return false;\'><img src="http://atode.cc/img/iconnen.gif" alt="email this" border="0" align="absmiddle" width="66" height="20"></a>');
        }
        return '';
    }
    */
    
    /**
     * @brief LINE
     */
    /*
    function line()
    {
        $options = gmo_social_connection_options();
        if($options['line']['button_type'] == "line88x20"){
            $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/line88x20.png";
            $width = 88;
            $height = 20;
        }
        else{
            $icon = GMO_SOCIAL_CONNECTION_IMAGES_URL."/line20x20.png";
            $width = 20;
            $height = 20;
        }
        return $this->link("http://line.naver.jp/R/msg/text/?{$this->title}%0D%0A{$this->url}", "LINEで送る", $icon, $width, $height);
    }
    */

    /**
     * @brief Pocket
     */
    /*
    function pocket()
    {
        $options = gmo_social_connection_options();
        return $this->link_raw('<a href="https://getpocket.com/save" class="pocket-btn" data-lang="en" data-save-url="' . $this->url . '" data-pocket-count="' . $options['pocket']['button_type'] . '" data-pocket-align="left" >Pocket</a><script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>');
    }
    */

}

/**
 * class method
 * @return array
 */
function gmo_social_connection_get_class_methods(){
    $all_methods = get_class_methods('GmoSocialConnection');
    $except_methods = array('GmoSocialConnection', 'gmosocialconnection', 'to_utf8', 'link_raw', 'link', 'get_methods');
    $methods = array();
    foreach($all_methods as $method){
        if(in_array($method, $except_methods)){
            continue;
        }
        $methods[] = $method;
    }
    return $methods;
}
