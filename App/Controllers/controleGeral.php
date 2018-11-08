<?php


class controleGeral {
           
    
    function __construct() {
        if( !isset($_SESSION['usuario_logado'])){
            View::includeHeader("BibDW2 - Página Inicial");
            View::formFuncLogin();
            view::includeFooter();
        }
        else if( ! isset( $_REQUEST["acao"] )  ) { // requisao para nomedohost/index.php
            View::includeHeader("BibDW2 - Página Inicial");            
            ?>
            <br>1º Incremento, 11/09 - 4ª Entrega (N4, 15%):
            <br>- <strike>Manter Paciente</strike>
            <br>- <strike>Maner Atendente-----MANIPULAR FUNCIONARIO</strike>
            <br>- <strike>Manter Médico-------MANIPULAR FUNCIONARIO</strike>
            <br>- <strike>Manter Carteira de Vacinação;</strike>
            <br>- <strike>Manter Vacina.</strike>
            <br>
            <br>2º Entrega, 23/10 - 5º Entrega (N5, 25%):
            <br>- <strike>Agendar Vacinação;</strike>
            <br>- <strike>Consultar Carteira de Vacinação;</strike>
            <br>- <strike>Relatório de Vacinação;</strike>
            <br>- <strike>Manter Medicamento</strike>;
            <br>- <strike>Gerar Relatório de Estoque de Medicamentos;</strike>
            <br>- <strike>Agendar Consulta Médica.</strike>
            <br>
            <br>3º Entrega, 04/12 - 6º Entrega (N6, 45%):
            <br>- Efetuar Atendimento ao Paciente (consultar paciente);
            <br>- Consultar Prontuário do Paciente;
            <br>- Inserir em Fila de Cirurgia;
            <br>- Atender Paciente da Fila de Cirurgia;
            <br>- Gerar Relatório de Atendimento (médico/paciente);
            <br>- Gerar Relatório da Fila de Cirurgia (tempo médio etc);
            <br>- Retirar Medicamento.
            <?php
            View::includeFooter();            
        } 
                
    }

           
    
    // abaixo alguns exemplos de metodos do controle geral, que podem ser reaproveitados nas subclasses
        
    
    public function paginaInvalida () {        
        View::includeHeader("Página não encontrada");        
        View::exibirMensagem("Página inválida.", "erro");        
        View::includeFooter();
    }
            
    public function sanitizarForm($form){        
        $dados = array();
        foreach ($form as $key => $value){
                $dados[$key] = htmlspecialchars(trim($value));
        }
        return $dados;        
    }
        
    public function sanitizarString($str){
        return htmlspecialchars(trim($str));
    }
        
    
}
