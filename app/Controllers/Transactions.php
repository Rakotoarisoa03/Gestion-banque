<?php

namespace App\Controllers;

use App\Models\CompteModel;
use App\Models\ActionModel;


class Transactions extends BaseController
{
    protected $userModel;
    protected $actionModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new CompteModel();
        $this->actionModel = new ActionModel();
        $this->session = session();
    }

    public function withdrawForm()
    {
        echo view('layout/header');
        echo view('transactions/withdraw');
        echo view('layout/footer');
    }

    public function withdraw()
    {
        $post = $this->request->getPost();
        $email = $post['email'] ?? null;
        $password = $post['mot_de_passe'] ?? null;
        $montant = isset($post['montant']) ? (float)$post['montant'] : 0;

        $user = $this->userModel->where('email_client', $email)->first();
        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $this->session->setFlashdata('error', 'Email ou mot de passe incorrect.');
            return redirect()->back()->withInput();
        }
 
        // minimum 50 Ar 
        $old = (float)$user['solde'];
        if ($montant <= 0) {
            $this->session->setFlashdata('error', 'Montant invalide.');
            return redirect()->back()->withInput();
        }

        if ($old - $montant < 50) {
            $this->session->setFlashdata('error', "Solde insuffisant. Solde actuel: {$old} Ar.");
            return redirect()->back()->withInput();
        }

        $new = $old - $montant;
        $this->userModel->update($user['id_compte'], ['solde' => $new, 'date_modification' => date('Y-m-d H:i:s')]);

        $this->actionModel->insert([
            'id_compteclient' => $user['id_compte'],
            'type_action' => 'retrait',
            'ancien_solde' => $old,
            'nouveau_solde' => $new
        ]);

        $this->session->setFlashdata('success', "Retrait réussi. Ancien Solde : {$old} Ar, Montant: {$montant} Ar, Nouveau Solde : {$new} Ar.");
        return redirect()->back()->withInput();    
    }

    public function depositForm()
    {
        echo view('layout/header');
        echo view('transactions/deposit');
        echo view('layout/footer');
    }

    public function deposit()
    {
        $post = $this->request->getPost();
        $email = $post['email'] ?? null;
        $password = $post['mot_de_passe'] ?? null;
        $montant = isset($post['montant']) ? (float)$post['montant'] : 0;

        $user = $this->userModel->where('email_client', $email)->first();
        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $this->session->setFlashdata('error', 'Email ou mot de passe incorrect.');
            return redirect()->back()->withInput();
        }

        if ($montant <= 0) {
            $this->session->setFlashdata('error', 'Montant invalide.');
            return redirect()->back()->withInput();
        }

        $old = (float)$user['solde'];
        $new = $old + $montant;
        $this->userModel->update($user['id_compte'], ['solde' => $new, 'date_modification' => date('Y-m-d H:i:s')]);

        $this->actionModel->insert([
            'id_compteclient' => $user['id_compte'],
            'type_action' => 'depot',
            'ancien_solde' => $old,
            'nouveau_solde' => $new
        ]);

        $this->session->setFlashdata('success', "Dépôt réussi. Ancien Solde : {$old} Ar, Montant: {$montant} Ar, Nouveau Solde : {$new} Ar.");
        return redirect()->back()->withInput();    
    }

    public function balanceForm()
    {
        echo view('layout/header');
        echo view('transactions/balance');
        echo view('layout/footer');
    }

    public function balanceCheck()
    {
        $post = $this->request->getPost();
        $email = $post['email'] ?? null;
        $password = $post['mot_de_passe'] ?? null;

        $user = $this->userModel->where('email_client', $email)->first();
        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $this->session->setFlashdata('error', 'Email ou mot de passe incorrect.');
            return redirect()->back()->withInput();
        }

        return redirect()->to('/transactions/balance/result/' . $user['id_compte']);
    }

    public function balanceResult($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) throw new \CodeIgniter\Exceptions\PageNotFoundException("Utilisateur introuvable");
        echo view('layout/header');
        echo view('transactions/balance_result', ['user' => $user]);
        echo view('layout/footer');
    }

    public function actionsForm()
    {
        echo view('layout/header');
        echo view('transactions/myActions');
        echo view('layout/footer');
    }

    public function listActions()
    {
        $post = $this->request->getPost();
        $email = $post['email'] ?? null;
        $password = $post['mot_de_passe'] ?? null;

        $user = $this->userModel->where('email_client', $email)->first();
        if (!$user || !password_verify($password, $user['mot_de_passe'])) {
            $this->session->setFlashdata('error', 'Email ou mot de passe incorrect.');
            return redirect()->back()->withInput();
        }

        $actions = $this->actionModel->orderBy('date_action', 'DESC')->where('id_compteclient',$user['id_compte'])->findAll();

        echo view('layout/header');
        echo view('transactions/actions_list', ['actions' => $actions, 'user' => $user]);
        echo view('layout/footer');
    }
}
