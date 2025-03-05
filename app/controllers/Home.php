<?php

class Home extends Controller
{
    public function index($page = 1, $sortBy = 'name', $sortOrder = 'asc') {
        $data['judul'] = 'Data Siswa';
        $studentModel = $this->model('Student');

        $limit = 10;
        $offset = ($page - 1) * $limit;

        $allowedSortColumns = ['name', 'nisn'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'name';
        }

        $sortOrder = strtolower($sortOrder) === 'desc' ? 'DESC' : 'ASC';

        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if (!empty($search)) {
            $data['students'] = $studentModel->searchStudents($search, $limit, $offset, $sortBy, $sortOrder);
            $data['totalPages'] = ceil($studentModel->countSearchStudents($search) / $limit);
        } else {
            $data['students'] = $studentModel->getPaginatedStudents($limit, $offset, $sortBy, $sortOrder);
            $data['totalPages'] = ceil($studentModel->countStudents() / $limit);
        }

        $data['currentPage'] = $page;
        $data['sortBy'] = $sortBy;
        $data['sortOrder'] = $sortOrder;
        $data['search'] = $search;

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

}