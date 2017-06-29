<?php

namespace Casa\Mail;

use Casa\Usuario;
use Casa\Instituicao;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AprovarSolicitacaoMailable extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $usuario;
    public $instituicao;

    public function __construct(Usuario $usuario, Instituicao $instituicao) {
        $this->usuario = $usuario;
        $this->instituicao = $instituicao;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('email.aprovar_solicitacao');
    }
}
