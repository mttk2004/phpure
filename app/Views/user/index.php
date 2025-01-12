<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users and Profiles</title>
</head>
<body>
    <h1>Users and Their Profiles</h1>
    <ul>
      <?php foreach ($users as $user) : ?>
                <li>
                    <h2><?= $user['name'] ?> (<?= $user['email'] ?>)</h2>
            <?php if (!empty($user['profile'])) : ?>
                            <p><strong>Bio:</strong> <?= $user['profile']['bio'] ?></p>
            <?php else : ?>
                            <p><em>No profile available</em></p>
            <?php endif; ?>
                </li>
      <?php endforeach; ?>
    </ul>
</body>
</html>
