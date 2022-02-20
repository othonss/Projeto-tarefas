<?php
    //Primeiro é feito a requisição dos scripts para poder utilizar as classes.
    require "app_lista_tarefas/tarefa.model.php";
    require "app_lista_tarefas/tarefa.service.php";
    require "app_lista_tarefas/conexao.php";

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    //Segundo o instaciamento das classes, com seus respectivos parâmetros, caso houver.
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    echo '<pre>';
    print_r($tarefaService);
    echo '</pre>';
?>