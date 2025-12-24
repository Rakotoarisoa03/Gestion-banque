<div class="card">
    <a class="link-back btn secondary" href="<?= base_url('/') ?>">← Retour</a>
    <h2>Créer un compte</h2>

    <form action="<?= base_url('accounts/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-row">
            <label>Nom</label>
            <input type="text" name="nom_client" required>
        </div>

        <div class="form-row">
            <label>Prénom</label>
            <input type="text" name="prenom_client" required>
        </div>

        <div class="form-row">
            <label>Photo</label>
            <input type="file" name="photo_client" accept="image/*" class="styled-file-input">
        </div>

        <div class="form-row">
            <label>Email</label>
            <input type="email" name="email_client" required>
        </div>

        <div class="form-row">
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" required>
        </div>

        <div class="form-row">
            <label>Numéro CIN</label>
            <input type="text" name="numero_cin">
        </div>

        <div class="form-row">
            <label>Adresse</label>
            <textarea name="adresse_client"></textarea>
        </div>

        <div class="form-row">
            <label>Numéro téléphone</label>
            <input type="text" name="numero_telephone">
        </div>

        <div class="form-row">
            <label>Date de naissance</label>
            <input type="date" name="date_de_naissance">
        </div>

        <div class="form-row">
            <label>Solde initial (Ar)</label>
            <input type="text" name="solde">
            <div class="small">Le compte doit contenir au minimum 50 Ar.</div>
        </div>

        <div class="form-row">
            <label>Sexe</label>
            <select name="sexe_client">
                <option value="">--</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
            </select>
        </div>

        <div class="form-row">
            <label>Statut</label>
            <select name="statut_client" id="statut_client" onchange="toggleFields()">
                <option value="">--</option>
                <option value="Étudiant(e)">Étudiant(e)</option>
                <option value="Salarié(e)">Salarié(e)</option>
            </select>
        </div>

        <div class="form-row" id="profession_row" style="display:none">
            <label>Profession</label>
            <input type="text" name="profession_client">
        </div>

        <div class="form-row" id="domaine_row" style="display:none">
            <label>Domaine d'étude</label>
            <input type="text" name="domaine_etude">
        </div>

        <div class="form-row">
            <label>Type de compte</label>
            <select name="statut_compte">
                <option value="Courant">Courant</option>
                <option value="Épargne">Épargne</option>
            </select>
        </div>

        <div style="margin-top:12px">
            <button class="btn" type="submit">Valider</button>
            <a class="btn secondary" href="<?= base_url('/') ?>">Retour</a>
        </div>
    </form>
</div>

<script>
function toggleFields(){
    var s = document.getElementById('statut_client').value;
    document.getElementById('profession_row').style.display = s === 'Salarié(e)' ? 'block' : 'none';
    document.getElementById('domaine_row').style.display = s === 'Étudiant(e)' ? 'block' : 'none';
}
</script>
