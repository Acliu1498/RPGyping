{"changed":true,"filter":false,"title":"SignOut.php","tooltip":"/php/SignOut.php","value":"<?php session_start(); ?>\n <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/SignOut.css\">\n\n<html lang=\"en\">\n<head>\n  <meta charset=\"utf-8\">\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">\n  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\n  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>\n</head>\n    <body background=\"../images/maxresdefault.jpg\">\n    <?php\n    if (isset($_POST[\"Yes\"])) {\n        session_destroy();\n        header(\"Location: ../php/Homepage.php\");\n    }\n    if (isset($_POST[\"No\"])) {\n       header(\"Location: ../php/Homepage.php\");\n    }\n    ?>\n        <div class=\"container\">\n            <div class=\"row\">\n                <div class=\"text-center\" style=\"padding-top:300px;\">\n                    <form action=\"SignOut.php\" method=\"post\">\n                        <p>Are you sure you want to sign out?</p>\n                        <p><input type=\"submit\" class=\"btn btn-lg btn-success\" name=\"Yes\" value=\"Yes, please!\"/></p>\n                        <p><input type=\"submit\" class=\"btn btn-lg btn-danger\" name=\"No\" value=\"No, thank you\"/></p>\n                        <p><input type=\"submit\" class=\"btn btn-lg btn-warning\" name=\"#\" value=\"Maybe..\"/></p>\n\n                    </form>\n                </div>\n            </div>\n        </div>\n    </body>\n</html>","undoManager":{"mark":38,"position":41,"stack":[[{"start":{"row":18,"column":8},"end":{"row":18,"column":48},"action":"remove","lines":["header(\"Location: Student_Profile.php\");"],"id":433},{"start":{"row":18,"column":8},"end":{"row":18,"column":55},"action":"insert","lines":["header(\"location:javascript://history.go(-1)\");"]}],[{"start":{"row":18,"column":16},"end":{"row":18,"column":17},"action":"remove","lines":["l"],"id":434}],[{"start":{"row":18,"column":16},"end":{"row":18,"column":17},"action":"insert","lines":[":"],"id":435}],[{"start":{"row":18,"column":16},"end":{"row":18,"column":17},"action":"remove","lines":[":"],"id":436}],[{"start":{"row":18,"column":16},"end":{"row":18,"column":17},"action":"insert","lines":["L"],"id":437}],[{"start":{"row":18,"column":8},"end":{"row":18,"column":55},"action":"remove","lines":["header(\"Location:javascript://history.go(-1)\");"],"id":438},{"start":{"row":18,"column":8},"end":{"row":18,"column":56},"action":"insert","lines":["header('Location: ' . $_SERVER['HTTP_REFERER']);"]}],[{"start":{"row":18,"column":7},"end":{"row":18,"column":56},"action":"remove","lines":[" header('Location: ' . $_SERVER['HTTP_REFERER']);"],"id":439},{"start":{"row":18,"column":7},"end":{"row":18,"column":54},"action":"insert","lines":["header(\"Location: {$_SERVER['HTTP_REFERER']}\");"]}],[{"start":{"row":18,"column":51},"end":{"row":18,"column":52},"action":"remove","lines":["\""],"id":440},{"start":{"row":18,"column":50},"end":{"row":18,"column":51},"action":"remove","lines":["}"]},{"start":{"row":18,"column":49},"end":{"row":18,"column":50},"action":"remove","lines":["]"]},{"start":{"row":18,"column":48},"end":{"row":18,"column":49},"action":"remove","lines":["'"]},{"start":{"row":18,"column":47},"end":{"row":18,"column":48},"action":"remove","lines":["R"]},{"start":{"row":18,"column":46},"end":{"row":18,"column":47},"action":"remove","lines":["E"]},{"start":{"row":18,"column":45},"end":{"row":18,"column":46},"action":"remove","lines":["R"]},{"start":{"row":18,"column":44},"end":{"row":18,"column":45},"action":"remove","lines":["E"]},{"start":{"row":18,"column":43},"end":{"row":18,"column":44},"action":"remove","lines":["F"]},{"start":{"row":18,"column":42},"end":{"row":18,"column":43},"action":"remove","lines":["E"]},{"start":{"row":18,"column":41},"end":{"row":18,"column":42},"action":"remove","lines":["R"]},{"start":{"row":18,"column":40},"end":{"row":18,"column":41},"action":"remove","lines":["_"]},{"start":{"row":18,"column":39},"end":{"row":18,"column":40},"action":"remove","lines":["P"]},{"start":{"row":18,"column":38},"end":{"row":18,"column":39},"action":"remove","lines":["T"]},{"start":{"row":18,"column":37},"end":{"row":18,"column":38},"action":"remove","lines":["T"]},{"start":{"row":18,"column":36},"end":{"row":18,"column":37},"action":"remove","lines":["H"]},{"start":{"row":18,"column":35},"end":{"row":18,"column":36},"action":"remove","lines":["'"]},{"start":{"row":18,"column":34},"end":{"row":18,"column":35},"action":"remove","lines":["["]},{"start":{"row":18,"column":33},"end":{"row":18,"column":34},"action":"remove","lines":["R"]},{"start":{"row":18,"column":32},"end":{"row":18,"column":33},"action":"remove","lines":["E"]},{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"remove","lines":["V"]},{"start":{"row":18,"column":30},"end":{"row":18,"column":31},"action":"remove","lines":["R"]},{"start":{"row":18,"column":29},"end":{"row":18,"column":30},"action":"remove","lines":["E"]},{"start":{"row":18,"column":28},"end":{"row":18,"column":29},"action":"remove","lines":["S"]},{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"remove","lines":["_"]},{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"remove","lines":["$"]},{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"remove","lines":["{"]}],[{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"insert","lines":["H"],"id":441},{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"insert","lines":["o"]},{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"insert","lines":["m"]},{"start":{"row":18,"column":28},"end":{"row":18,"column":29},"action":"insert","lines":["e"]},{"start":{"row":18,"column":29},"end":{"row":18,"column":30},"action":"insert","lines":["p"]},{"start":{"row":18,"column":30},"end":{"row":18,"column":31},"action":"insert","lines":["a"]},{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"insert","lines":["g"]},{"start":{"row":18,"column":32},"end":{"row":18,"column":33},"action":"insert","lines":["e"]},{"start":{"row":18,"column":33},"end":{"row":18,"column":34},"action":"insert","lines":["."]},{"start":{"row":18,"column":34},"end":{"row":18,"column":35},"action":"insert","lines":["p"]},{"start":{"row":18,"column":35},"end":{"row":18,"column":36},"action":"insert","lines":["h"]},{"start":{"row":18,"column":36},"end":{"row":18,"column":37},"action":"insert","lines":["p"]}],[{"start":{"row":18,"column":37},"end":{"row":18,"column":38},"action":"insert","lines":["\""],"id":442}],[{"start":{"row":18,"column":36},"end":{"row":18,"column":37},"action":"remove","lines":["p"],"id":443},{"start":{"row":18,"column":35},"end":{"row":18,"column":36},"action":"remove","lines":["h"]},{"start":{"row":18,"column":34},"end":{"row":18,"column":35},"action":"remove","lines":["p"]},{"start":{"row":18,"column":33},"end":{"row":18,"column":34},"action":"remove","lines":["."]},{"start":{"row":18,"column":32},"end":{"row":18,"column":33},"action":"remove","lines":["e"]},{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"remove","lines":["g"]},{"start":{"row":18,"column":30},"end":{"row":18,"column":31},"action":"remove","lines":["a"]},{"start":{"row":18,"column":29},"end":{"row":18,"column":30},"action":"remove","lines":["p"]},{"start":{"row":18,"column":28},"end":{"row":18,"column":29},"action":"remove","lines":["e"]},{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"remove","lines":["m"]},{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"remove","lines":["o"]},{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"remove","lines":["H"]},{"start":{"row":18,"column":24},"end":{"row":18,"column":25},"action":"remove","lines":[" "]}],[{"start":{"row":18,"column":24},"end":{"row":18,"column":25},"action":"insert","lines":[" "],"id":444},{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"insert","lines":["."]}],[{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"remove","lines":["."],"id":445}],[{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"insert","lines":["."],"id":446}],[{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"remove","lines":["."],"id":447},{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"remove","lines":["\""]},{"start":{"row":18,"column":24},"end":{"row":18,"column":25},"action":"remove","lines":[" "]}],[{"start":{"row":18,"column":24},"end":{"row":18,"column":25},"action":"insert","lines":[" "],"id":448},{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"insert","lines":["\""]},{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"insert","lines":["."]}],[{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"insert","lines":[" "],"id":449}],[{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"remove","lines":[" "],"id":450}],[{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"insert","lines":["$"],"id":451},{"start":{"row":18,"column":28},"end":{"row":18,"column":29},"action":"insert","lines":["_"]},{"start":{"row":18,"column":29},"end":{"row":18,"column":30},"action":"insert","lines":["S"]},{"start":{"row":18,"column":30},"end":{"row":18,"column":31},"action":"insert","lines":["E"]},{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"insert","lines":["S"]},{"start":{"row":18,"column":32},"end":{"row":18,"column":33},"action":"insert","lines":["S"]},{"start":{"row":18,"column":33},"end":{"row":18,"column":34},"action":"insert","lines":["I"]},{"start":{"row":18,"column":34},"end":{"row":18,"column":35},"action":"insert","lines":["O"]},{"start":{"row":18,"column":35},"end":{"row":18,"column":36},"action":"insert","lines":["N"]}],[{"start":{"row":18,"column":36},"end":{"row":18,"column":38},"action":"insert","lines":["[]"],"id":452}],[{"start":{"row":18,"column":37},"end":{"row":18,"column":38},"action":"insert","lines":["p"],"id":453},{"start":{"row":18,"column":38},"end":{"row":18,"column":39},"action":"insert","lines":["r"]},{"start":{"row":18,"column":39},"end":{"row":18,"column":40},"action":"insert","lines":["e"]}],[{"start":{"row":18,"column":39},"end":{"row":18,"column":40},"action":"remove","lines":["e"],"id":454},{"start":{"row":18,"column":38},"end":{"row":18,"column":39},"action":"remove","lines":["r"]},{"start":{"row":18,"column":37},"end":{"row":18,"column":38},"action":"remove","lines":["p"]}],[{"start":{"row":18,"column":37},"end":{"row":18,"column":39},"action":"insert","lines":["\"\""],"id":455}],[{"start":{"row":18,"column":38},"end":{"row":18,"column":39},"action":"insert","lines":["p"],"id":456},{"start":{"row":18,"column":39},"end":{"row":18,"column":40},"action":"insert","lines":["r"]},{"start":{"row":18,"column":40},"end":{"row":18,"column":41},"action":"insert","lines":["e"]},{"start":{"row":18,"column":41},"end":{"row":18,"column":42},"action":"insert","lines":["v"]},{"start":{"row":18,"column":42},"end":{"row":18,"column":43},"action":"insert","lines":["v"]}],[{"start":{"row":18,"column":42},"end":{"row":18,"column":43},"action":"remove","lines":["v"],"id":457}],[{"start":{"row":18,"column":42},"end":{"row":18,"column":43},"action":"insert","lines":["P"],"id":458},{"start":{"row":18,"column":43},"end":{"row":18,"column":44},"action":"insert","lines":["a"]},{"start":{"row":18,"column":44},"end":{"row":18,"column":45},"action":"insert","lines":["g"]},{"start":{"row":18,"column":45},"end":{"row":18,"column":46},"action":"insert","lines":["e"]}],[{"start":{"row":18,"column":48},"end":{"row":18,"column":49},"action":"insert","lines":["."],"id":459}],[{"start":{"row":18,"column":49},"end":{"row":18,"column":51},"action":"insert","lines":["\"\""],"id":460}],[{"start":{"row":18,"column":50},"end":{"row":18,"column":51},"action":"remove","lines":["\""],"id":461}],[{"start":{"row":18,"column":51},"end":{"row":18,"column":52},"action":"insert","lines":["\""],"id":462}],[{"start":{"row":18,"column":51},"end":{"row":18,"column":52},"action":"remove","lines":["\""],"id":463}],[{"start":{"row":18,"column":49},"end":{"row":18,"column":50},"action":"remove","lines":["\""],"id":464},{"start":{"row":18,"column":48},"end":{"row":18,"column":49},"action":"remove","lines":["."]}],[{"start":{"row":18,"column":47},"end":{"row":18,"column":48},"action":"remove","lines":["]"],"id":465},{"start":{"row":18,"column":46},"end":{"row":18,"column":47},"action":"remove","lines":["\""]},{"start":{"row":18,"column":45},"end":{"row":18,"column":46},"action":"remove","lines":["e"]},{"start":{"row":18,"column":44},"end":{"row":18,"column":45},"action":"remove","lines":["g"]},{"start":{"row":18,"column":43},"end":{"row":18,"column":44},"action":"remove","lines":["a"]},{"start":{"row":18,"column":42},"end":{"row":18,"column":43},"action":"remove","lines":["P"]},{"start":{"row":18,"column":41},"end":{"row":18,"column":42},"action":"remove","lines":["v"]},{"start":{"row":18,"column":40},"end":{"row":18,"column":41},"action":"remove","lines":["e"]},{"start":{"row":18,"column":39},"end":{"row":18,"column":40},"action":"remove","lines":["r"]},{"start":{"row":18,"column":38},"end":{"row":18,"column":39},"action":"remove","lines":["p"]},{"start":{"row":18,"column":37},"end":{"row":18,"column":38},"action":"remove","lines":["\""]},{"start":{"row":18,"column":36},"end":{"row":18,"column":37},"action":"remove","lines":["["]},{"start":{"row":18,"column":35},"end":{"row":18,"column":36},"action":"remove","lines":["N"]},{"start":{"row":18,"column":34},"end":{"row":18,"column":35},"action":"remove","lines":["O"]},{"start":{"row":18,"column":33},"end":{"row":18,"column":34},"action":"remove","lines":["I"]},{"start":{"row":18,"column":32},"end":{"row":18,"column":33},"action":"remove","lines":["S"]},{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"remove","lines":["S"]},{"start":{"row":18,"column":30},"end":{"row":18,"column":31},"action":"remove","lines":["E"]},{"start":{"row":18,"column":29},"end":{"row":18,"column":30},"action":"remove","lines":["S"]},{"start":{"row":18,"column":28},"end":{"row":18,"column":29},"action":"remove","lines":["_"]},{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"remove","lines":["$"]}],[{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"remove","lines":["."],"id":466},{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"remove","lines":["\""]}],[{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"insert","lines":["H"],"id":467},{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"insert","lines":["o"]},{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"insert","lines":["e"]}],[{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"remove","lines":["e"],"id":468}],[{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"insert","lines":["e"],"id":469}],[{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"remove","lines":["e"],"id":470}],[{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"insert","lines":["m"],"id":471},{"start":{"row":18,"column":28},"end":{"row":18,"column":29},"action":"insert","lines":["e"]},{"start":{"row":18,"column":29},"end":{"row":18,"column":30},"action":"insert","lines":["p"]},{"start":{"row":18,"column":30},"end":{"row":18,"column":31},"action":"insert","lines":["a"]},{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"insert","lines":["g"]},{"start":{"row":18,"column":32},"end":{"row":18,"column":33},"action":"insert","lines":["e"]},{"start":{"row":18,"column":33},"end":{"row":18,"column":34},"action":"insert","lines":["."]},{"start":{"row":18,"column":34},"end":{"row":18,"column":35},"action":"insert","lines":["p"]},{"start":{"row":18,"column":35},"end":{"row":18,"column":36},"action":"insert","lines":["h"]},{"start":{"row":18,"column":36},"end":{"row":18,"column":37},"action":"insert","lines":["p"]},{"start":{"row":18,"column":37},"end":{"row":18,"column":38},"action":"insert","lines":["\""]}],[{"start":{"row":15,"column":26},"end":{"row":15,"column":27},"action":"insert","lines":["."],"id":472},{"start":{"row":15,"column":27},"end":{"row":15,"column":28},"action":"insert","lines":["."]},{"start":{"row":15,"column":28},"end":{"row":15,"column":29},"action":"insert","lines":["/"]},{"start":{"row":15,"column":29},"end":{"row":15,"column":30},"action":"insert","lines":["p"]},{"start":{"row":15,"column":30},"end":{"row":15,"column":31},"action":"insert","lines":["h"]},{"start":{"row":15,"column":31},"end":{"row":15,"column":32},"action":"insert","lines":["p"]},{"start":{"row":15,"column":32},"end":{"row":15,"column":33},"action":"insert","lines":["/"]}],[{"start":{"row":18,"column":25},"end":{"row":18,"column":26},"action":"insert","lines":["."],"id":473},{"start":{"row":18,"column":26},"end":{"row":18,"column":27},"action":"insert","lines":["."]},{"start":{"row":18,"column":27},"end":{"row":18,"column":28},"action":"insert","lines":["/"]}],[{"start":{"row":18,"column":28},"end":{"row":18,"column":29},"action":"insert","lines":["p"],"id":474},{"start":{"row":18,"column":29},"end":{"row":18,"column":30},"action":"insert","lines":["h"]},{"start":{"row":18,"column":30},"end":{"row":18,"column":31},"action":"insert","lines":["p"]},{"start":{"row":18,"column":31},"end":{"row":18,"column":32},"action":"insert","lines":["/"]}]]},"ace":{"folds":[],"scrolltop":126,"scrollleft":0,"selection":{"start":{"row":18,"column":32},"end":{"row":18,"column":40},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":5,"state":"start","mode":"ace/mode/php"}},"timestamp":1522903801322}