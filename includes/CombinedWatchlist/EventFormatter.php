<?php
namespace CombinedWatchlist;

class EventFormatter extends \EchoBasicFormatter {
    /**
     * @param EchoEvent $event
     * @param string $param
     * @param Message $message
     * @param User $user
     */
    protected function processParam( $event, $param, $message, $user ) {


    	parent::processParam( $event, $param, $message, $user );

    	return;

        if ( $param === 'difflink' ) {
            $eventData = $event->getExtra();
            if ( !isset( $eventData['revid'] ) ) {
                $message->params( '' );
                return;
            }
            $this->setTitleLink(
                $event,
                $message,
                array(
                    'class' => 'mw-echo-diff',
                    'linkText' => wfMessage( 'notification-thanks-diff-link' )->text(),
                    'param' => array(
                        'oldid' => $eventData['revid'],
                        'diff' => 'prev',
                    )
                )
            );
        } else {
            parent::processParam( $event, $param, $message, $user );
        }
    }
 }
