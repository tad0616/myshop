$('.btn-add-to-cart').click(function () {
    console.log($(this).data('id') + ' = ' + $('input[name=amount]').val());
    axios.post('{{ route('cart.store') }}', {
        product_id: $(this).data('id'),
        amount: $('input[name=amount]').val(),
    })
    .then(function () { // 請求成功時執行：
        swal('加入購物車成功', '', 'success');
    }, function (error) { // 請求失敗時執行：

        console.log('error.response.status = ' + error.response.status);
        if (error.response.status === 422) {
            var html = '<div>';
            _.each(error.response.data.errors, function (errors) {
                _.each(errors, function (error) {
                    html += error + '<br>';
                })
            });
            html += '</div>';
            swal({content: $(html)[0], icon: 'error'})
        } else if(error.response.status === 500) {
            swal('系統錯誤', '', 'error');
        }

        @guest
            swal('請先登入', '', 'error');
        @endguest
    })
});
