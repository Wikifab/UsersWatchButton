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

# Parser function to insert a link changing a tab.
function userswatchbuttonFunctions( $parser ) {
	$parser->setFunctionHook( 'userswatchbutton', array('UsersWatchButton', 'addParser' ));
	//$parser->setFunctionTagHook('displayTutorialsList', array('WfAuthorDiv', 'addSampleParser' ), array());
	return true;
}


//require_once(__DIR__ . "/includes/UsersWatchButton.php");

$wgAutoloadClasses['UsersWatchButton'] = __DIR__ . "/includes/UsersWatchButton.php";
$wgMessagesDirs['UsersWatchButton'][] = __DIR__ . "/i18n";

// Allow translation of the parser function name
$wgExtensionMessagesFiles['UsersWatchButtonMagic'] = __DIR__ . '/UsersWatchButton.i18n.php';
