<?php
    //Primeiro é feito a requisição dos scripts para poder utilizar as classes.
    require "app_lista_tarefas/tarefa.model.php";
    require "app_lista_tarefas/tarefa.service.php";
    require "app_lista_tarefas/conexao.php";

    /*
        O operador ternario verificará se o valor passado está vindo através de um parâmetro via Global $_GET ou valor estático
        Caso for via global ele considerará o valor da global, caso for estático, considerará o valor estático.
    */
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    //Antes de inserir, será verificado o valor do parâmetro passado através do submit
    if($acao == 'inserir'){
        //Segundo o instaciamento das classes, com seus respectivos parâmetros, caso houver.
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        //Ao inserir um novo registro, redirecionar o usuário de volta a página de nova tarefa
        header('Location: nova_tarefa.php?inclusao=1');
    }else if($acao == 'recuperar'){
        $tarefa = new Tarefa();
        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
    }
?>