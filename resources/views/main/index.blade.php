@extends('layouts.app')

@section('content')
    {{ csrf_field() }}
    <h2 id="main-title">Виртуальный аппарат по продаже кофе</h2>

    <!-- money of user -->
    <div class="card text-center">
        <div class="card-header font-weight-bold">Кошелек пользователя</div>
        <div class="card-body">
            <table class="table table-bordered" id="user-money">
                <thead class="thead-dark-custom">
                <tr>
                    <th class="td-id"></th>
                    <th scope="col">Номинал (руб.)</th>
                    <th scope="col">Кол-во</th>
                    <th scope="col">Внести 1 ед. номинала</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $item)
                    <tr class="user-money-rows" user-id-money="{{ $item->id }}">
                        <td class="td-id">{{ $item->id }}</td>
                        <td class="nominal-value">{{ $item->value }}</td>
                        <td class="count">{{ $item->count }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-enter-money">Внести</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Products -->
    <div class="card text-center">
        <div class="card-header font-weight-bold">Ассортимент товаров </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark-custom">
                <tr>
                    <th class="td-id"></th>
                    <th scope="col">Наименование товара</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Кол-во товара</th>
                    <th scope="col">Купить товар</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="product-rows">
                        <td class="td-id">{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td class="count">{{ $product->count }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-buy">Купить</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="alert box alert-success" role="alert">
            Спасибо!
        </div>
        <div class="alert box alert-danger" role="alert">
            Недостаточно средств
        </div>

        <div class="card-body" style="padding-top: 0;">
            <table class="table table-bordered display-table">
                <thead>
                <tr>
                    <th colspan="2" class="bg-success">Дисплей </th>
                </tr>
                <tr>
                    <th scope="col">Внесенная сумма</th>
                    <th scope="col">Получить сдачу</th>
                </tr>
                </thead>
                <tbody>
                 <td><input id="pay-sum" readonly value="{{ $display->pay_sum }}"></td>
                 <td>
                     <button id="money-back" type="button" class="btn btn-primary">Сдача</button>
                 </td>
                </tbody>
            </table>
        </div>
        <!-- money of vm -->
        <div class="card-footer text-muted">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th colspan="2">Кошелек VM </th>
                </tr>
                <tr>
                    <th scope="col">Номинал (руб.)</th>
                    <th scope="col">Кол-во</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vm as $vmItem)
                    <tr class="vm-money-rows" vm-id-money="{{ $vmItem->id }}">
                        <td>{{ $vmItem->value }}</td>
                        <td class="count">{{ $vmItem->count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection