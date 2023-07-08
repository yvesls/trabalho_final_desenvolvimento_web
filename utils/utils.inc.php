<?php

function exibirMensagem($conteudo, $class, $tempo) {
    $tempo = $tempo."000";
    echo "<div id='mensagem' class='$class w-25 text-white position-relative p-2 mt-2 rounded'>$conteudo</div>";
    echo "<script>
    setTimeout(function() {
        var div = document.getElementById('mensagem');
        div.parentNode.removeChild(div);
    }, $tempo);
    </script>";
}