{"filter":false,"title":"Story5.php","tooltip":"/php/Story5.php","undoManager":{"mark":3,"position":3,"stack":[[{"start":{"row":0,"column":46},"end":{"row":1,"column":0},"action":"insert","lines":["",""],"id":54}],[{"start":{"row":1,"column":0},"end":{"row":1,"column":23},"action":"insert","lines":["<?phpsession_start();?>"],"id":55}],[{"start":{"row":12,"column":19},"end":{"row":12,"column":103},"action":"remove","lines":[" <a class=\"btn btn-warning\" href=\"../php/Sentences.php\" role=\"button\">Skip Story</a>"],"id":56},{"start":{"row":12,"column":19},"end":{"row":16,"column":29},"action":"insert","lines":[" <?php","                        if ($_SESSION[\"userType\"] == \"student\" || $_SESSION[\"userType\"] == \"general\") {","                     ?>","                    <a class=\"btn btn-warning\" href=\"../php/Sentences.php\" role=\"button\">Skip Story</a>","                    <?php }?>"]}],[{"start":{"row":1,"column":5},"end":{"row":1,"column":6},"action":"insert","lines":[" "],"id":57}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":1,"column":6},"end":{"row":1,"column":6},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1524244596213,"hash":"8d850f40b0bddf45d9f626ea72df8ef9dc443dd2"}