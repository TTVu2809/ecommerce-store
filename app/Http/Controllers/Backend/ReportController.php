<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportController extends Controller
{
    public function allReport() {
        return view('backend.report.report_view');
    }

    public function reportByDate (Request $request) {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatDate)->latest()->get();
        return view('backend.report.report_by_date', compact('orders', 'formatDate'));
    }

    public function reportByMonth (Request $request) {
        $month = $request->month;
        $year = $request->year_name;
        
        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();
        return view('backend.report.report_by_month', compact('orders', 'month', 'year'));
    }

    public function reportByYear(Request $request) {
        $year = $request->year_name;
        
        $orders = Order::where('order_year', $year)->where('order_year', $year)->latest()->get();
        return view('backend.report.report_by_year', compact('orders', 'year'));
    }

    
}