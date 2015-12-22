<?php if (!defined('APPLICATION')) exit();

// Conversations
$Configuration['Conversations']['Version'] = '2.1.11';

// Database
$Configuration['Database']['Name'] = 'forums';
$Configuration['Database']['Host'] = 'localhost';
$Configuration['Database']['User'] = 'mpe-server';
$Configuration['Database']['Password'] = '#Cookies153';

// Discussants
$Configuration['Discussants']['MaxVisible'] = 20;

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledPlugins
$Configuration['EnabledPlugins']['GettingStarted'] = 'GettingStarted';
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['OpenID'] = TRUE;
$Configuration['EnabledPlugins']['Flagging'] = TRUE;
$Configuration['EnabledPlugins']['ProfileExtender'] = TRUE;
$Configuration['EnabledPlugins']['GoogleSignIn'] = TRUE;
$Configuration['EnabledPlugins']['Gravatar'] = TRUE;
$Configuration['EnabledPlugins']['Tagging'] = TRUE;
$Configuration['EnabledPlugins']['VanillaStats'] = TRUE;
$Configuration['EnabledPlugins']['cleditor'] = TRUE;
$Configuration['EnabledPlugins']['Emotify'] = TRUE;
$Configuration['EnabledPlugins']['Signatures'] = TRUE;
$Configuration['EnabledPlugins']['avatarfirstletter'] = TRUE;
$Configuration['EnabledPlugins']['Discussants'] = TRUE;
$Configuration['EnabledPlugins']['shortprofileurls'] = TRUE;
$Configuration['EnabledPlugins']['VanillaInThisDiscussion'] = TRUE;

// Garden
$Configuration['Garden']['Title'] = 'Forums';
$Configuration['Garden']['Cookie']['Salt'] = 'VU1WCYXA7E';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = '1';
$Configuration['Garden']['Registration']['Method'] = 'Captcha';
$Configuration['Garden']['Registration']['ConfirmEmailRole'] = '3';
$Configuration['Garden']['Registration']['CaptchaPrivateKey'] = '6LdtRQwTAAAAANji0cpepxdSU033yFkpI7vFV6wt';
$Configuration['Garden']['Registration']['CaptchaPublicKey'] = '6LdtRQwTAAAAAOsfQ_OMOHxxypJne4BWVUNZI2Vq';
$Configuration['Garden']['Registration']['InviteExpiration'] = '-1 week';
$Configuration['Garden']['Registration']['InviteRoles']['3'] = '0';
$Configuration['Garden']['Registration']['InviteRoles']['4'] = '0';
$Configuration['Garden']['Registration']['InviteRoles']['8'] = '0';
$Configuration['Garden']['Registration']['InviteRoles']['16'] = '0';
$Configuration['Garden']['Registration']['InviteRoles']['32'] = '0';
$Configuration['Garden']['Email']['SupportName'] = 'Forums';
$Configuration['Garden']['Email']['SupportAddress'] = 'no-reply@matrixpe.net';
$Configuration['Garden']['Email']['UseSmtp'] = '1';
$Configuration['Garden']['Email']['SmtpHost'] = 'mail.zoho.com';
$Configuration['Garden']['Email']['SmtpUser'] = 'no-reply';
$Configuration['Garden']['Email']['SmtpPassword'] = 'MATRIXPEno-reply';
$Configuration['Garden']['Email']['SmtpPort'] = '25';
$Configuration['Garden']['Email']['SmtpSecurity'] = 'ssl';
$Configuration['Garden']['InputFormatter'] = 'Html';
$Configuration['Garden']['Html']['SafeStyles'] = TRUE;
$Configuration['Garden']['Version'] = '2.1.11';
$Configuration['Garden']['RewriteUrls'] = FALSE;
$Configuration['Garden']['Cdns']['Disable'] = FALSE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['SystemUserID'] = '2';
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['HomepageTitle'] = 'MatrixPE';
$Configuration['Garden']['Description'] = 'MatrixPE is a MCPE server based on Skywars.';
$Configuration['Garden']['FavIcon'] = 'favicon_a22c3587b607aa6a.ico';
$Configuration['Garden']['Embed']['Allow'] = TRUE;
$Configuration['Garden']['Embed']['RemoteUrl'] = 'http://matrixpe.net/forum.html';
$Configuration['Garden']['Embed']['ForceDashboard'] = FALSE;
$Configuration['Garden']['Embed']['ForceForum'] = FALSE;
$Configuration['Garden']['TrustedDomains'] = array('');
$Configuration['Garden']['Theme'] = 'bootstrap';
$Configuration['Garden']['ThemeOptions']['Name'] = 'Bootstrap';
$Configuration['Garden']['ThemeOptions']['Styles']['Key'] = 'Superhero';
$Configuration['Garden']['ThemeOptions']['Styles']['Value'] = '%s_superhero';
$Configuration['Garden']['Format']['Hashtags'] = FALSE;

// Plugin

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Profile'] = '1';
$Configuration['Plugins']['GettingStarted']['Registration'] = '1';
$Configuration['Plugins']['GettingStarted']['Categories'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';
$Configuration['Plugins']['Flagging']['UseDiscussions'] = '1';
$Configuration['Plugins']['Flagging']['CategoryID'] = '3';

// ProfileExtender
$Configuration['ProfileExtender']['Fields']['MCPEName']['FormType'] = 'TextBox';
$Configuration['ProfileExtender']['Fields']['MCPEName']['Label'] = 'MCPE Name';
$Configuration['ProfileExtender']['Fields']['MCPEName']['Options'] = '';
$Configuration['ProfileExtender']['Fields']['MCPEName']['OnRegister'] = '1';
$Configuration['ProfileExtender']['Fields']['MCPEName']['Required'] = FALSE;
$Configuration['ProfileExtender']['Fields']['MCPEName']['OnProfile'] = FALSE;

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';
$Configuration['Routes']['XkAoLiop'] = array('profile/$1', 'Internal');

// Vanilla
$Configuration['Vanilla']['Version'] = '2.1.11';

// Last edited by IronDev (68.100.167.186)2015-09-11 00:38:43