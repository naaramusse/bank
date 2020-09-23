<?php

namespace App\Http\Controllers;

use App\Model\CurrentAccount;
use App\Model\Movement;
use Illuminate\Http\Request;

class CurrentAccountController extends Controller
{

  /**
   * Retorna o saldo da conta.
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function getBalance(Request $request)
  {
    try {
      $data = $request->all();
      $balance = Movement::join('current_accounts as ca', 'movement.current_account_id', '=', 'ca.id')
        ->where('ca.branch', '=', $data['branch'])
        ->where('ca.account', '=', $data['account'])
        ->get(['movement.amount']);

      return response()->json($balance->sum('amount'));
    } catch (\Exception $e) {
      print_r($e->getMessage());
    }
  }

  /**
   * Realiza depósito ou saque na conta. A operação é determinada pelo sinal (positico/negativo) do valor.
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function withdrawDeposit(Request $request)
  {
    try {
      $data = json_decode($request->getContent());
      $current_account = CurrentAccount::where('branch', '=', $data->branch)
        ->where('account', '=', $data->account)
        ->first();
      /** Verifica se a conta existe antes de realizar a operação */
      if (is_null($current_account)) {
        throw new \Exception('Conta não encontrada');
      }
      Movement::create(['amount' => $data->amount,
        'current_account_id' => $current_account->id]);
      return response()->json(($data->amount > 0 ? 'Depósito ' : 'Saque ') . 'realizado com sucesso');
    } catch (\Exception $e) {
      print_r($e->getMessage());
    }
  }
}
