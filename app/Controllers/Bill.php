<?php

namespace App\Controllers;

use App\Models\Modelbill;
use CodeIgniter\RESTful\ResourceController;

class Bill extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $modelBill = new Modelbill();
        $data = $modelBill->asArray()->findAll();
        // $response = [
        //     //'status' => '200',
        //     //'error' => 'false',
        //     //'message' => '',
        //     //'totaldata' => count($data),
        //     'data' => $data,
        // ];

        $response = $data;

        return $this->respond($response, 200);

    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $modelBill = new Modelbill();
        $data = $modelBill->like('id', $id)->get()->getResult();

        if (count($data) >= 1) {
            // $response = [
            //     'status' => '200',
            //     'error' => 'false',
            //     'message' => '',
            //     'totaldata' => count($data),
            //     'data' => $data,
            // ];

            $response = $data;

            return $this->respond($response, 200);

        } else {
            return $this->failNotFound("data id " . $id . " tidak ditemukan");

        }

    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    function new () {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $modelBill = new Modelbill();
        // $userId = $this->request->getPost('userId');
        // $name = $this->request->getPost('name');
        // $date = $this->request->getPost('date');
        // $amount = $this->request->getPost('amount');

        // $modelBill->insert([
        //     'userId' => $userId,
        //     'name' => $name,
        //     'date' => $date,
        //     'amount' => $amount,
        // ]);

        $data = [
            'userId' => $this->request->getVar('userId'),
            'name' => $this->request->getVar('name'),
            'date' => $this->request->getVar('date'),
            'amount' => $this->request->getVar('amount'),
        ];

        $modelBill->insert($data);

        $response = [
            'status' => '201',
            'error' => 'false',
            'message' => 'Berhasil tambah bill',
        ];

        // $response = 'Berhasil tambah bill';

        return $this->respond($response, 201);

    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $modelBill = new Modelbill();

        $data = [
            'userId' => $this->request->getVar('userId'),
            'name' => $this->request->getVar('name'),
            'date' => $this->request->getVar('date'),
            'amount' => $this->request->getVar('amount'),
        ];

        //$data = $this->request->getRawInput();
        $modelBill->update($id, $data);
        $response = [
            'status' => 200,
            'error' => 'false',
            'message' => 'Berhasil update data dengan id' . $id,
        ];

        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $modelBill = new Modelbill();

        $data = $modelBill->find($id);

        if ($data) {
            $modelBill->delete($id);
            $response = [
                'status' => 200,
                'error' => 'false',
                'message' => 'Berhasil hapus data dengan id' . $id,
            ];

            return $this->respond($response, 200);

        } else {
            return $this->failNotFound("data id " . $id . " tidak ditemukan");
        }
    }
}