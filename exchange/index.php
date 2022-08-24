<?php
header('Content-Type: application/json; charset=utf-8');

$url=null;
$valorConvertido = null;
$tag = null;
$url = explode('/', $_REQUEST['url']);
    
if(is_null($url[0]) || empty($url[0]) || is_null($url[1]) || empty($url[1]) || is_null($url[2]) || empty($url[2]) || is_null($url[3]) || empty($url[3])){http_response_code(404);
    header('Location: /exchange/404.php');
    die();
}
       
$amount = $url[0];
$coin = array(
    'BRL' => $url[3],
    'EUR' => $url[3],
    'USD' => $url[3]
);

if($url[1] == 'BRL' && $url[2] == 'USD'){
    $tag= '$';
    $valorConvertido = $amount * $coin['BRL'];
}
elseif($url[1] == 'USD' && $url[2] == 'BRL'){
    $tag = 'R$';
    $valorConvertido = $amount / $coin['BRL'];

}
elseif($url[1] == 'BRL' && $url[2] == 'EUR'){
    $tag = '€';
    $valorConvertido = $amount * $coin['EUR'];

}
elseif($url[1] == 'EUR' && $url[2] == 'BRL'){
    $tag = 'R$';
    $valorConvertido = $amount / $coin['EUR'];

}
elseif($url[1] == 'USD' && $url[2] == 'EUR'){
   echo "baseamos nossos valores no Real brasileiro(R$);";
   die();
}
elseif($url[1] == 'EUR' && $url[2] == 'USD'){
    echo "baseamos nossos valores no Real brasileiro(R$);";
    die();
}
elseif($url[1] == 'BRL' && $url[2] == 'BRL'){
    $tag = 'R$';
    $valorConvertido =  $coin['BRL'];
}
elseif($url[1] == 'USD' && $url[2] == 'USD'){
    $tag = '$';
    $valorConvertido =  $coin['USD'];
 }
 elseif($url[1] == 'EUR' && $url[2] == 'EUR'){
    $tag = '€';
    $valorConvertido =  $coin['EUR'];
}
else{
    echo "Coloque uma moeda valida, Exemplo: BRL,USD,EUR";
    return http_response_code(400);
    die();
}

$num1 = array(
    'valorConvertido' => $valorConvertido,
    'simboloMoeda' => $tag
);

echo json_encode($num1, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>