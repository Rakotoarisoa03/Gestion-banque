<div class="card">
    <a class="link-back btn secondary" href="<?= base_url('/') ?>">← Retour</a>
    <h2>Modifier le compte</h2>

    <form action="<?= base_url('accounts/' . $user['id_compte'] . '/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-row">
            <label>Nom</label>
            <input type="text" name="nom_client" required value="<?= esc($user['nom_client']) ?>">
        </div>

        <div class="form-row">
            <label>Prénom</label>
            <input type="text" name="prenom_client" required value="<?= esc($user['prenom_client']) ?>">
        </div>

        <div class="form-row">
            <label>Photo (laisser vide pour garder)</label>
            <input type="file" name="photo_client" accept="image/*" class="styled-file-input">
        </div>

        <div class="form-row">
            <label>Email</label>
            <input type="email" name="email_client" required value="<?= esc($user['email_client']) ?>">
        </div>

        <div class="form-row">
            <label>Mot de passe (laisser vide pour garder)</label>
            <input type="password" name="mot_de_passe">
        </div>

        <div class="form-row">
            <label>Numéro CIN</label>
            <input type="text" name="numero_cin" value="<?= esc($user['numero_cin']) ?>">
        </div>

        <div class="form-row">
            <label>Adresse</label>
            <textarea name="adresse_client"><?= esc($user['adresse_client']) ?></textarea>
        </div>

        <div class="form-row">
            <label>Numéro téléphone</label>
            <input type="text" name="numero_telephone" value="<?= esc($user['numero_telephone']) ?>">
        </div>

        <div class="form-row">
            <label>Date de naissance</label>
            <input type="date" name="date_de_naissance" value="<?= esc($user['date_de_naissance']) ?>">
        </div>

        <div class="form-row">
            <label>Sexe</label>
            <select name="sexe_client">
                <option value="">--</option>
                <option value="homme" <?= $user['sexe_client']=='homme' ? 'selected' : '' ?>>Homme</option>
                <option value="femme" <?= $user['sexe_client']=='femme' ? 'selected' : '' ?>>Femme</option>
            </select>
        </div>

        <div class="form-row">
            <label>Statut</label>
            <select name="statut_client" id="statut_client_edit" onchange="toggleFieldsEdit()">
                <option value="">--</option>
                <option value="Étudiant(e)" <?= $user['statut_client']=='Étudiant(e)' ? 'selected' : '' ?>>Étudiant(e)</option>
                <option value="Salarié(e)" <?= $user['statut_client']=='Salarié(e)' ? 'selected' : '' ?>>Salarié(e)</option>
            </select>
        </div>

        <div class="form-row" id="profession_row_edit" style="<?= $user['statut_client']=='salarié(e)' ? 'display:block' : 'display:none' ?>">
            <label>Profession</label>
            <input type="text" name="profession_client" value="<?= esc($user['profession_client']) ?>">
        </div>

        <div class="form-row" id="domaine_row_edit" style="<?= $user['statut_client']=='étudiant(e)' ? 'display:block' : 'display:none' ?>">
            <label>Domaine d'étude</label>
            <input type="text" name="domaine_etude" value="<?= esc($user['domaine_etude']) ?>">
        </div>

        <div class="form-row">
            <label>Type de compte</label>
            <select name="statut_compte">
                <option value="Courant" <?= $user['statut_compte']=='Courant' ? 'selected' : '' ?>>Courant</option>
                <option value="Épargne" <?= $user['statut_compte']=='Épargne' ? 'selected' : '' ?>>Épargne</option>
            </select>
        </div>

        <div style="margin-top:12px">
            <button class="btn" type="submit">Modifier</button>
            <a class="btn secondary" href="<?= base_url('/')?>">Retour</a>
        </div>
    </form>
</div>

<script>
function toggleFieldsEdit(){
    var s = document.getElementById('statut_client_edit').value;
    document.getElementById('profession_row_edit').style.display = s === 'Salarié(e)' ? 'block' : 'none';
    document.getElementById('domaine_row_edit').style.display = s === 'Étudiant(e)' ? 'block' : 'none';
}
</script>
