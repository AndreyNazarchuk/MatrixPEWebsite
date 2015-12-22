<?php
if (!defined('APPLICATION'))
    exit();
/*
IPHub Proxy/VPN Detection Plugin for Vanilla Forums
Licensed under the GNU GPL v2.0 license
https://github.com/Nixtren/IPHubVanillaPlugin
*/

/* Reminder: Also change version number in all $pluginVersion variables, including pluginSettings.php */
// Define the plugin:
$PluginInfo['IPHub'] = array(
    'Name' => 'IPHub Proxy/VPN Detection',
    'Description' => 'Stops user registration when behind a Proxy/VPN/Hosting Provider IP.',
    'Version' => '0.0.3',
    'RequiredApplications' => array(
        'Vanilla' => '2.1.11'
    ),
    'RequiredTheme' => FALSE,
    'RequiredPlugins' => FALSE,
    'HasLocale' => FALSE,
    'SettingsUrl' => '/plugin/iphub',
    'SettingsPermission' => 'Garden.Settings.Manage',
    'Author' => "Nixtren",
    'AuthorEmail' => 'nixtren@protonmail.ch',
    'AuthorUrl' => 'https://iphub.info'
);

class IPHub extends Gdn_Plugin
{
    
    /**
     * Plugin constructor
     *
     * This fires once per page load, during execution of bootstrap.php. It is a decent place to perform
     * one-time-per-page setup of the plugin object. Be careful not to put anything too strenuous in here
     * as it runs every page load and could slow down your forum.
     */
    public function __construct()
    {
        
    }
    
    public static function isProxy($ip)
    {
        $email = C('Plugins.IPHub.Email');
        $pluginVersion = "0.0.3"; // I have no ideia how to get the version number from $PluginInfo['IPHub']['Version']
        $options = array('http' => array('timeout' => 15));
        $context = stream_context_create($options);
        $api_response = @file_get_contents("http://iphub.info/api.php?ip={$ip}&showtype=4&email={$email}&plugin=vanilla&pluginVersion={$pluginVersion}", false, $context);
        if($api_response === false)
        {
            // Failed to get API response from IPHub.info
            return false;
        }
        $api_response = @json_decode($api_response, true);
        if(isset($api_response['proxy']) && $api_response['proxy'] == 1)
        {
            return true;
        }
        return false;
    }

    /**
     * Base_Render_Before Event Hook
     *
     * This is a common hook that fires for all controllers (Base), on the Render method (Render), just 
     * before execution of that method (Before). It is a good place to put UI stuff like CSS and Javascript 
     * inclusions. Note that all the Controller logic has already been run at this point.
     *
     * @param $Sender Sending controller instance
     */
    public function Base_Render_Before($Sender)
    {
        /*$Sender->AddCssFile($this->GetResource('design/example.css', FALSE, FALSE));
        $Sender->AddJsFile($this->GetResource('js/example.js', FALSE, FALSE));*/
    }
    
    /**
     * Create a method called "Example" on the PluginController
     *
     * One of the most powerful tools at a plugin developer's fingertips is the ability to freely create
     * methods on other controllers, effectively extending their capabilities. This method creates the 
     * Example() method on the PluginController, effectively allowing the plugin to be invoked via the 
     * URL: http://www.yourforum.com/plugin/Example/
     *
     * From here, we can do whatever we like, including turning this plugin into a mini controller and
     * allowing us an easy way of creating a dashboard settings screen.
     *
     * @param $Sender Sending controller instance
     */
    public function PluginController_IPHub_Create($Sender)
    {
        /*
         * If you build your views properly, this will be used as the <title> for your page, and for the header
         * in the dashboard. Something like this works well: <h1><?php echo T($this->Data['Title']); ?></h1>
         */
        $Sender->Title('IPHub Plugin');
        $Sender->AddSideMenu('plugin/iphub');
        
        // If your sub-pages use forms, this is a good place to get it ready
        $Sender->Form = new Gdn_Form();
        
        /*
         * This method does a lot of work. It allows a single method (PluginController::Example() in this case) 
         * to "forward" calls to internal methods on this plugin based on the URL's first parameter following the 
         * real method name, in effect mimicing the functionality of as a real top level controller. 
         *
         * For example, if we accessed the URL: http://www.yourforum.com/plugin/Example/test, Dispatch() here would
         * look for a method called ExamplePlugin::Controller_Test(), and invoke it. Similarly, we we accessed the
         * URL: http://www.yourforum.com/plugin/Example/foobar, Dispatch() would find and call 
         * ExamplePlugin::Controller_Foobar().
         *
         * The main benefit of this style of extending functionality is that all of a plugin's external API is 
         * consolidated under one namespace, reducing the chance for random method name conflicts with other
         * plugins. 
         *
         * Note: When the URL is accessed without parameters, Controller_Index() is called. This is a good place
         * for a dashboard settings screen.
         */
        $this->Dispatch($Sender, $Sender->RequestArgs);
    }
    
    public function Controller_Index($Sender)
    {
        // Prevent non-admins from accessing this page
        $Sender->Permission('Garden.Settings.Manage');
        
        $Sender->SetData('PluginDescription', $this->GetPluginKey('Description'));
        
        $Validation         = new Gdn_Validation();
        $ConfigurationModel = new Gdn_ConfigurationModel($Validation);
        $ConfigurationModel->SetField(array(
            'Plugin.IPHub.Email' => ''
        ));
        
        // Set the model on the form.
        $Sender->Form->SetModel($ConfigurationModel);
        
        // If seeing the form for the first time...
        if ($Sender->Form->AuthenticatedPostBack() === FALSE)
        {
            // Apply the config settings to the form.
            $Sender->Form->SetData($ConfigurationModel->Data);
        }
        else
        {
            //$ConfigurationModel->Validation->ApplyRule('Plugin.IPHub.Email', 'Required');
            
            /*$ConfigurationModel->Validation->ApplyRule('Plugin.IPHub.TrimSize', 'Required');
            $ConfigurationModel->Validation->ApplyRule('Plugin.IPHub.TrimSize', 'Integer');*/
            
            $Saved = $Sender->Form->Save();
            if ($Saved)
            {
                $Sender->StatusMessage = T("Your changes have been saved.");
            }
        }
        
        // GetView() looks for files inside plugins/PluginFolderName/views/ and returns their full path. Useful!
        $Sender->Render($this->GetView('pluginSettings.php'));
    }
    
    /**
     * Add a link to the dashboard menu
     * 
     * By grabbing a reference to the current SideMenu object we gain access to its methods, allowing us
     * to add a menu link to the newly created /plugin/Example method.
     *
     * @param $Sender Sending controller instance
     */
    public function Base_GetAppSettingsMenuItems_Handler($Sender)
    {
        $Menu =& $Sender->EventArguments['SideMenu'];
        $Menu->AddLink('Add-ons', 'IPHub Proxy/VPN Detection', 'plugin/iphub', 'Garden.Settings.Manage');
    }
    
    // Hook here
    public function UserModel_BeforeRegister_Handler($Sender)
    {
        $ip = Gdn::Request()->IpAddress();
        if($this->isProxy($ip))
        {
            $Sender->Validation->AddValidationResult('IPHub', "You are not allowed to register behind a Proxy/VPN/Hosting Provider IP. Please contact IPHub.info if you believe this is an error. Your IP is {$ip}.");
            $Sender->EventArguments['Valid'] = FALSE;
        }
    }
    
    
    /**
     * Plugin setup
     *
     * This method is fired only once, immediately after the plugin has been enabled in the /plugins/ screen, 
     * and is a great place to perform one-time setup tasks, such as database structure changes, 
     * addition/modification ofconfig file settings, filesystem changes, etc.
     */
    public function Setup()
    {
        
        // Set up the plugin's default values
        SaveToConfig('Plugin.IPHub.Email', "");
        
        /*
        // Create table GDN_Example, if it doesn't already exist
        Gdn::Structure()
        ->Table('Example')
        ->PrimaryKey('ExampleID')
        ->Column('Name', 'varchar(255)')
        ->Column('Type', 'varchar(128)')
        ->Column('Size', 'int(11)')
        ->Column('InsertUserID', 'int(11)')
        ->Column('DateInserted', 'datetime')
        ->Column('ForeignID', 'int(11)', TRUE)
        ->Column('ForeignTable', 'varchar(24)', TRUE)
        ->Set(FALSE, FALSE);
        */
    }
    
    /**
     * Plugin cleanup
     *
     * This method is fired only once, immediately before the plugin is disabled, and is a great place to 
     * perform cleanup tasks such as deletion of unsued files and folders.
     */
    public function OnDisable()
    {
        RemoveFromConfig('Plugin.IPHub.Email');
    }
    
}
