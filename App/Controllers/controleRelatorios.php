<?php


class controleRelatorios extends controleGeral {
        
    function __construct()
    {
        if(isset($_REQUEST['acao']))
        {
            $acao = $this->sanitizarString($_REQUEST['acao']);
            
            if($acao=="relatoriovacinacao")
            {
                View::includeHeader();
                View::relatorioVacinacao();
                View::includeFooter();
            }
            else if($acao=="relatorioestoquemed")
            {
                View::includeHeader();
                ?> <a href="#" onClick="history.go(-1)" class="not_print">Voltar</a> <?php
                View::relatorioEstoqueMed();
                View::includeFooter();
            }

            
            else if($acao=="novo")
            {
                View::includeHeader();
                View::formFuncionario(null, true);
                View::includeFooter();
            }
            
            else if($acao=="relatorios")
            {
                View::includeHeader();
                print("<p><b>Relatorios disponiveis:</b></p>");
                print("<br><a href='?pag=relatorios&acao=relatoriovacinacao'>Vacinação</a>");
                print("<br><a href='?pag=relatorios&acao=relatorioestoquemed'>Estoque de Medicamento</a>");
                View::includeFooter();
            }
            else
            {
                View::includeHeader();
                print("<p><b>ERRO</b></p>");
                print("<br>Função não implementada.");
                View::includeFooter();
            }
        }
        else
        {
            View::includeHeader();
            echo "Ação não escolhida";
            View::includeFooter();
            
            
        }        
        
    } // fim do construtor
    
}