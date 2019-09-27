@extends('admin.layout.index')
@section('content')
    <div id="page-wrapper">
        <section class="tile transparent">
            <!-- tile header -->
            <div class="tile-header color transparent-black textured rounded-top-corners" style="margin: 20px">
                <?= Form::open(array('url' => 'admin/shops', 'method' => 'get')); ?>
                <div class="row">
                    <div class="col-md-3 col-xs-12 mg_title">
                        <label for="ex1"><?php echo __("action.Search") ?></label>
                        <input type="text" name="searchKey" value="<?= $searchKey ?>" class="form-control" id="ex1"
                               placeholder="Shop, Address, Description...">
                    </div>
                    <div class="col-md-3 col-xs-12 mg_title">
                        <label for="ex4"><?php echo __("action.Created") ?> </label>
                        <input type="text" class="form-control" name="startDate"
                               value="<?= $startDate != null ? $startDate : \Carbon\Carbon::parse('2019-01-01')->format('Y-m-d')?> - <?= $endDate != null ? $endDate : \Carbon\Carbon::now()->format('Y-m-d')?>"/>
                    </div>

                    <div class="col-md-1 col-xs-3 mg_title" style="margin-left: 30px">
                        <button class="btn btn-success f_right btn_x" style="margin-top: 25px; width: 90px">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="col-md-1 col-xs-3 mg_title">
                        <input class="btn btn-success Plus_ f_right btn_x" style="margin-top: 25px ;width: 90px"
                               type="button"
                               onclick="location.href='admin/add'" value="+"/>
                    </div>
                </div>
                <?php echo Form::close() ?>
            </div>
            <!-- /tile header -->
            <!-- tile widget -->
            <div class="tile-widget color transparent-black textured">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example3x">
                        <thead>
                        <tr align="center">
                            <th>{{trans('action.shop.id')}}</th>
                            <th>{{trans('action.shop.name')}}</th>
                            <th>{{trans('action.shop.description')}}</th>
                            <th>{{trans('action.shop.address')}}</th>
                            <th>{{trans('action.shop.created_at')}}</th>
                            <th>{{trans('action.shop.updated_at')}}</th>
                            <th>{{trans('action.shop.delete')}}</th>
                            <th>{{trans('action.shop.edit')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shops as $shop)
                            <tr class="odd gradeX" align="center">
                                <td>{{$shop->id}}</td>
                                <td>{{$shop->shop_name}}</td>
                                <td>{{$shop->description}}</td>
                                <td>{{$shop->address}}</td>
                                <td>{{$shop->created_at}}</td>
                                <td>{{$shop->updated_at}}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ url('/admin/shops/destroy', ['id' => $shop->id]) }}">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this ?');"
                                                class="btn btn-warning"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                            href="{{url("admin/shops/edit" , ['id' => $shop->id])}}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="wapper-pagi text-center">
                        {{ $shops->appends(['searchKey' => $searchKey, 'startDate' => $startDate, 'endDate' => $endDate, 'sort'=> $sort, 'direction' => $direction])->links() }}
                    </div>
                </div>
            </div>
            <!-- /tile widget -->
        </section>

    </div>
@endsection
