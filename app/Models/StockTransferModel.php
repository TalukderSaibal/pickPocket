<?php

namespace App\Models;

use CodeIgniter\Model;

class StockTransferModel extends Model
{
    protected $table = 'stock_transfer';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'warehouse_from',
        'warehouse_to',
        'reference_no',
        'transfer_date',
        'product_id',
        'transfer_note',
    ];
}