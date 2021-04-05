<?php

namespace App\Exports;
use App\Sale;
// https://docs.laravel-excel.com/3.1/exports/from-view.html
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// 初期状態
// use Maatwebsite\Excel\Concerns\FromCollection;

// class SaleReportExport implements FromCollection
class SaleReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $dateStart;
    private $dateEnd;
    private $sales;
    private $totalSale;
    public function __construct($dateStart, $dateEnd)
    {
        $dateStart = date("Y-m-d H:i:s",strtotime($dateStart));
        $dateEnd = date("Y-m-d H:i:s", strtotime($dateEnd));

        $sales = 
            Sale::whereBetween('updated_at', [$dateStart, $dateEnd])
                ->where('sale_status','paid')->get();
                $totalSale = $sales->sum('total_price');
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->sales = $sales;
        $this->totalSale = $totalSale;
    }
    public function collection()
    {
        return view('exports.salereport', [
            'sales' => $this->sales,
            'totalSale' => $this->totalSale,
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd
        ]);
    }
}
