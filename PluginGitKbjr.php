<?php
class PluginGitKbjr{
  public $path_to_repo = null;
  function __construct() {
    require_once(__DIR__.'/lib/Git.php');
  }
  public function active_branch()  {$repo = Git::open($this->path_to_repo);                          return $repo->active_branch();}
  public function set_repo($plugin){$this->path_to_repo = wfGlobals::getAppDir().'/plugin/'.$plugin;}
  public function set_repo_theme($theme){$this->path_to_repo = wfGlobals::getAppDir().'/theme/'.$theme;}
  public function exist(){return wfFilesystem::fileExist($this->path_to_repo.'/.git');}
  public function status()         {$repo = Git::open($this->path_to_repo);                          return $repo->status();}
  public function add()            {$repo = Git::open($this->path_to_repo); $repo->add();            return null;           }
  public function commit($message) {$repo = Git::open($this->path_to_repo); $repo->commit($message); return null;           }
  public function push()           {$repo = Git::open($this->path_to_repo); $repo->push();           return null;           }
  public function pull()           {$repo = Git::open($this->path_to_repo); $repo->pull();           return null;           }
  public function log()            {$repo = Git::open($this->path_to_repo);                          return $repo->log();   }
  public function fetch()          {$repo = Git::open($this->path_to_repo); $repo->fetch();          return null;           }
  public function diff($filename){
    $git_repo = new GitRepo();
    $git_repo->set_repo_path($this->path_to_repo);
    $msg = $git_repo->run("diff $filename");
    return $msg;
  }
  public function log_date_last(){
    $git_repo = new GitRepo();
    $git_repo->set_repo_path($this->path_to_repo);
    $msg = null;
    try {
      /**
       * Handle if no commits.
       */
      $msg = $git_repo->run('log -1 --format="%at"');
      if($msg){
        $msg = trim($msg);
        $msg = date('Y-m-d H:i:s', $msg);
      }
    }
    catch(Exception $e) {
    }
    return $msg;
  }
  public function remote_get_url_origin(){
    $git_repo = new GitRepo();
    $git_repo->set_repo_path($this->path_to_repo);
    try{
      $msg = trim($git_repo->run("remote get-url origin"));
    } catch (Exception $ex) {
      $msg = null;
    }
    return $msg;
  }
}
