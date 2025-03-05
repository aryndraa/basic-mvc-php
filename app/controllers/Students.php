<?php

class Students extends Controller
{
    public function show($id) {
        $data['judul'] = 'Detail';
        $data['students'] = $this->model('Student')->getStudentById($id);
        $this->view('templates/header', $data);
        $this->view('students/show', $data);
        $this->view('templates/footer');
    }

    public function create() {
        $data['judul'] = 'Add Student';
        $this->view('templates/header', $data);
        $this->view('students/create');
        $this->view('templates/footer');
    }

    public function store() {
        if($this->model('Student')->addStudent($_POST) > 0 ) {
            Flasher::setFlash('Success', 'Create Success', 'green');
            header('location: ' . BASEURL );
            exit;
        } else {
            Flasher::setFlash('Failed', 'Create Failed', 'red');
            header('location: ' . BASEURL );
            exit;
        }
    }

    public function edit($id) {
        $data['judul']    = 'Edit Student';
        $data['students'] = $this->model('Student')->getStudentById($id);

        $this->view('templates/header', $data);
        $this->view('students/edit', $data);
        $this->view('students/footer');
    }

    public function update() {

        if( $this->model('Student')->updateStudent($_POST) > 0) {
            Flasher::setFlash('Success', 'Update Success', 'green');
            header('location: ' . BASEURL );
            exit;
        }  else {
            Flasher::setFlash('Failed', 'Update Failed', 'red');
            header('location: ' . BASEURL );
            exit;
        }
    }

    public function delete($id) {
        if( $this->model('Student')->deleteStudent($id) > 0) {
            Flasher::setFlash('Success', 'Dihapus', 'green');
            header('location: ' . BASEURL);
            exit;
        }  else {
            Flasher::setFlash('Failed', 'Dihapus', 'red');
            header('location: ' . BASEURL);
            exit;
        }
    }
}