# Buto-Plugin-GitKbjr

GIT command.

## Usage

```
wfPlugin::includeonce('git/kbjr');
$git = new PluginGitKbjr();
$git->set_repo('wf/mysql');
echo $git->status();
```
