<?php
session_start();
highlight_string("<?php\n\$_SESSION['session_id'] =\n" . var_export($_SESSION["session_id"], true) . ";\n?>");
highlight_string("<?php\n\$_SESSION['data'] =\n" . var_export($_SESSION["data"], true) . ";\n?>");
?>