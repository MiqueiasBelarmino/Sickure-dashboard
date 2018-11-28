<?php
require_once '../Models/MyPDO.php';
require_once '../Models/Generic.php';
require_once '../Models/Paciente.php';

$term = $_REQUEST['term'];

$useDB = new Paciente();


$stmt = $useDB->buscaCompleta($term);


$arr = Array(
                'teste1' => Array('id' => 11, 'value' => 'oi', 'oculto' => 'okok'),
                'teste2' => Array('id' => 21, 'value' => 'oi2', 'oculto' => 'gfdgdf'),
                'teste3' => Array('id' => 31, 'value' => 'oi3', 'oculto' => 'ewq'),
                'teste4' => Array('id' => 41, 'value' => 'oi4', 'oculto' => '123123'),
                'teste5' => Array('id' => 51, 'value' => 'oi5', 'oculto' => '321'),
                'teste6' => Array('id' => 123, 'value' => 'outrabusca', 'oculto' => 'teste'),
                'teste7' => Array('id' => 711, 'value' => 'blablablá', 'oculto' => 'outrabusca'),
                'teste8' => Array('id' => 714, 'value' => 'Cesar', 'oculto' => '321', 'CPF' => '33307152866'),
            );

			
$term = $_REQUEST['term'];


$res = Array();


foreach($stmt as $testebusca)
{
    $pos = strpos($testebusca['paciente_nome'], $term);
    if ($pos === false) //Não encontrou nome
    {
        $pos = strpos($testebusca['paciente_cpf'], $term);
        if ($pos === false) //NÃO encontrou CPF
        {
            $pos = strpos($testebusca['paciente_rg'], $term);
            if ($pos === false) //NÃO encontrou RG
            {
                $pos = strpos($testebusca['paciente_cartaoSus'], $term);
                if ($pos === false) //NÃO encontrou SUS
                {
                    break;
                }
                else //Encontrou SUS
                {
                    $testebusca['value'] = $testebusca['paciente_nome']."   -   (RG: ".$testebusca['paciente_cartaoSus'].")";
                }
            }
            else //Encontrou RG
            {
                $testebusca['value'] = $testebusca['paciente_nome']."   -   (RG: ".$testebusca['paciente_rg'].")";
            }
        }
        else //encontrou CPF
        {
            $testebusca['value'] = $testebusca['paciente_nome']."   -   (CPF: ".$testebusca['paciente_cpf'].")";
        }
    }
    else //encontrou nome
    {
        $testebusca['value'] = $testebusca['paciente_nome'];
    }
    $res[] = $testebusca;
}

echo(json_encode($res));

?>