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
        <div class="col-3 sticky-top vh-100 p-0" style="background-color: #17a2b8; color: white">
            <h1><?=
                /** @var TextManager $texts */
                $texts->getBaseText('app-title'); ?></h1>
            <? /** @var Note $note */
            /** @var TextManager $texts */
            foreach ($texts->getParam('notes') as $note): ?>
                <div class="note-title-item"
                     onclick="openNote(<?= $note->getId() ?>)">
                    <?= $note->getTitle() ?>
                </div>
            <? endforeach ?>
        </div>
        <!--Note content-->
        <div class="col-9 p-0">
            <? include "../view/templates/header.php" ?>
            <? /** @var Note $note */
            foreach ($texts->getParam('notes') as $note): ?>
                <div class="note-content" style="display: none" id="<?= $note->getId() ?>">
                    <div class="form-group">
                        <div class="d-flex">
                            <input type="text" class="note-content-title form-control no-border font-weight-bolder
                                                        flex-grow-1"
                                   id="<?= $note->getId() ?>-title"
                                   value="<?= $note->getTitle() ?>"
                                   placeholder="<?= $texts->getBaseText('title') ?>">
                            <button class="btn btn-sm btn-outline-info bn-btn"
                                    style="display: inline; padding: 0; border: 0"
                                    onclick="saveNote(<?= $note->getId() ?>)"

                            ><?= $texts->getBaseText('save') ?></button>
                            <span class="small"><?= date('d.m.Y', $note->getDate()) ?></span>

                        </div>
                        <div contenteditable="true"
                             id="<?= $note->getId() ?>-text"
                             class="note-content-text form-control no-border"><?= $note->getText() ?></div>
                    </div>
                </div>
            <? endforeach ?>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap');

    * {

        box-sizing: border-box;

        -webkit-tap-highlight-color: transparent; /* transparent with keyword */
    }

    h1 {
        font-family: 'Bradley Hand', 'Architects Daughter', cursive;
        text-align: center;
        color: #7100fa;
    }

    .no-border {
        border: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        -webkit-appearance: none !important;
    }

    div.no-border {
    }

    div.note-title-item {
        padding: 5px 15px;
        cursor: pointer;
        transition: background-color 300ms;
    }

    div.note-title-item:hover {
        background-color: #1a7688;
    }

    button.bn-btn {
        padding: 1px 15px;
        display: inline;
    }
</style>

<script>
    let openNoteId = <?= $texts->getParam('open-note-id') ?>

    function openNote(noteId) {
        if (noteId === openNoteId) {
            return;
        }
        saveNote(openNoteId);
        document.getElementById(openNoteId).style.display = 'none';
        document.getElementById(noteId).style.display = 'block';
        openNoteId = noteId;
    }

    function addNote() {
        $.ajax({
            method: 'post',
            url: '/',
            data: {
                action: 'create_note',
            }
        }).done(function () {
            alert('Erstellt');
        }).fail(function () {
            alert('Nicht Erstellt');
        });
    }

    function saveNote(noteId) {
        const title = $(`#${noteId}-title`);
        const text = $(`#${noteId}-text`);
        $.ajax({
            method: 'post',
            url: '/',
            data: {
                action: 'update_note',
                noteId: noteId,
                title: title,
                text: text
            }
        }).done(function () {
            alert('Gespeichert');
        }).fail(function () {
            alert('Nicht Gespeichert');
        });
    }
    openNote(openNoteId);
</script>