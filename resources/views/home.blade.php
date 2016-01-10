@extends('layouts.dashboard')
@section('content')
   <section class="content-header">
      <h1>
         Главная страница
         <small>Система ИТНК-ОБЗОР</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
         <li class="active">Главная</li>
      </ol>
   </section>
   <section class="content">

   <div class="panel panel-default">
      <div class="panel-body">
         <div class="control-bnts">
            <form method="post" class="inline" action="#"><button type="submit" class="add-btn btn btn-success">Обновить итоговые суммы по организации</button></form>
         </div>
         <table class="list table table-bordered table-hover">
            <thead>
            <tr>
               <th></th>
               <th>Итоговые суммы</th>
               <th>
                  Движимое имущество
               </th>
               <th>
                  Особо ценное движимое имущество
               </th>
               <th>Автомобили</th>
               <th>
                  Здания и сооружения
               </th>
               <th>Земельные участки</th>
            </tr>
            </thead>
            <tbody>
            <tr>
               <td>Балансовая стоимость</td>
               <td>{{number_format($organization->org_carrying_amount, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_movables_carrying_amount, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_value_movables_carrying_amount, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->cars_carrying_amount, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_buildings_carrying_amount, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_parcels_carrying_amount, 2,'.', ' ')}}</td>
            </tr>
            <tr>
               <td>Остаточная стоимость</td>
               <td>{{number_format($organization->org_residual_value, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_movables_residual_value, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_value_movables_residual_value, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_cars_residual_value, 2,'.', ' ')}}</td>
               <td>{{number_format($organization->org_buildings_residual_value, 2,'.', ' ')}}</td>
               <td></td>
            </tr>
            </tbody>
         </table>
      </div>
   </div>

   </section>
@stop