<?php

namespace App\Http\Controllers;

use App\Model\CurrentAccount;
use App\Model\Movement;
use Illuminate\Http\Request;

class CurrentAccountController extends Controller
{

  public function getBalance(Request $request)
  {
    try {
      $data = $request->all();
      $balance = Movement::join('current_accounts as ca', 'movement.current_account_id', '=', 'ca.id')
        ->where('ca.branch', '=', $data['branch'])
        ->where('ca.account', '=', $data['account'])
        ->get(['movement.amount']);

      return $balance->sum('amount');
//      return response()->json(['balance' => $balance->sum('amount')]);
    } catch (\Exception $e) {
      print_r($e->getMessage());
    }
  }

  public function withdrawDeposit(Request $request)
  {
    try {
      $data = json_decode($request->getContent());
      $current_account = CurrentAccount::where('branch', '=', $data->branch)
        ->where('account', '=', $data->account)
        ->first();
      $created = Movement::create(['amount' => $data->amount,
        'current_account_id' => $current_account->id]);
    } catch (\Exception $e) {
      print_r($e->getMessage());
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
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
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
