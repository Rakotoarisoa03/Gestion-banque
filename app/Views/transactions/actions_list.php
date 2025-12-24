<div class="card">
    <a class="link-back btn secondary" href="<?= base_url('/') ?>">← Retour</a>
    <h2>Liste des actions de <?= esc($user['nom_client'] . ' ' . $user['prenom_client'])?></h2>

    <table class="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Montant</th>
                <th>Ancien Solde</th>
                <th>Nouveau Solde</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($actions as $a): ?>
                <tr>
                    <td><?= esc($a['type_action']) ?></td>
                    <td><?= abs($a['nouveau_solde'] - $a['ancien_solde']) . ' Ar' ?></td>
                    <td><?= $a['ancien_solde'] . ' Ar'?></td>
                    <td><?= $a['nouveau_solde'] . ' Ar'?></td>
                    <td><?= $a['date_action']?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
