<?php
header('Set-Cookie: test_cookie=123; Path=/');
header('X-Test: PHP-OK');
echo 'PHP fonctionne';
