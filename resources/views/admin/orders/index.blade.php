@extends('admin.layout')

@section('title', 'Замовлення')
@section('header', 'Замовлення')

@section('content')

<div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);overflow:hidden">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Дата</th>
        <th>Клієнт</th>
        <th>Сума</th>
        <th>Статус</th>
        <th>Дія</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="6" style="text-align:center;padding:40px;color:var(--text-3)">
          Замовлень поки немає
        </td>
      </tr>
    </tbody>
  </table>
</div>

@endsection