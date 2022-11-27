<?php
enum TipoTransacao : int {
   
    case DESPESA = 1;
    case RECEITA = 2;
}

enum TipoUsuario : int {
   
    case ADMIN = 1;
    case COMUM = 2;
}
?>