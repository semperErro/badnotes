<?php

use model\Note;

/*
 * Params:
 * notes, open-note-id
 */

?>
<div class="container-fluid">
    <!--Sidebar-->
    <div class="row">
        <div class="col-3" style="background-color: lightblue">
            <? /** @var Note $note */
            /** @var TextManager $texts */
            foreach ($texts->getParam('notes') as $note): ?>
                <div class="note-title-item">
                    <?= $note->getTitle() ?>
                </div>
            <? endforeach ?>
        </div>
        <!--Note content-->
        <div class="col-9">
            <? /** @var Note $note */
            foreach ($texts->getParam('notes') as $note): ?>
                <div class="note-content" style="display: none" id="<?= $note->getId() ?>"
                     onclick="openNoteId(<?= $note->getId() ?>)">
                    <div class="form-group">
                        <input type="text" class="note-content-title form-control" value="<?= $note->getTitle() ?>"
                               placeholder="<?= $texts->getBaseText('title') ?>">
                        <textarea class="note-content-text form-control"><?= $note->getText() ?></textarea>
                    </div>
                    <button class="btn btn-primary"><?= $texts->getBaseText('save') ?></button>
                </div>
            <? endforeach ?>
        </div>
    </div>
</div>

<script>
    let openNoteId = <?= $texts->getParam('open-note-id') ?>

    function openNote(noteId) {
        document.getElementById(openNoteId).style.display = 'none';
        document.getElementById(noteId).style.display = 'block';
        openNoteId = noteId;
    }

    openNote(openNoteId);
</script>