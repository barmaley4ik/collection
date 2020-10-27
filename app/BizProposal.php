<?php

namespace App;

class BizProposal extends Model
{
    const STATUS_NEW = '1';
    const STATUS_AWAITING_PAYMENT = '2';
    const STATUS_PAYMENT = '3';
    const STATUS_CANCEL = '4';

    
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class)->where('type','=', 0);
    }  

    public function placeFormat()
    {
        return $this->belongsTo(PlaceFormat::class);
    } 
         
    public function isNew()
    {
        return $this->status_id === self::STATUS_NEW;
    }

    public function isPayment()
    {
        return $this->status_id === self::STATUS_PAYMENT;
    }

    public function scopeOrderByDate($query)
    {
        $query->orderBy('created_at');
    }

    public function scopeWhereStatus($query, $status)
    {
        switch ($status) {
            case self::STATUS_NEW: return $query->where('status_id', self::STATUS_NEW);
            case self::STATUS_AWAITING_PAYMENT: return $query->where('status_id', self::STATUS_AWAITING_PAYMENT);
            case self::STATUS_PAYMENT: return $query->where('status_id', self::STATUS_PAYMENT);
            case self::STATUS_CANCEL: return $query->where('status_id', self::STATUS_CANCEL);
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('lower(member) like lower(?)', ["%{$search}%"]);
            });
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->whereStatus($status);
        });
    }    
}