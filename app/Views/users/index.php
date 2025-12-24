<div class="card" style="margin-top:50px;">
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:30px;justify-items:center; padding:30px;">
        <a href="<?= base_url('accounts/create') ?>" class="card" style="width:200px;height:200px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-decoration:none;color:inherit;">
            <div style="font-size:36px">👤</div>
            <div style="margin-top:8px">Créer un compte</div>
        </a>

        <a href="<?= base_url('transactions/withdraw') ?>" class="card" style="width:200px;height:200px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-decoration:none;color:inherit">
            <div style="font-size:36px">💸</div>
            <div style="margin-top:8px">Retrait</div>
        </a>

        <a href="<?= base_url('transactions/deposit') ?>" class="card" style="width:200px;height:200px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-decoration:none;color:inherit">
            <div style="font-size:36px">💰</div>
            <div style="margin-top:8px">Dépôt</div>
        </a>

        <a href="<?= base_url('transactions/balance') ?>" class="card" style="width:200px;height:200px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-decoration:none;color:inherit">
            <div style="font-size:36px">📊</div>
            <div style="margin-top:8px">Consultation solde</div>
        </a>

        <a href="<?= base_url('actions') ?>" class="card" style="width:200px;height:200px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-decoration:none;color:inherit">
            <div style="font-size:36px">📜</div>
            <div style="margin-top:8px">Consultation de toutes les actions</div>
        </a>

        <a href="<?= base_url('account') ?>" class="card" style="width:200px;height:200px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-decoration:none;color:inherit">
            <div style="font-size:36px">⚙️</div>
            <div style="margin-top:8px">Mon Compte</div>
        </a>
    </div>
</div>
