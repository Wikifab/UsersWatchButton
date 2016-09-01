<?php

namespace CombinedWatchlist;

class NotificationPresentationModel extends \EchoEventPresentationModel {
	public function getIconType() {
		//return 'placeholder';
		return 'edit';
	}

	public function canRender() {
		return true;
	}

	protected function getHeaderMessageKey() {
		$type = $this->event->getExtraParam('rc_type');
		if ($type == \RecentChange::SRC_NEW ) {
			$type = 'create';
		} else {
			$type = 'edit';
		}
		return "combinedwatchlist-notif-header-message-$type";
	}

	public function getHeaderMessage() {
		$msg = $this->msg( $this->getHeaderMessageKey() );

		list( $formattedName, $genderName ) = $this->getAgentForOutput();
		$page = $this->event->getTitle()->getBaseText();
		$msg->params( $formattedName, $genderName, $page );

		return $msg;
	}

	public function getBodyMessage() {
		$key = 'combinedwatchlist-notif-body-message';
		return $this->msg( $key );
	}


	public function getPrimaryLink(){
		return $this->getPageLink($this->event->getTitle(), '', true);
	}


	public function getSecondaryLinks() {
		$links = array( $this->getAgentLink() );
		return $links;

	}
}
