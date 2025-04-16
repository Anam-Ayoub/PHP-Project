<?php
// Set page title
$pageTitle = "Dashboard";

// Path to header.php
require_once __DIR__ . '/layout/header.php';

// Path to controllers (going up one level from views)
require_once __DIR__ . '/../controllers/EventController.php';
require_once __DIR__ . '/../controllers/ParticipantController.php';
require_once __DIR__ . '/../controllers/InscriptionController.php';

$eventController = new EventController();
$participantController = new ParticipantController();
$inscriptionController = new InscriptionController();

// Get counts for dashboard
$eventCount = count($eventController->getEvents());
$participantCount = count($participantController->getParticipants());
$registrationCount = count($inscriptionController->getInscriptions());
?>

<div class="dashboard">
    <h2>System Overview</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><?= $eventCount ?></div>
            <div class="stat-label">Events</div>
            <a href="events/list_events.php" class="stat-link">View All</a>
        </div>
        
        <div class="stat-card">
            <div class="stat-value"><?= $participantCount ?></div>
            <div class="stat-label">Participants</div>
            
        </div>
        
        <div class="stat-card">
            <div class="stat-value"><?= $registrationCount ?></div>
            <div class="stat-label">Registrations</div>
            <a href="inscriptions/list_inscriptions.php" class="stat-link">View All</a>
        </div>
    </div>

    <div class="quick-actions">
        <h3>Quick Actions</h3>
        <div class="action-buttons">
            <a href="events/create_event.php" class="btn btn-primary">
                <i class="icon">+</i> Create New Event
            </a>
            <a href="participants/register_participant.php" class="btn btn-secondary">
                <i class="icon">+</i> Register Participant
            </a>
            <a href="inscriptions/list_inscriptions.php" class="btn">
                <i class="icon">📋</i> Manage Registrations
            </a>
        </div>
    </div>

    <div class="recent-events">
        <h3>Upcoming Events</h3>
        <?php
        $events = array_slice($eventController->getEvents(), 0, 3);
        if (count($events) > 0): ?>
            <div class="events-list">
                <?php foreach ($events as $event): ?>
                    <div class="event-item">
                        <div class="event-date">
                            <?= date('M j', strtotime($event['date_evenement'])) ?>
                        </div>
                        <div class="event-details">
                            <h4><?= htmlspecialchars($event['titre']) ?></h4>
                            <p><?= htmlspecialchars(substr($event['description'], 0, 100)) ?>...</p>
                        </div>
                        <a href="events/view_event.php?id=<?= $event['id'] ?>" class="btn btn-sm">View</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="view-all">
                <a href="events/list_events.php" class="btn">View All Events</a>
            </div>
        <?php else: ?>
            <div class="message info">
                No upcoming events. <a href="events/create_event.php">Create your first event</a>.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php 
// Path to footer.php
require_once __DIR__ . '/layout/footer.php'; 
?>