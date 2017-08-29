<?php 

error_reporting(0);

if(!isset($_POST['link'])){
    echo "<h3 class='error'>Please Enter Link </h3>";
}elseif(!preg_match('/^(https:\/\/[www|m]\.youtube\.com\/)|^(https:\/\/[www|m]\.youtube\.com\/)/',$_POST['link'])){
    echo "<h3 class='error'>Please enter link video or playlist is valid </h3>";    
}
$link = $_POST['link'];
$type = $_POST['type'];
$getLink = $_POST['getLink'];
require_once(__DIR__."/class.youtube.php");
$youtube = new Youtube();
if($getLink == "false"){
    if ($type =='playlist'){
        $playlistID = $youtube->getIDVideosPlaylist($youtube->getID($link,'playlist'));
        echo "<H2>".$playlistID."</h2>";
        $data = '';
        if($playlistID  != FALSE){
        foreach($playlistID as $videoID):
            $infoVideo = $youtube->getInfoVideo($videoID); 
            $data.= '
            <div class="col s8 m7">
                <div class="card horizontal">
                    <div class="card-image">
                        <img width="190" height="190" src="http://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>'.$infoVideo["title"].'</p>
                        </div>

                        <div class="card-action">
                        <div class="quantity">                
                        <div class="row select-qu">
                        <select id="quantity-select">';
                            $index = 0;
                            foreach($infoVideo["video"] as $quality){
                                $data.='<option value="'.$infoVideo["video"][$index]['url'].'&title='.$infoVideo["title"].'">'.$quality['quality'].'</option>';
                                $index+=1;
                            }

            $data.=                '</select> </div></div>
                            <a id="downloadVideo" href="'.$infoVideo["video"][0]['url'].'&title='.$infoVideo["title"].'" class="waves-effect  waves-light btn" title="Get video/s">Download</a>
                        </div>
                    </div>
                </div>
            </div>
            ';
        endforeach;
        echo $data; 
    }else{
        echo "<h3 class='error'>Please enter link video or playlist is valid ||</h3>";    
    }

    }elseif($type == 'video'){
    $videoID   = $youtube->getID($link);
    $infoVideo = $youtube->getInfoVideo($videoID); 
    if($videoID != FALSE && !empty($infoVideo['title'])){
    $data= '
    <div class="col s8 m7">
        <div class="card horizontal">
            <div class="card-image">
                <img width="190" height="190" src="http://img.youtube.com/vi/'.$videoID.'/mqdefault.jpg">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <p>'.$infoVideo["title"].'</p>
                </div>
                <div class="card-action">
                    <div class="quantity">                
                    <div class="row select-qu">
                <select id="quantity-select">';
                    $index = 0;
                    foreach($infoVideo["video"] as $quality){
                        $data.='<option value="'.$infoVideo["video"][$index]['url'].'&title='.$infoVideo["title"].'">'.$quality['quality'].'</option>';
                        $index+=1;
                    }

    $data.=                '</select> </div></div>
                    <a id="downloadVideo" href="'.$infoVideo["video"][0]['url'].'&title='.$infoVideo["title"].'" class="waves-effect  waves-light btn" title="Get video/s">Download</a>
                </div>
            </div>
        </div>
    </div>
    ';
    echo $data; 
    }else{
        echo "<h3 class='error'>Please enter link video or playlist is valid<h3>";    
        
        }
    }

}elseif($getLink == "true"){
    if($type == 'playlist'){
        $playlistID = $youtube->getIDVideosPlaylist($youtube->getID($link,'playlist'));
        $data = '';
        $number = 0;
        if($playlistID  != FALSE){
            foreach($playlistID as $videoID):
                $infoVideo = $youtube->getInfoVideo($videoID);
                $data .= $infoVideo["video"][0]['url']."\n";
                $number +=1;
            endforeach;
        }else{
        echo "Please enter link video or playlist is valid";    
        
        }
        echo $data;
        
    }
    elseif($type == 'video'){
        $videoID = $youtube->getID($link);
        if($videoID  != FALSE){
            $infoVideo = $youtube->getInfoVideo($videoID);
            $data  = $infoVideo["video"][0]['url']."\n";
        }else{
        echo "Please enter link video or playlist is valid";    
        
        }
        echo  $data;
    }

}