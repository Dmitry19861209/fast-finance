@extends('layouts.app')

@section('content')
    {{ csrf_field() }}
    <h2 id="main-title">Виртуальный аппарат по продаже кофе</h2>

    <!-- money of user -->
    <div class="card text-center">
        <div class="card-header font-weight-bold">Кошелек пользователя</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark-custom">
                <tr>
                    <th scope="col">Номинал (руб.)</th>
                    <th scope="col">Кол-во</th>
                    <th scope="col">Внести 1 ед. номинала</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $item)
                    <tr>
                        <td>{{ $item->value }}</td>
                        <td>{{ $item->count }}</td>
                        <td>
                            <button type="button" class="btn btn-primary">Внести</button>
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
                    <th scope="col">Наименование товара</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Кол-во товара</th>
                    <th scope="col">Выбрать товар</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->count }}</td>
                        <td>
                            <button type="button" class="btn btn-primary">Выбрать</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body" style="padding-top: 0;">
            <table class="table table-bordered display-table">
                <thead>
                <tr>
                    <th colspan="3" class="bg-success">Дисплей </th>
                </tr>
                <tr>
                    <th scope="col">Внесенная сумма</th>
                    <th scope="col">Получить сдачу</th>
                    <th scope="col">Купить товар</th>
                </tr>
                </thead>
                <tbody>
                 <td><input id="pay-sum" readonly value="0"></td>
                 <td>
                     <button type="button" class="btn btn-primary">Сдача</button>
                 </td>
                 <td>
                     <button type="button" class="btn btn-primary">Купить</button>
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
                    <tr>
                        <td>{{ $vmItem->value }}</td>
                        <td>{{ $vmItem->count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/homepage.js') }}"></script>
@endsection