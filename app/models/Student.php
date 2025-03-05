<?php

class Student
{
    private $table = 'students';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getALlStudents() {
        $this->db->query("SELECT * FROM {$this->table}");

        return $this->db->resultSet();
    }

    public function getStudentById($id) {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function getStudentByNISN($nisn) {
        $this->db->query("SELECT * FROM {$this->table} WHERE nisn = :nisn");
        $this->db->bind(':nisn', $nisn);

        return $this->db->single();
    }

    public function addStudent($data) {
        $query = "INSERT INTO students (nisn, name, address, age) VALUES (:nisn, :name, :address, :age)";

        $this->db->query($query);
        $this->db->bind(':nisn', $data['nisn']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':age', $data['age']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateStudent($data) {
        $query = "UPDATE students SET
                    name  = :name,
                    address  = :address,
                    age  = :age
                    WHERE id = :id";


        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':id', $data['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteStudent($id) {
        $query = "DELETE FROM students WHERE id = :id";

        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPaginatedStudents($limit, $offset, $sortBy, $sortOrder) {
        $query = "SELECT * FROM students ORDER BY $sortBy $sortOrder LIMIT :limit OFFSET :offset";
        $this->db->query($query);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();
    }


    public function countStudents() {
        $this->db->query("SELECT COUNT(*) as total FROM students");
        return $this->db->single()['total'];
    }

    public function searchStudents($keyword, $limit, $offset, $sortBy, $sortOrder) {
        $query = "SELECT * FROM students 
              WHERE name LIKE :keyword OR nisn LIKE :keyword 
              ORDER BY $sortBy $sortOrder 
              LIMIT :limit OFFSET :offset";

        $this->db->query($query);
        $this->db->bind(':keyword', "%$keyword%");
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);

        return $this->db->resultSet();
    }

    public function countSearchStudents($keyword) {
        $this->db->query("SELECT COUNT(*) as total FROM students WHERE name LIKE :keyword OR nisn LIKE :keyword");
        $this->db->bind(':keyword', "%$keyword%");

        return $this->db->single()['total'];
    }
}