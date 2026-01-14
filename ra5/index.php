<?php

define ('LOGS', __DIR__.'/var/log');

require 'src/Core/Kernel.php';
require 'src/Infrastructure/Request.php';

use App\Core\Kernel;
use App\Infrastructure\Request;

print "<h1>Nigga Section</h1>";
print "<button onclick=\"alert('I can\'t breathe')\">Press me nigga</button><br>";
print "bitchassnigga<br>";
print "bitchassnigga<br>";
print "bitchassnigga<br>";
print "bitchassnigga<br>";
print "bitchassnigga<br>";
print "Niggatron<br>";
print "Optimus Prime Nigga<br>";
print "Jamalbee<br>";
print "<h1>Twin Section</h1>";
print "hi twin<br>";
print "can i borrow a dollar?<br>";
print "twin?<br>";
print "<h1>Bro Section</h1>";
print "Bro<br>";
print "Brontosaurius<br>";
print "Brotato<br>";
print "Brohemian rhapsody<br>";
print "Brochacho<br>";
print "Fibronacci<br>";
print "<h1>Fibbo Section</h1>";
print "Fibbonacci niggers over here:<br><br>";
function fibonacci($n) {
    if ($n <= 0) {
        return 0;
    } elseif ($n == 1) {
        return 1;
    } else {
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}

for ($i = 0; $i < 5; $i++) {
    print fibonacci($i) . " ";
}
print "<br><br>";

print "<h1>Kernel Request Section</h1>";
$request = new Request();
$app = new Kernel($request);

$app->__destruct();