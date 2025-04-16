<?php
require_once __DIR__ . '/../models/ParticipantModel.php';

class ParticipantController {
    public function registerParticipant($data) {
        try {
            // Validate required fields
            if (empty($data['nom']) || empty($data['email'])) {
                throw new Exception('Name and email are required');
            }

            $model = new ParticipantModel();
            $model->setParticipant(
                htmlspecialchars($data['nom']),
                htmlspecialchars($data['email'])
            );

            if ($model->insert()) {
                // Ensure we have the inserted ID
                $participantId = $model->getId();
                if (!$participantId) {
                    throw new Exception('Failed to get participant ID after registration');
                }

                return [
                    'success' => true,
                    'message' => 'Registration successful',
                    'participant_id' => $participantId
                ];
            }
            throw new Exception('Failed to save participant');
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function getParticipants() {
        $model = new ParticipantModel();
        return $model->read();
    }

    public function getParticipant($id) {
        $model = new ParticipantModel();
        return $model->read($id);
    }
}