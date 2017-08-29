<?php require_once(__DIR__.'/init.php');?>
<br>
<div class="container">
  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="link" type="text" class="validate">
          <label for="link">Enter link video or playlist</label>
        </div>
      </div>
    </form>
    
    <div class="option-url">
        <a id="getVideo" class="waves-effect waves-light btn" title="Get video/s"><i class="fa fa-spinner fa-pulse fa-1x fa-fw heddin"></i> <i class="material-icons">chevron_right</i></a>
        <a id="getLinks" class="waves-effect waves-light btn" title="Get links  Playlist or video"><i class="fa fa-spinner fa-pulse fa-1x fa-fw heddin"></i> <i class="material-icons ">insert_link</i></a>
        <p>
        <input id="video" value="video" name="typeVideo" type="radio"  checked/>
        <label for="video">Video</label>
        </p>
        <p>
        <input id="playlist" value="playlist" name="typeVideo" type="radio"  />
        <label for="playlist">Playlist</label>
        </p>
        <p>
    </div>
  </div>

  <div id="view-videos" class="view-videos">
  </div>

  <div class="view-links heddin">
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">Links Vidoe</label>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<?php require_once(__DIR__.'/include/footer.php') ;?>

