<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>GESTION BANQUE</title>
    <style>
        *{box-sizing:border-box}
        body{font-family:Arial,Helvetica,sans-serif;background:#f6f8fb;margin:0;min-height:100vh;display:flex;flex-direction:column}
        header{background:#0b61a4;color:#fff;padding:12px 20px;text-align:center}
        .container{width:100%;max-width:1100px;margin:18px auto;padding:0 16px}
        .btn{display:inline-block;padding:8px 12px;border-radius:6px;background:#0b61a4;color:#fff;text-decoration:none}
        .btn.secondary{background:#6c757d}
        .form-row{margin-bottom:12px}
        label{display:block;font-size:14px;margin-bottom:6px}
        input[type="text"],input[type="email"],input[type="password"],input[type="date"],select,textarea{width:100%;padding:8px;border:1px solid #ddd;border-radius:6px}
        .small{font-size:13px;color:#666}
        .notification{
            position:fixed;
            right:20px;
            top:20px;
            background:#20c997;
            color:white;
            padding:12px 16px;
            border-radius:8px;
            box-shadow:0 6px 18px rgba(0,0,0,0.12);
            display:none;
            z-index:9999;
        }
        .notification.error{background:#e55353}
        .card{background:#fff;padding:16px;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.04)}
        .footer{padding:12px;text-align:center;background:#222;color:#fff;margin-top:auto}
        .link-back{display:inline-block;margin-bottom:12px}
        .table{width:100%;border-collapse:collapse}
        .table th,.table td{padding:8px;border:1px solid #eee;text-align:left;font-size:14px}
        .photo-preview{width:120px;height:120px;object-fit:cover;border-radius:8px;border:1px solid #ddd}
        .center{display:flex;justify-content:center;align-items:center}
        .styled-file-input {width: 100%;height: 35px;border: 1px solid grey;border-radius: 5px;font-size: 16px;}
        .styled-file-input::file-selector-button {border: 1px solid #0b61a4;border-radius: 3px;background-color: #0b61a4;color: white;cursor: pointer;height:35px}
    </style>
</head>
<body>
<header><h1>GESTION BANQUE</h1></header>

<div class="container">
<?php
// flash messages 
$session = session();
$success = $session->getFlashdata('success');
$error = $session->getFlashdata('error');
?>
<div id="notif" class="notification <?= $error ? 'error' : '' ?>" style="display:none"></div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    var phpSuccess = <?= json_encode($success ?: null) ?>;
    var phpError = <?= json_encode($error ?: null) ?>;
    var notif = document.getElementById('notif');
    if(phpSuccess){
        notif.classList.remove('error');
        notif.innerHTML = phpSuccess;
        notif.style.display = 'block';
        setTimeout(()=> notif.style.display='none', 5000);
    } else if(phpError){
        notif.classList.add('error');
        notif.innerHTML = phpError;
        notif.style.display = 'block';
        setTimeout(()=> notif.style.display='none', 7000);
    }
});
</script>
