<?php
function total()
{
    $disposisi = DB::table('suratmasuks')
                // ->join('log_surats','suratmasuks.id','=','log_surats.id_sm')
                ->where('suratmasuks.notif','2')
                ->count();
        
    $selesai = DB::table('suratmasuks')
                // ->join('log_surats','suratmasuks.id','=','log_surats.id_sm')
                ->where('suratmasuks.notif','3')
                ->count();
    
    return $disposisi + $selesai;
}

function disposisi()
{
    return DB::table('suratmasuks')
        // ->join('log_surats','suratmasuks.id','=','log_surats.id_sm')
        ->where('suratmasuks.notif','2')
        ->count();
}

function disposisi_time()
{
    return DB::table('log_surats')
        ->join('suratmasuks','suratmasuks.id','=','log_surats.id_sm')
        ->where('suratmasuks.notif','2')
        ->where('log_surats.status','DISPOSISI')
        ->orderBy('log_surats.id', 'desc')
        ->select('log_surats.created_at')
        ->first();
}

function selesai()
{
    return DB::table('suratmasuks')
        ->join('log_surats','suratmasuks.id','=','log_surats.id_sm')
        ->where('suratmasuks.notif','3')
        ->count();
}

function selesai_time()
{
    return DB::table('log_surats')
        ->join('suratmasuks','suratmasuks.id','=','log_surats.id_sm')
        ->where('suratmasuks.notif','3')
        ->where('log_surats.status','SELESAI')
        ->orderBy('log_surats.id', 'desc')
        ->select('log_surats.created_at')
        ->first();
}
?>