<?php
namespace Casa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* @package  Casa
* @author   Leonardo Alves <leoallvez@hotmail.com>
* @access   public
*/
class Usuario extends Model 
{
    use SoftDeletes;

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

    public function __construct(array $attributes = array(), $password = null) 
    {
        parent::__construct($attributes);
        $this->instituicao_id = Auth::user()->instituicao_id ?? 1;
        $password = $password ?? 'casa'.date('Y');
        $this->password = Hash::make($password);
        $this->nivel_id = $nivel_id ?? UsuarioNivel::PADRAO;
    } 

    public function setNivel($nivel_id) : void
    {
        $this->nivel_id = $nivel_id;
    }

    /**
     * Cria uma hash para a senha informada.
     * @param string $password
     * @return void
     */
    public function setSenha($password) : void
    {
        if (!is_null($password)) 
            $this->password = Hash::make($password);
    }

    /**
     * Cria uma hash para a senha informada.
     * @param int $password $instituicao_id
     * @return void
     */
    public function setInstituicao(int $instituicao_id) : void
    {
        $this->instituicao_id = $instituicao_id;
    }

    /**
     * Retorna uma listagem de
     * usuários da instituição do usuário
     * logado no sistema.
     * @return Colletion de Usuario.
     */
    public static function listar(int $nivel = UsuarioNivel::PADRAO) 
    {
        $usuarios = self::where('nivel_id', $nivel)
        ->where('instituicao_id', Auth::user()->instituicao_id);

        return $usuarios->orderBy('name')->paginate(config('app.list_size'));
    }

    /**
    * @return 
    */
    public static function buscar($inputBusca, $nivel = UsuarioNivel::PADRAO) 
    {
        $usuarios = self::where('nivel_id','=', $nivel)
        ->where('instituicao_id', Auth::user()->instituicao_id);
        #Retirar os espaços do incios e fim da string.
        $inputBusca = trim($inputBusca);

        $usuarios = $usuarios->where('name', 'like', '%'.$inputBusca.'%')
        ->orWhere('cpf','=', setMascara($inputBusca, '###.###.###-##'))
        ->orderBy('name')
        ->paginate(config('app.list_size'));

        return $usuarios;
    }

    /**
    * @return void
    */
    public function setEmail($email) : void
    {
        $this->email = $email;
    }

    /**
    * [description]
    * Método(s) do Eloquent 
    * Definem as relações das models.
    */
    public function nivel() 
    {
        return $this->belongsTo('Casa\UsuarioNivel', 'nivel_id');
    }

    public function instituicao() 
    {
        return $this->belongsTo('Casa\Instituicao', 'instituicao_id');
    }
}
