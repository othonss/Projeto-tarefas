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
    }else if($acao == 'atualizar'){
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id'])->__set('tarefa', $_POST['tarefa']);
        
        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        if($tarefaService->atualizar()){
            header('location: todas_tarefas.php');
        }
    }else if($acao == 'remover'){
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();
        header('location: todas_tarefas.php');
    }else if($acao = 'marcarRealizada'){
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();
        header('location: todas_tarefas.php');
    }
?>