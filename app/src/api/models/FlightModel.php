<?php

class FlightModel extends Model
{

    deleteFlight($id)
    {
        $sql = "DELETE FROM flights WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}