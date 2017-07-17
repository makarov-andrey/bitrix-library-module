<?php

use Makarov\Library\AdminURL;

if (isset($_POST["save"])) {
    LocalRedirect(AdminURL::LIBRARY_ADMIN_URL_BOOKS);
}