<?php
    //Primeiro é feito a requisição dos scripts para poder utilizar as classes.
    require "app_lista_tarefas/tarefa.model.php";
    require "app_lista_tarefas/tarefa.service.php";
    require "app_lista_tarefas/conexao.php";

    //Segundo o instaciamento das classes, com seus respectivos parâmetros, caso houver.
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();

    //Ao inserir um novo registro, redirecionar o usuário de volta a página de nova tarefa
    header('Location: nova_tarefa.php?inclusao=1');
?>