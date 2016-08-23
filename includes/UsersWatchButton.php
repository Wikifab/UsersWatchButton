<?php
/**
 * class for display author info div
 *
 * @file
 * @ingroup Extensions
 *
 * @author Pierre Boutet
 */

class UsersWatchButton {



	public static function getHtml($user) {
		global $wgUser;

		$usersWatchListCore = new UsersWatchListCore();

		$isFollowing = $usersWatchListCore->getUserIsFollowing($wgUser, $user);

		$class = $isFollowing ? ' followed' : ' unfollowed';
		$styleWatch = $isFollowing ? ' style="display:none"' : '';
		$styleUnWatch = $isFollowing ? '' : ' style="display:none"' ;


		$out = '<a class="UsersWatchButton' . $class . '" data-user="'. $user . '" '.$styleWatch.'>
			  <button class="btn btn-sm btn-message"><i class="fa fa-user-plus"></i> '.wfMessage( 'userswatchbutton-button-text' )->escaped() . '</button>
			  </a>';
		$out.= '<a class="UsersUnWatchButton' . $class . '" data-user="'. $user . '" '.$styleUnWatch.'>
			  <button class="btn btn-sm btn-message"><i class="fa fa-user-times"></i> '.wfMessage( 'userswatchbutton-unwatchbutton-text' )->escaped() . '</button>
			  </a>';

		return $out;
	}

	public static function beforePageDisplay( $out ) {
		$out->addModules( 'ext.userswatchbutton.js' );
	}

	public static function addParser( $input, $type = 'top', $number = 4 ) {



		/*$title = $input->getTitle();

		$page = WikiPage::factory( $title );


		$creator = $page->getCreator();

		if ( ! $creator) {
			// this occur when creating a new page
			return array( '', 'noparse' => true, 'isHTML' => true );
		}

		$data = [];
		$data['creatorId'] = $creator->getId();
		$data['creatorUrl'] = $creator->getUserPage()->getLinkURL();
		$data['creatorName'] = $creator->getName();

		$avatar = new wAvatar( $data['creatorId'], 'ml' );
		$data['creatorAvatar'] = $avatar->getAvatarURL();

		$data['creator'] = $creator->getRealName();
		if ( ! $data['creator']) {
			$data['creator'] = $creator->getName();
		}*/

		$out = '<button class="userswatchbutton">';
		$out .= '</button>';


		return array( $out, 'noparse' => true, 'isHTML' => true );
	}

}