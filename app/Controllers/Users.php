<?php

namespace App\Controllers;

use App\Models\Modelusers;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //get all
        $modelUsers = new Modelusers();
        $data = $modelUsers->findAll();
        // $response = [
        //     'status' => 200,
        //     'error' => "false",
        //     'message' => '',
        //     'totaldata' => count($data),
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
        //get by id
        $modelUsers = new Modelusers();
        $data = $modelUsers->like("id", $id)->get()->getResult();

        if ($data >= 1) {
            // $response = [
            //     'status' => 200,
            //     'error' => "false",
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
        //create
        $modelUsers = new Modelusers();
        // $username = $this->request->getPost('username');
        // $password = $this->request->getPost('password');
        // $email = $this->request->getPost('email');
        // $date = $this->request->getPost('date');
        // $noTelp = $this->request->getPost('noTelp');

        // //belum validasi

        // $modelUsers->insert([
        //     'username' => $username,
        //     'password' => $password,
        //     'email' => $email,
        //     'data' => $date,
        //     'noTelp' => $noTelp,
        // ]);

        $rules = [
            'username' => "required",
            'password' => "required",
            'email' => "required|valid_email",
            'date' => "required",
            'noTelp' => "required",
        ];

        $messages = [
            "username" => [
                "required" => "username is required",
            ],
            "password" => [
                "required" => "password is required",
            ],
            "email" => [
                "required" => "Email required",
                "valid_email" => "Email address is not in format",
            ],
            "date" => [
                "required" => "date is required",
            ],
            "noTelp" => [
                "required" => "Phone Number is required",
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => [],
            ];
        } else {
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
                'email' => $this->request->getVar('email'),
                'date' => $this->request->getVar('date'),
                'noTelp' => $this->request->getVar('noTelp'),
            ];

            $modelUsers->insert($data);

            $response = [
                'status' => 201,
                'error' => 'false',
                'message' => 'Berhasil tambah data',
            ];

            return $this->respond($response, 201);
        }

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
        //update by id

        $modelUsers = new Modelusers();
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'email' => $this->request->getVar('email'),
            'date' => $this->request->getVar('date'),
            'noTelp' => $this->request->getVar('noTelp'),
        ];

        $modelUsers->update($id, $data);
        $response = [
            'status' => 200,
            'error' => 'false',
            'message' => 'Data dengan id ' . $id . ' berhasil diperbarui',
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
        //
    }
}