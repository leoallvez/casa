<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      @if(Auth::user()->isAdmInstituicao() || Auth::user()->isUsuarioPadrao())
        <li><a><i class="fa fa-file"></i>Cadastros<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{ action("AdotivoController@index") }}">Adotivos</a></li>
              <li><a href="{{ action("AdotanteController@index") }}">Adotantes</a></li>
            </ul>
        </li>
      @endif

      @if(Auth::user()->isAdmInstituicao())
        <li>
          <a href="{{ action("UsuarioController@index") }}">
            <i class="fa fa-user-plus"></i>
            Usuários
          </a>
        </li>
      @endif

      @if(Auth::user()->isAdmSistema())
        <li>
          <a href="{{ action("AdmSistemaController@index") }}">
            <i class="fa fa-user-plus"></i>
            Administradores
          </a>
        </li>
      @endif

      @if(Auth::user()->isAdmSistema())
        <li>
          <a href="{{ action("InstituicaoController@index") }}">
            <i class="fa fa fa-building"></i>
            Instituições
          </a>
        </li>
      @endif

      @if(Auth::user()->isAdmSistema())
        <li>
          <a href="{{ action("SolicitaCadastroController@index") }}">
            <i class="fa fa-plus-square"></i>
            Solicitações Pendentes
          </a>
        </li>
      @endif
      @if(Auth::user()->isAdmInstituicao() || Auth::user()->isUsuarioPadrao())
        <li>
          <a href="{{ action("AgendaController@index") }}">
            <i class="fa fa-calendar"></i>
            Agenda de Visitas
          </a>
        </li>
      @endif

      @if(Auth::user()->isAdmInstituicao())
        <li><a><i class="fa fa-list-alt"></i>Relatórios<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ action("RelatorioAdotivoController@index") }}">Adotivo</a></li>
            <li><a href="{{ action("RelatorioAdotanteController@index") }}">Adotante</a></li>
            <li><a href="{{ action("RelatorioOrfanatoController@index") }}">Orfanatos</a></li>
          </ul>
        </li>
      @endif
    </ul>
  </div>
</div>
