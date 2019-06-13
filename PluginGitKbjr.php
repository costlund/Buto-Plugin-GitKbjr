<?php
class PluginGitKbjr{
  public $path_to_repo = null;
  function __construct() {
    require_once(__DIR__.'/lib/Git.php');
  }
  public function set_repo($plugin){
    $this->path_to_repo = wfGlobals::getAppDir().'/plugin/'.$plugin;
  }
  public function status(){
    $folder_exist = wfFilesystem::fileExist($this->path_to_repo.'/.git');
    if(!$folder_exist){
      return null;
    }else{
      $repo = Git::open($this->path_to_repo);
      $status = $repo->status();
      return $status;
    }
  }
}
