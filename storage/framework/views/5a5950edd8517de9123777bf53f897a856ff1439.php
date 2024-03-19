<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message de contact</title>
</head>
<body>
    <h1>Message </h1>
    <p><strong>Nom :</strong> <?php echo e($emailData['nom']); ?></p>
    <p><strong>Email :</strong> <?php echo e($emailData['email']); ?></p>
    <p><strong>Téléphone :</strong> <?php echo e($emailData['phone']); ?></p>
    <p><strong>Message :</strong> <?php echo e($emailData['message']); ?></p>
</body>
</html>
<?php /**PATH D:\MASTER II\IONIC CAPACITOR\projet cap\main\f2l-assurance-api\resources\views/contact.blade.php ENDPATH**/ ?>