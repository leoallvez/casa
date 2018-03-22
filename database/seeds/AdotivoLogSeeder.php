<?php

use Illuminate\Database\Seeder;
use Casa\AdotivoLog;
use Carbon\Carbon;
use Casa\Adotivo;

class AdotivoLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 51;

        while($id < 1000) {

            foreach(Adotivo::all() as $adotivo) {
                
                $val  = rand(strtotime('2015-01-01'), strtotime('2017-12-01'));
                $data = date('Y-m-d', $val);

                $adotivo->id           = $id;
                $adotivo->matricula    = str_pad($id, 12, "CASA-00000000", STR_PAD_LEFT);
                $adotivo->etnia_id     = rand(1,7);
                $adotivo->restricao_id = rand(1,6);
                $adotivo->created_at   = $data;
                $adotivo->nascimento   = $data;
                $idade = $adotivo->nascimento->diffInYears(Carbon::now());

                if($idade < 18){
                    $adotivo->status_id = rand(1,5);
                }else{
                    $adotivo->status_id = 6;
                }
    
                $log = new AdotivoLog();
                $log->setAll($adotivo, $data);
                $log->salvar();

                $id++;
            }
        }
    }
}
