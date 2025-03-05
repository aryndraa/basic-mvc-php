<?php

class Students extends Controller
{
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