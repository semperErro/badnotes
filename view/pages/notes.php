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
        <div class="col-3 sticky-top vh-100 p-0
            <?= /** @var TextManager $texts */
        $texts->getParam('theme') == 'dark' ? 'sidebar-dark' : 'sidebar-light' ?>"
        >
            <h1><?=
                $texts->getBaseText('app-title'); ?></h1>
            <div class="note-title-item font-weight-bolder" onclick="addNote()">
                <i class="fas fa-plus"></i> <?= $texts->getBaseText('create-note') ?>
            </div>
            <hr/>
            <? /** @var Note $note */
            /** @var TextManager $texts */
            foreach ($texts->getParam('notes') as $note): ?>
                <div class="note-title-item"
                     id="<?= $note->getId() ?>-side"
                     onclick="openNote(<?= $note->getId() ?>)">
                    <?= $note->getTitle() ?>
                </div>
            <? endforeach ?>
        </div>

        <!--Note content-->
        <? $contentTheme = $texts->getParam('theme') == 'dark' ? 'content-dark' : 'content-light' ?>
        <div class="col-9 p-0 <?= $contentTheme ?>">
            <? include "../view/templates/header.php" ?>
            <? /** @var Note $note */
            foreach ($texts->getParam('notes') as $note): ?>
                <div class="note-content" style="display: none" id="<?= $note->getId() ?>">
                    <div class="form-group">
                        <div class="d-flex">
                            <input type="text"
                                   class="note-content-title form-control no-border font-weight-bolder
                                        flex-grow-1  <?= $contentTheme ?>"
                                   id="<?= $note->getId() ?>-title"
                                   value="<?= $note->getTitle() ?>"
                                   oninput="updateSide(<?= $note->getId() ?>)"
                                   placeholder="<?= $texts->getBaseText('title') ?>">
                            <span class="small align-self-center"><?= date('d.m.Y', $note->getDate()) ?></span>
                            <span
                                    id="<?= $note->getId() ?>-save-btn-tooltip"
                                    title="<?= $texts->getBaseText('saved') ?>"
                                    data-placement="left"
                            ></span>
                            <button class="btn btn-sm btn-outline-info align-self-center mx-1"
                                    onclick="saveNote(<?= $note->getId() ?>, true)"

                            ><?= $texts->getBaseText('save') ?></button>
                            <button class="btn btn-sm btn-outline-danger align-self-center mr-1"
                                    data-toggle="modal" data-target="#delete-modal"
                                    onclick="setDeleteNote(<?= $note->getId() ?>)"
                            ><?= $texts->getBaseText('delete') ?></button>

                        </div>
                        <div contenteditable="true"
                             style="white-space: pre-wrap"
                             id="<?= $note->getId() ?>-text"
                             class="note-content-text form-control no-border <?= $contentTheme ?>"><?= $note->getText() ?></div>
                    </div>
                </div>

            <? endforeach ?>
            <!-- The Modal -->
            <div class="modal fade" id="delete-modal">
                <div class="modal-dialog">
                    <div class="modal-content <?= $contentTheme ?>">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"><?= $texts->getBaseText('delete-note') ?></h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <?= $texts->getBaseText('really-delete-note') ?>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger"
                                    onclick="deleteNote()"><?= $texts->getBaseText('delete') ?></button>
                            <button type="button" class="btn btn-sm btn-outline-info" data-dismiss="modal">
                                <?= $texts->getBaseText('cancel') ?></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    .sidebar-light {
        background-color: #17a2b8;
        color: white;
    }

    .sidebar-dark {
        background-color: #0c464f;
        color: #6c757d;
    }

    .content-light {
        background-color: white;
        color: black;
    }

    .content-dark {
        background-color: #343a40;
        color: #6c757d;
    }
    .content-dark:focus {
        background-color: #343a40;
        color: #6c757d;
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
    let openNoteId = <?= $texts->getParam('open-note-id') ?>;
    let deleteNoteId = -1;

    function showText(noteId) {
        alert($(`#${noteId}-text`).text().replace("<br />", "asdfjklaösfj"));
    }

    function openNote(noteId, shellSave) {
        if (noteId < 0) {
            return;
        }

        if (typeof shellSave !== "undefined") {
            if (shellSave) {
                saveNote(openNoteId, false);
            }
        } else {
            saveNote(openNoteId, false);
        }
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
        }).done(function (msg) {
            window.location.reload();
        }).fail(function () {
            alert("<?= $texts->getBaseText('unknown-error') ?>");
        });
    }

    function deleteNote() {
        if (deleteNoteId < 0) {
            return;
        }
        const noteId = deleteNoteId;
        deleteNoteId = -1;
        $.ajax({
            method: 'post',
            url: '/',
            data: {
                action: 'delete_note',
                note_id: noteId
            }
        }).done(function () {
            window.location.reload();
        }).fail(function () {
            alert("<?= $texts->getBaseText('unknown-error') ?>");
        });
    }

    function setDeleteNote(noteId) {
        deleteNoteId = noteId;
    }

    function saveNote(noteId, showSaved) {
        const saveBtnTooltip = $(`#${noteId}-save-btn-tooltip`);
        const titleElement = $(`#${noteId}-title`);
        let title = titleElement.val();
        const text = $(`#${noteId}-text`).html();

        if (title === "") {
            title = "Bad Note";
            titleElement.val(title);
            $(`#${noteId}-side`).text(title);
        }
        $.ajax({
            method: 'post',
            url: '/',
            data: {
                action: 'update_note',
                note_id: noteId,
                title: title,
                text: text
            }
        }).done(function () {
            if (showSaved) {
                saveBtnTooltip.tooltip('show');
                setTimeout(function () {
                    saveBtnTooltip.tooltip('hide');
                }, 2000);
            }
        }).fail(function () {
            alert("<?= $texts->getBaseText('unknown-error') ?>");
        });
    }

    function updateSide(noteId) {
        const title = $(`#${noteId}-title`).val();
        $(`#${noteId}-side`).text(title);
    }

    openNote(openNoteId, false);

</script>