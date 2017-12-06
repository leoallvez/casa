<?php

use Illuminate\Database\Seeder;
use Casa\AdotivoLog;
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

        while($id < 2000) {

            foreach(Adotivo::all() as $adotivo) {
                
                $val  = rand(strtotime('2015-01-01'), strtotime('2017-12-01'));
                $data = date('Y-m-d', $val);

                $adotivo->id           = $id;
                $adotivo->matricula    = str_pad($id, 12, "CASA-00000000", STR_PAD_LEFT);
                $adotivo->nascimento   = $data;
                $adotivo->etnia_id     = rand(1,7);
                $adotivo->status_id    = rand(1,6);
                $adotivo->restricao_id = rand(1,6);
                $adotivo->created_at   = $data;
    
                $log = new AdotivoLog();
                $log->setAll($adotivo, $data);
                $log->salvar();

                $id++;
            }
        }
    }
}
