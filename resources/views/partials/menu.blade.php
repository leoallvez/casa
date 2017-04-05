<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      <li><a><i class="fa fa-file"></i>Cadastros<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ action("AdotivoController@index") }}">Adotivos</a></li>
          <li><a href="{{ action("AdotanteController@index") }}">Adotantes</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-list-alt"></i>Relatórios<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ action("RelatorioAdotivoController@index") }}">Adotivo</a></li>
          <li><a href="{{ action("RelatorioAdotanteController@index") }}">Adotante</a></li>
          <li><a href="{{ action("RelatorioOrfanatoController@index") }}">Orfanatos</a></li>
        </ul>
      </li>
      
      <li>
        <a href="{{ action("UsuarioController@index") }}">
          <i class="fa fa-user-plus"></i>
          Usuários
        </a>
      </li>

      <li>
        <a href="{{ action("SolicitaCadastroController@index") }}">
          <i class="fa fa-plus-square"></i>
          Solicitações Pendentes
        </a>
      </li>

      <li>
        <a href="{{ action("VisitaController@index") }}">
          <i class="fa fa-calendar"></i>
          Agenda de Visitas
        </a>
      </li>
    </ul>
  </div>
</div>
