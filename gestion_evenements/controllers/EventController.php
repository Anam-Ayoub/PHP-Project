<?php
require_once __DIR__ . '/../models/EventModel.php';

class EventController {
    public function createEvent($data) {
        try {
            $event = new EventModel();
            $event->setEvent(
                htmlspecialchars($data['titre']),
                htmlspecialchars($data['date_evenement']),
                htmlspecialchars($data['description'])
            );

            if ($event->insert()) {
                return ['success' => true, 'message' => 'Event created successfully'];
            }
            return ['success' => false, 'message' => 'Failed to create event'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getEvents() {
        $event = new EventModel();
        $events = $event->read();
        return $events ?: [];
    }

    public function getEvent($id) {
        $event = new EventModel();
        return $event->read($id);
    }

    public function updateEvent($id, $data) {
        try {
            $event = new EventModel();
            $event->setId($id);
            $event->setEvent(
                htmlspecialchars($data['titre']),
                htmlspecialchars($data['date_evenement']),
                htmlspecialchars($data['description'])
            );

            if ($event->update()) {
                return ['success' => true, 'message' => 'Event updated successfully'];
            }
            return ['success' => false, 'message' => 'Failed to update event'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function deleteEvent($id) {
        $event = new EventModel();
        $event->setId($id);
        return $event->delete() 
            ? ['success' => true, 'message' => 'Event deleted successfully']
            : ['success' => false, 'message' => 'Failed to delete event'];
    }
}