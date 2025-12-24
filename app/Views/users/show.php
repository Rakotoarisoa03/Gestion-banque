<div class="card">
    <a class="link-back btn secondary" href="<?= base_url('/') ?>">← Retour</a>
    <h2>Compte: <?= esc($user['nom_client'] . ' ' . $user['prenom_client']) ?></h2>

    <div style="display:flex;gap:20px;align-items:flex-start">
        <div>
            <?php if($user['photo_client']): ?>
                <img class="photo-preview" src="<?= base_url('photo/' . $user['photo_client']) ?>" alt="photo">
            <?php else: ?>
                <div style="width:120px;height:120px;border-radius:8px;background:#eee;display:flex;align-items:center;justify-content:center">Pas de photo</div>
            <?php endif; ?>
        </div>

        <div style="flex:1">
            <table class="table">
                <tr><th>Nom</th><td><?= esc($user['nom_client']) ?></td></tr>
                <tr><th>Prénom</th><td><?= esc($user['prenom_client']) ?></td></tr>
                <tr><th>Email</th><td><?= esc($user['email_client']) ?></td></tr>
                <tr><th>Num CIN</th><td><?= esc($user['numero_cin']) ?></td></tr>
                <tr><th>Téléphone</th><td><?= esc($user['numero_telephone']) ?></td></tr>
                <tr><th>Date naissance</th><td><?= esc($user['date_de_naissance']) ?></td></tr>
                <tr><th>Sexe</th><td><?= esc($user['sexe_client']) ?></td></tr>
                <tr><th>Statut</th><td><?= esc($user['statut_client']) ?></td></tr>
                <?php if($user['statut_client']=='Étudiant(e)'): ?>
                    <tr><th>Domaine étude</th><td><?= esc($user['domaine_etude']) ?></td></tr>
                <?php else: ?>
                    <tr><th>Profession</th><td><?= esc($user['profession_client']) ?></td></tr>
                <?php endif; ?>
                <tr><th>Type compte</th><td><?= esc($user['statut_compte']) ?></td></tr>
                <tr><th>Solde (Ar)</th><td><?= number_format($user['solde'], 2, '.', ' ') ?></td></tr>
            </table>

            <div style="margin-top:12px">
                <a class="btn" href="<?= base_url('accounts/' . $user['id_compte'] . '/edit') ?>">Modifier</a>

                <form style="display:inline" method="post" action="<?= base_url('accounts/' . $user['id_compte'] . '/delete') ?>" onsubmit="return confirmDelete()">
                    <?= csrf_field() ?>
                    <button class="btn secondary" type="submit">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(){
    return confirm('Voulez-vous vraiment supprimer ce compte ? Cette action est irréversible.');
}
</script>
