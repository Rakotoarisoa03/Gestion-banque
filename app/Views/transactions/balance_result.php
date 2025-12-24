<div class="card">
    <a class="link-back btn secondary" href="<?= base_url('/') ?>">← Retour</a>
    <h2>Solde de <?= esc($user['nom_client'].' '.$user['prenom_client']) ?></h2>

    <table class="table">
        <tr><th>ID</th><td><?= $user['id_compte'] ?></td></tr>
        <tr><th>Nom</th><td><?= esc($user['nom_client']) ?></td></tr>
        <tr><th>Prenom</th><td><?= esc($user['prenom_client']) ?></td></tr>
        <tr><th>Email</th><td><?= esc($user['email_client']) ?></td></tr>
        <tr><th>Solde (Ar)</th><td><?= number_format($user['solde'],2,'.',' ') ?></td></tr>
    </table>
</div>
