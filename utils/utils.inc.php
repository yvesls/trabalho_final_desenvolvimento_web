<?php

function exibirMensagem($conteudo, $class, $tempo) {
    $tempo = $tempo."000";
    echo "<div id='mensagem' class='$class w-25 text-white position-fixed p-2 ml-5 rounded'>$conteudo</div>";
    echo "<script>
    setTimeout(function() {
        var div = document.getElementById('mensagem');
        div.parentNode.removeChild(div);
    }, $tempo);
    </script>";
}

function converteDataMysql($data) {
    return date('Y-m-d', $data);
}

function formatarData($data) {
    return date('d/m/Y', $data);
}