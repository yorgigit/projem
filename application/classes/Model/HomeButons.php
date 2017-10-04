<?php



class Model_HomeButons extends Model

{

    public function getList($dil) {

        

        return DB::select()

            ->from('anasayfa_buton')

            ->where('dili', '=', $dil)

            ->where('aktif', '=', '1')

            ->order_by('sira','ASC')

            ->as_object()

            ->execute();

    }



}