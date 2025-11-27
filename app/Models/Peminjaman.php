<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'alat_id',
        'lab_id',
        'tgl_pinjam',
        'tgl_kembali',
        'status_peminjaman',
        'staf_id', // tambahkan jika ada kolom staf_id
    ];

    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function laboratorium(): BelongsTo
    {
        return $this->belongsTo(Laboratorium::class, 'lab_id');
    }

    public function staf(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staf_id');
    }
}