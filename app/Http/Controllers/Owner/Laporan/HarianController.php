<?php

namespace App\Http\Controllers\Owner\Laporan;

use App\Http\Controllers\Controller;
use App\Http\Resources\BalanceResource;
use App\Models\Balance;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::statement(DB::raw('SET @total = 0'));

        $harian = Balance::verified()
            ->when(!auth()->user()->hasRole(['admin|super-admin']), function ($query) {
                $query->myCompany();
            })
            ->select('*', DB::raw('@total := @total + (debit - credit) as saldo'))
            ->when(request('query'), function ($query) {
                    $query->where('description', 'like', '%'. request('query') . '%');
            })
            ->when(request('company_id'), function ($query) {
                $query->whereHas('document.category', function ($query) {
                    $query->where('company_id', request('company_id'));
                });
            })
            ->when(request('month'), function ($query) {
                $query->whereMonth('created_at', request('month'));
            })
            ->when(request('year'), function ($query) {
                $query->whereYear('created_at', request('year'));
            })
            ->paginate();

        $companies = Company::get(['id', 'name']);

        return Inertia::render('Laporan/Harian/Index', [
            'harian' => BalanceResource::collection($harian),
            'selectMonth' => $this->getMonth(),
            'selectYear' => $this->getYear(),
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
