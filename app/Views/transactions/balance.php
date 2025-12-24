<div class="card">
    <a class="link-back btn secondary" href="<?= base_url('/') ?>">← Retour</a>
    <h2>Consultation solde</h2>

    <form action="<?= base_url('transactions/balance') ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-row">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-row">
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" required>
        </div>

        <div style="margin-top:12px">
            <button class="btn" type="submit">Valider</button>
        </div>
    </form>
</div>
