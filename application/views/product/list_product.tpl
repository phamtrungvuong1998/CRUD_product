<div class="warper container-fluid">

    <div class="page-header">
        <h1>Danh sách sản phẩm</h1>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="page-header">
                <h3>Contextual classes <small>color table rows</small></h3>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Colored rows</div>
                <div class="panel-body">

                    <table class="table no-margn">
                        <thead>
                            <tr>
                                <th>ID sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Mã sản phẩm</th>
                                <th>Giá</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$data['list'] key=key item=value}
                                <tr class="active">
                                <td>{$value['id']}</td>
                                <td>{$value['name']}</td>
                                <td>{$value['code']}</td>
                                <td>{number_format($value['price'])} đ</td>
                                <td>{date('d/m/Y', $value['created_at'])}</td>
                                <td>{date('d/m/Y', $value['updated_at'])}</td>
                                <td><button class="btn btn-danger btn_del_product" data-id="{$value['id']}">Xóa</button>
                                </td>
                                <td><a href="/sua-san-pham/{$value['id']}" class="btn btn-primary">Sửa</a></td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                    {$data['links']}

                </div>
            </div>
        </div>

    </div>




</div>