<?php

namespace App\Controllers;

use App\Models\CompteModel;

class Account extends BaseController
{
    protected $userModel;
    protected $actionModel;
    protected $session;
 
    public function __construct()
    {
        $this->userModel = new CompteModel();
        $this->session = session();
    }

    public function index()
    {
        echo view('layout/header');
        echo view('users/index'); 
        echo view('layout/footer');
    }

    public function create()
    {
        echo view('layout/header');
        echo view('users/create');
        echo view('layout/footer');
    }

    public function store()
    {
        $post = $this->request->getPost();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nom_client' => 'required',
            'prenom_client' => 'required',
            'email_client' => 'required|valid_email|is_unique[comptes.email_client]',
            'mot_de_passe' => 'required|min_length[6]'
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            $this->session->setFlashdata('error', implode('<br>', $validation->getErrors()));
            return redirect()->back()->withInput();
        }

        $photoName = null;
        $file = $this->request->getFile('photo_client');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $photoName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/photos', $photoName);
        }

        $data = [
            'nom_client' => $post['nom_client'],
            'prenom_client' => $post['prenom_client'],
            'photo_client' => $photoName,
            'email_client' => $post['email_client'],
            'mot_de_passe' => password_hash($post['mot_de_passe'], PASSWORD_DEFAULT),
            'numero_cin' => $post['numero_cin'] ?? null,
            'adresse_client' => $post['adresse_client'] ?? null,
            'numero_telephone' => $post['numero_telephone'] ?? null,
            'date_de_naissance' => $post['date_de_naissance'] ?? null,
            'solde' => isset($post['solde']) ? (float)$post['solde'] : 0,
            'sexe_client' => $post['sexe_client'] ?? null,
            'statut_client' => $post['statut_client'] ?? null,
            'profession_client' => $post['profession_client'] ?? null,
            'domaine_etude' => $post['domaine_etude'] ?? null,
            'statut_compte' => $post['statut_compte'] ?? null,
        ];

        $this->userModel->insert($data);

        $this->session->setFlashdata('success', 'Compte créé avec succès.');
        return redirect()->to('/');
    }

    public function showForm()
    {
        echo view('layout/header');
        echo view('users/myAccount');
        echo view('layout/footer');
    }

    public function show()
    {
        $post = $this->request->getPost();
        $email = $post['email'] ?? null;
        $password = $post['mot_de_passe'] ?? null;

        $user = $this->userModel->where('email_client', $email)->first();
        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $this->session->setFlashdata('error', 'Email ou mot de passe incorrect.');
            return redirect()->back()->withInput();
        }
        echo view('layout/header');
        echo view('users/show', ['user' => $user]);
        echo view('layout/footer');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) throw new \CodeIgniter\Exceptions\PageNotFoundException("Utilisateur introuvable");
        echo view('layout/header');
        echo view('users/edit', ['user' => $user]);
        echo view('layout/footer');
    }

    public function update($id)
    {
        $post = $this->request->getPost();
        $user = $this->userModel->find($id);
        if (!$user) return redirect()->back();

        $photoName = $user['photo_client'];
        $file = $this->request->getFile('photo_client');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $photoName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/photos', $photoName);
        }

        $update = [
            'nom_client' => $post['nom_client'],
            'prenom_client' => $post['prenom_client'],
            'photo_client' => $photoName,
            'email_client' => $post['email_client'],
            'mot_de_passe' => !empty($post['mot_de_passe']) ? password_hash($post['mot_de_passe'], PASSWORD_DEFAULT) : $user['mot_de_passe'],
            'numero_cin' => $post['numero_cin'] ?? null,
            'adresse_client' => $post['adresse_client'] ?? null,
            'numero_telephone' => $post['numero_telephone'] ?? null,
            'date_de_naissance' => $post['date_de_naissance'] ?? null,
            'sexe_client' => $post['sexe_client'] ?? null,
            'statut_client' => $post['statut_client'] ?? null,
            'profession_client' => $post['profession_client'] ?? null,
            'domaine_etude' => $post['domaine_etude'] ?? null,
            'statut_compte' => $post['statut_compte'] ?? null,
            'date_modification' => date('Y-m-d H:i:s')
        ];

        $this->userModel->update($id, $update);

        $this->session->setFlashdata('success', 'Compte modifié.');
        return redirect()->back()->withInput();
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) return redirect()->back();

        $this->userModel->delete($id);

        $this->session->setFlashdata('success', 'Compte supprimé.');
        return redirect()->to('/');
    }

    public function servePhoto($filename)
    {
        $path = WRITEPATH . 'uploads/photos/' . $filename;
        if (!file_exists($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Image introuvable");
        }
        $mime = mime_content_type($path);
        return $this->response->setHeader('Content-Type', $mime)->setBody(file_get_contents($path));
    }
}
