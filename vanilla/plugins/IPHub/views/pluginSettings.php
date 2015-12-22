<?php if (!defined('APPLICATION')) exit(); ?>
<h1><?php echo T($this->Data['Title']); ?></h1>
<div class="Info">
   <?php echo T($this->Data['PluginDescription']); ?>
</div>
<h3><?php echo T('Settings'); ?></h3>
<?php
   echo $this->Form->Open();
   echo $this->Form->Errors();
?>
<ul>
   <li><?php
      echo $this->Form->Label('Your e-mail', 'Plugin.IPHub.Email');
      echo $this->Form->Textbox('Plugin.IPHub.Email');
   ?></li>
   It is higly recommended that you enter your e-mail address. That way we can contact you if there is any problem or any planned outages.<br><br>
   <?php
   $pluginVersion = "0.0.3"; // I have no ideia how to get the version number from $PluginInfo['IPHub']['Version']
   $options = array('http' => array('timeout' => 15));
   $context = stream_context_create($options);
   $updateNotification = @file_get_contents("http://iphub.info/plugins/getUpdateNotification.php?plugin=vanilla&pluginVersion={$pluginVersion}", false, $context);
   if($updateNotification !== false) echo htmlentities($updateNotification);
   else echo htmlentities("Failed to contact IPHub.info to get update details. Please manually check if there is any update available on our website. If your server can't connect to us new users will not be checked if they are using a proxy or not.");
   ?>
</ul>
<br>
<?php
   echo $this->Form->Close('Save');
?>
