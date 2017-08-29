<?php 

class Youtube{

    /* 
        * This Function Get Id Video Or Playlist 
        * @param  url  
        * @param  type playlist or video
        * @return videoID
    */
    public function getID($url,$type = "video"){
        parse_str(preg_replace('/https:\/\/[www|m]\.youtube\.com\/|watch\?|https:\/\/[www|m]\.youtube\.com\/|playlist\?/','',$url));
        if($type == "video"){
            if(isset($v)){return $v;}
            else{return FALSE;}   
        }elseif($type == "playlist"){

            if(isset($list)){return $list;}
            else{return FALSE;}
        }else{return FALSE; } 
    }

    /*
        * This Function Get Information Video
        * @param VideoID
    */
    public function getInfoVideo($videoID){
        $url = "https://www.youtube.com/get_video_info?&video_id={$videoID}&asv=3&el=datailpage&hl=en_US";
        if($videoID != FALSE){
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $vidoedata = curl_exec($ch);
            curl_close($ch);
            parse_str($vidoedata,$vidoe_info);
            $vidoe_info = json_decode(json_encode($vidoe_info));
            $quality = explode(",",$vidoe_info->url_encoded_fmt_stream_map);
            $qualitys = array();
            $number = 0;
            foreach($quality as $value){
                parse_str($value);
                $qualityType = $quality.$type;
                switch($qualityType){
                    case 'hd720video/mp4; codecs="avc1.64001F, mp4a.40.2"':
                        $quality = "750p HD mp4";
                    break;
                    case 'mediumvideo/webm; codecs="vp8.0, vorbis"':
                        $quality = "480p webm";
                    break;
                    case 'mediumvideo/mp4; codecs="avc1.42001E, mp4a.40.2"':
                        $quality = "360p mp4";
                    break;
                    case 'smallvideo/3gpp; codecs="mp4v.20.3, mp4a.40.2"':
                        $quality = "240p 3gpp";
                    break;
                }
                $qualitys[$number]['url'] = $url;
                $qualitys[$number]['quality'] = $quality;
                $number+=1;
            }
            
            $qualitys[count($qualitys)-1]['quality'] = "144p 3gpp";
            $vidoe_info = array(
                'author'    => $vidoe_info->author,
                'title'     => $vidoe_info->title,
                'viewCount' => $vidoe_info->view_count,
                'video'     => $qualitys,
            );
            return $vidoe_info;
        }
        return FALSE;

    }

    public function getIDVideosPlaylist($PlaylistID){
        if($PlaylistID != FALSE){
            $urlPlayList = "https://www.youtube.com/playlist?list=$PlaylistID";
            $htmlContent = file_get_contents($urlPlayList);
            preg_match_all('/<a class="pl-video-title-link yt-uix-tile-link yt-uix-sessionlink  spf-link ".*>/i',$htmlContent, $imgTags); 
            preg_match('/href="([^"]+)/i',$imgTags[0][0], $imgage);
            $id = str_ireplace( 'href="/watch?v=', '',  $imgage[0]);
            $id = explode("&", $id)[0];

            $htmlContent = file_get_contents("https://www.youtube.com/watch?v=$id&list=$PlaylistID");
            preg_match_all('/<a href="\/watch\?v=.+ class=" spf-link  playlist-video clearfix  yt-uix-sessionlink      spf-link ".*>/i',$htmlContent, $imgTags); 
            for ($i = 0; $i < count($imgTags[0]); $i++) {
            preg_match('/href="([^"]+)/i',$imgTags[0][$i], $imgage);
            $id = str_ireplace( 'href="/watch?v=', '',  $imgage[0]);
            $id = explode("&", $id)[0];
            $videosIdPlaylist[] = $id;
            }
            return  $videosIdPlaylist; 
        }

    }
}

/* $url = "https://www.youtube.com/watch?v=5OH-Si4MdRg&list=PLDoPjvoNmBAwCNR-UIRft5YuVlZKrYh20&index=86";
$y = new Youtube();
$id = $y->getID($url);
echo "<pre>";
print_r($y->getInfoVideo($id));
echo "</pre>"; */