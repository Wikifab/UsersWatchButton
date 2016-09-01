<?php
# Alert the user that this is not a valid access point to MediaWiki if they try to access the special pages file directly.
if ( !defined( 'MEDIAWIKI' ) ) {
	exit( 1 );
}

$dir = dirname( __FILE__ );

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Users Watch Button',
	'descriptionmsg' => 'userswatchbutton-desc',
	'version' => '1.0',
	'author' => array( 'Pierre Boutet' ),
	'url' => 'https://www.wikifab.org'
);

$wgResourceModules['ext.userswatchbutton.js'] = array(
		'scripts' => 'userswatchbutton.js',
		'styles' => array(),
		'messages' => array(
		),
		'dependencies' => array(
		),
		'position' => 'bottom',
		'localBasePath' => __DIR__ . '',
		'remoteExtPath' => 'UsersWatchButton',
);


$wgHooks['ParserFirstCallInit'][] = 'userswatchbuttonFunctions';
$wgHooks['BeforePageDisplay'][] = 'UsersWatchButton::BeforePageDisplay';

// hooks for notifications with Echo :
$wgHooks['ParserFirstCallInit'][] = 'CombinedWatchlist\\NotificationHook::onParserFirstCallInit';
$wgHooks['RecentChange_save'][] = 'CombinedWatchlist\\NotificationHook::onRecentChange_save';
$wgHooks['EchoGetDefaultNotifiedUsers'][] = 'CombinedWatchlist\\NotificationHook::onEchoGetDefaultNotifiedUsers';


# Parser function to insert a link changing a tab.
function userswatchbuttonFunctions( $parser ) {
	$parser->setFunctionHook( 'userswatchbutton', array('UsersWatchButton', 'addParser' ));
	//$parser->setFunctionTagHook('displayTutorialsList', array('WfAuthorDiv', 'addSampleParser' ), array());
	return true;
}


//require_once(__DIR__ . "/includes/UsersWatchButton.php");

$wgAutoloadClasses['UsersWatchButton'] = __DIR__ . "/includes/UsersWatchButton.php";
$wgAutoloadClasses['CombinedWatchlist\\EventFormatter'] = __DIR__ . "/includes/CombinedWatchlist/EventFormatter.php";
$wgAutoloadClasses['CombinedWatchlist\\NotificationPresentationModel'] = __DIR__ . "/includes/CombinedWatchlist/NotificationPresentationModel.php";
$wgAutoloadClasses['CombinedWatchlist\\NotificationHook'] = __DIR__ . "/includes/CombinedWatchlist/NotificationHook.php";
$wgAutoloadClasses['CombinedWatchlist\\WatchlistModelConnector'] = __DIR__ . "/includes/CombinedWatchlist/WatchlistModelConnector.php";
$wgMessagesDirs['UsersWatchButton'][] = __DIR__ . "/i18n";

// Allow translation of the parser function name
$wgExtensionMessagesFiles['UsersWatchButtonMagic'] = __DIR__ . '/UsersWatchButton.i18n.php';


// connection with the 'Notification' extension ('Echo')
$wgEchoNotificationCategories['combinedwatchlist'] = array(
		'priority' => 3,
		'tooltip' => 'echo-pref-tooltip-combinedwatchlist',
);
$wgEchoNotifications['combinedwatchlist'] = array(
		'category' => 'combinedwatchlist',
		//'bundle' => array( 'web' => true, 'email' => true ),
		'formatter-class' => 'CombinedWatchlist\\EventFormatter',
		'presentation-model' => 'CombinedWatchlist\\NotificationPresentationModel',
		'title-message' => 'combinewatchlist-notif-title-message',
		'email-subject-message' => 'combinewatchlist-notif-email-subject-message',
		'email-body-batch-message' => 'combinewatchlist-notif-email-body-batch-message',
		'title-message' => 'combinewatchlist-notif-title-message',
		'section' => 'message', // 'message' or 'alert'
);

//default email notification period
// -1  : no email
// 0 : instant email
// 1 : every day
// 7 : every weeks
$wgDefaultUserOptions['echo-email-frequency'] = 1;

// Echo notification subscription preference
$wgDefaultUserOptions['echo-subscriptions-web-combinedwatchlist'] = true;
$wgDefaultUserOptions['echo-subscriptions-email-combinedwatchlist'] = true;


