# badnotes

architecture:
php8

- root
    - Model
    - config
        - cli-config.php
        -
    - User
        - User.php
        - UserRepository.php
    - Note
        - Note.php
        - NoteRepository.php


1. user accesses index.php 2a. user clicks register button 2ai. user gets redirected to register.php 2aii. if
   registration is successfull, user gets redirected to login.php 2b. user clicks login button 2bi. user gets redirected
   to login.php 2bii. if login is successfull, user gets redirected to notes.php
   
