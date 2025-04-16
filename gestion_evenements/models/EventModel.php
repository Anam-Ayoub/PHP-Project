<?php
require_once __DIR__ . '/../config/Database.php';

class EventModel extends Database {
    private $id;
    private $titre;
    private $date_evenement;
    private $description;
    private $cnx;

    public function __construct() {
        $this->cnx = $this->connection();
    }

    public function setEvent($titre, $date_evenement, $description) {
        $this->titre = $titre;
        $this->date_evenement = $date_evenement;
        $this->description = $description;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // CREATE
    public function insert() {
        $q = 'INSERT INTO events (titre, date_evenement, description) 
              VALUES (:titre, :date_evenement, :description)';
        $stmt = $this->cnx->prepare($q);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':date_evenement', $this->date_evenement);
        $stmt->bindParam(':description', $this->description);

        return $stmt->execute();
    }

    // READ
    public function read($id = null) {
        if ($id) {
            $q = 'SELECT * FROM events WHERE id = :id';
            $stmt = $this->cnx->prepare($q);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $q = 'SELECT * FROM events ORDER BY date_evenement DESC';
            $stmt = $this->cnx->query($q);
            return $stmt->fetchAll();
        }
    }

    // UPDATE
    public function update() {
        $q = 'UPDATE events SET 
              titre = :titre, 
              date_evenement = :date_evenement, 
              description = :description 
              WHERE id = :id';
        $stmt = $this->cnx->prepare($q);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':date_evenement', $this->date_evenement);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        $q = 'DELETE FROM events WHERE id = :id';
        $stmt = $this->cnx->prepare($q);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}