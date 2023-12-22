<?php
$connection = require_once 'Connection.php';
$notes = $connection->getNotes();
$currentNote =[
        'id' => '',
        'title' => '',
        'description' => ''
];
if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Note Website</title>
</head>
<body>
<header>
    <h1>Note Website</h1>
</header>

<main>
    <section class="note-form">
        <h2>Add a Note</h2>
        <form id="noteForm" action="save.php" method="post">
            <input hidden name="id" value="<?=$currentNote['id']?>">
            <input type="text" id="title" name="title"
                      placeholder="Note Title" value="<?= $currentNote['title']?>" required>
            <textarea id="description" name="description" placeholder="Note Description"
                      rows="4" required><?=$currentNote['description']?></textarea>

            <button type="submit">
                <?php if ($currentNote['id']) :?>
                Update Note
                <?php else : ?>
                Add Note
                <?php endif; ?>
            </button>
        </form>
    </section>

    <section class="note-list">
        <h2>Notes</h2>
        <!-- add user's name before note -->
        <div id="noteList">
            <?php foreach ($notes as $note) :?>
            <div class="note">
                <div class="title">
                    <a href="?id=<?= $note['id'] ?>"><?= $note['title'] ?></a>
                </div>
                <div class="description" >
                    <?= $note['description'] ?>
                </div>
                <small><?= $note['date'] ?></small>
                <form method="post" action="delete.php">
                    <input hidden name="id" value="<?=$note['id']?>">
                    <button class="close">X</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>
</html>

