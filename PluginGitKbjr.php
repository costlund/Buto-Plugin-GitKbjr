<?php
class PluginGitKbjr{
  public $path_to_repo = null;
  function __construct() {
    require_once(__DIR__.'/lib/Git.php');
  }
  public function set_repo($plugin){$this->path_to_repo = wfGlobals::getAppDir().'/plugin/'.$plugin;}
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
    $msg = $git_repo->run('log -1 --format="%at"');
    if($msg){
      $msg = trim($msg);
      $msg = date('Y-m-d H:i:s', $msg);
    }
    return $msg;
  }
}
