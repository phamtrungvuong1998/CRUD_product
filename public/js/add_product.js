$(document).ready(function () {
    $(".form_add_product").submit(function(){
        var flag = true;
        var form_data = new FormData();
        name_product = $(this).find(".name_product");
        if (name_product.val().trim() == "") {
            name_product.parents(".form-group").find(".error").text("Không được để trống");
            flag = false;
        }else{
            name_product.parents(".form-group").find(".error").text("");
            form_data.append('name_product',name_product.val().trim());
        }

        code_product = $(this).find(".code_product");
        if (code_product.val().trim() == "") {
            code_product.parents(".form-group").find(".error").text("Không được để trống");
            flag = false;
        }else{
            code_product.parents(".form-group").find(".error").text("");
            form_data.append('code_product',code_product.val().trim());
        }

        price_product = $(this).find(".price_product");

        if (price_product.val().trim() == "") {
            price_product.parents(".form-group").find(".error").text("Không được để trống");
            flag = false;
        }else if (isNaN(price_product.val().trim()) == true) {
            price_product.parents(".form-group").find(".error").text("Giá tiền phải là số");
            flag = false;
        }else{
            price_product.parents(".form-group").find(".error").text("");
            form_data.append('price_product',Number(price_product.val().trim()));
        }

        if (flag == true) {
            $.ajax({
                type: "POST",
                url: "Product/add_product",
                data: form_data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.result == false) {
                        alert("Mã sản phẩm đã tồn tại")
                    }else{
                        window.location.href = "/danh-sach-san-pham";
                    }
                }
            });
        }
        return false;
    });

    $(".form_edit_product").submit(function(){
        var id = $(this).data('id');
        var flag = true;
        var form_data = new FormData();
        form_data.append('id', id);
        name_product = $(this).find(".name_product");
        if (name_product.val().trim() == "") {
            name_product.parents(".form-group").find(".error").text("Không được để trống");
            flag = false;
        }else{
            name_product.parents(".form-group").find(".error").text("");
            form_data.append('name_product',name_product.val().trim());
        }

        code_product = $(this).find(".code_product");
        if (code_product.val().trim() == "") {
            code_product.parents(".form-group").find(".error").text("Không được để trống");
            flag = false;
        }else{
            code_product.parents(".form-group").find(".error").text("");
            form_data.append('code_product',code_product.val().trim());
        }

        price_product = $(this).find(".price_product");
        if (price_product.val().trim() == "") {
            price_product.parents(".form-group").find(".error").text("Không được để trống");
            flag = false;
        }else if (isNaN(price_product.val().trim()) == true) {
            price_product.parents(".form-group").find(".error").text("Giá tiền phải là số");
            flag = false;
        }else{
            price_product.parents(".form-group").find(".error").text("");
            form_data.append('price_product',Number(price_product.val().trim()));
        }

        if (flag == true) {
            $.ajax({
                type: "POST",
                url: "/Product/edit_product",
                data: form_data,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.result == false) {
                        alert("Mã sản phẩm đã tồn tại");
                    }else{
                        window.location.href = "/danh-sach-san-pham";
                    }
                }
            });
        }
        return false;
    });

    $(".btn_del_product").click(function () { 
        var id = $(this).data("id");
        var url = "Product/delete_product"; 
        $.ajax({
            type: "POST",
            url: url,
            data: {
                'id' : id
            },
            dataType: "json",
            success: function (data) {
                location.reload();
            }
        });
    });
});