<?php

namespace Casa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model {

    use SoftDeletes;

    const NIVEL_PADRAO = 3;

    protected $dates = ['created_at'];

    protected $table = "users";

    protected $fillable = [
    	'name',
    	'email',
    	'password',
    	'cpf',
    	'cargo',
    	'nivel_id',
        'instituicao_id',
        'created_at',
    ];
    # atributos que não serão retornardos na response.
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function __construct(array $attributes = array(), $password = null) {
        parent::__construct($attributes);
        $this->instituicao_id = Auth::user()->instituicao_id;
        $password = $password ?? 'casa'.date('Y');
        $this->password = Hash::make($password);
        $this->nivel_id = $nivel_id ?? self::NIVEL_PADRAO;
    } 

    public function setNivel($nivel_id) {
        $this->nivel_id = $nivel_id;
    }
    /**
     * Cria uma hash para a senha informada.
     * @param string $password
     * @return void
     */
    public function setSenha($password) {
        if(!is_null($password)) 
            $this->password = Hash::make($password);
    }

    public function setInstituicao($instituicao_id) {
        $this->instituicao_id = $instituicao_id;
    }
    /**
     * Esse método retorna uma listagem de
     * usuários da instituição do usuário
     * logado no sistema.
     * @return Colletion de Usuario.
     */
    public static function list() {

        $usuarios = self::where('nivel_id','=', self::NIVEL_PADRAO)
        ->where('instituicao_id', Auth::user()->instituicao_id);

        return $usuarios->orderBy('name')->paginate(10);
    }

    public static function fetch($inputBusca, $nivel = self::NIVEL_PADRAO) {

        $usuarios = self::where('nivel_id','=', $nivel)
        ->where('instituicao_id', Auth::user()->instituicao_id);
        # Retirar os espaços do incios e fim da string.
        $inputBusca = trim($inputBusca);

        $usuarios = $usuarios->where('name', 'like', '%'.$inputBusca.'%')
        ->orWhere('cpf','=', setMascara($inputBusca, '###.###.###-##'))
        ->orderBy('name')
        ->paginate(10);

        return $usuarios;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function nivel() {
        return $this->belongsTo('Casa\UsuarioNivel', 'nivel_id');
    }

    public function instituicao() {
        return $this->belongsTo('Casa\Instituicao', 'instituicao_id');
    }
}
